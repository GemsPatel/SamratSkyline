<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public $websiteDetails = "";

    /**
     * @Function:        <__construct>
     * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
     * @Created On:      <23-11-2021>
     * @Last Modified By:Gautam Kakadiya
     * @Last Modified:   Gautam Kakadiya
     * @Description:     <This function work for Create a new controller instance.>
     * @return void
     */
    function __construct()
    {
        $this->websiteDetails = getHeaderInformation();
    }

    /**
     * @Function:        <index>
     * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
     * @Created On:      <23-11-2021>
     * @Last Modified By:Gautam Kakadiya
     * @Last Modified:   Gautam Kakadiya
     * @Description:     <This function work for Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $headerInfo = $this->websiteDetails;
        $dataArr = Categories::where( [
            // 'parent_id' => 0, 
            'website_id' => $headerInfo->id 
        ] )
        ->get();

        $parentArr = Categories::where( [
            'parent_id' => 0, 
            'website_id' => $headerInfo->id 
        ] )
        ->pluck('title', 'id');
        

        return view('admin.category.index', compact( 'dataArr', 'headerInfo', 'parentArr' ) );
    }

    /**
     * @Function:        <create>
     * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
     * @Created On:      <23-11-2021>
     * @Last Modified By:Gautam Kakadiya
     * @Last Modified:   Gautam Kakadiya
     * @Description:     <This function work for Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $headerInfo = $this->websiteDetails;
        $parentArr = Categories::where( [
            'parent_id' => 0, 
            'website_id' => $headerInfo->id 
        ] )
        ->pluck('title', 'id');

        return view('admin.category.create', compact( 'parentArr', 'headerInfo' ) );
    }

    /**
     * @Function:        <store>
     * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
     * @Created On:      <23-11-2021>
     * @Last Modified By:Gautam Kakadiya
     * @Last Modified:   Gautam Kakadiya
     * @Description:     <This function work for Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|min:1|max:64',
            'slug' => 'required|min:1|max:64'
        ]);

        $slug = convertStringToSlug( $request->title );
        if( $request->parent_id ){
            $parentArr = Categories::where( [
                'website_id' => $this->websiteDetails->id,
                'id' => $request->parent_id
            ] )
            ->select( 'title' )
            ->first();

            $slug = convertStringToSlug( $parentArr->title ).'-'.$slug;
        }

        $path = "";
        if( $request->hasFile('image') ){
            $path = $request->file('image')->storeAs(
                'public/category',
                $slug.'.png',
            );
        }

        $category = new Categories();
        $category->title = $request->title;
        $category->slug = $slug;
        $category->parent_id = $request->parent_id;
        $category->website_id = $this->websiteDetails->id;
        $category->image = $path;
        $category->status = $request->status;
        $category->save();
        $request->session()->flash('message', 'Category successfully created');
        return redirect()->route('admin.category');
    }

    /**
     * @Function:        <show>
     * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
     * @Created On:      <23-11-2021>
     * @Last Modified By:Gautam Kakadiya
     * @Last Modified:   Gautam Kakadiya
     * @Description:     <This function work for Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $note = Categories::with('user')->with('status')->find($id);
        return view('admin.category.show', [ 'note' => $note ]);
    }

    /**
     * @Function:        <edit>
     * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
     * @Created On:      <23-11-2021>
     * @Last Modified By:Gautam Kakadiya
     * @Last Modified:   Gautam Kakadiya
     * @Description:     <This function work for Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( $id ){

        $dataArr = Categories::find($id);
        $headerInfo = $this->websiteDetails;
        $parentArr = Categories::where( [
            'parent_id' => 0, 
            'website_id' => $headerInfo->id 
        ] )
        ->where( 'id', '!=', $id )
        ->pluck('title', 'id');
        return view('admin.category.edit', compact( 'dataArr', 'parentArr', 'headerInfo' ) );
    }

    /**
     * @Function:        <update>
     * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
     * @Created On:      <23-11-2021>
     * @Last Modified By:Gautam Kakadiya
     * @Last Modified:   Gautam Kakadiya
     * @Description:     <This function work for Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|min:1|max:64'
        ]);

        $slug = convertStringToSlug( $request->title );
        if( $request->parent_id ){
            $parentArr = Categories::where( [
                'website_id' => $this->websiteDetails->id,
                'id' => $request->parent_id
            ] )
            ->select( 'title' )
            ->first();

            $slug = convertStringToSlug( $parentArr->title ).'-'.$slug;
        }
        
        $category = Categories::find($id);
        if( $request->hasFile('image') ){
            $path = $request->file('image')->storeAs(
                'public/category',
                $slug.'.png',
            );
            $category->image = $path;
        }

        $category->title = $request->title;
        $category->slug = $slug;
        $category->parent_id = $request->parent_id;
        $category->website_id = $this->websiteDetails->id;
        $category->status = $request->status;
        $category->save();
        $request->session()->flash('message', 'Genre successfully updated');
        return redirect()->route('admin.category');
    }

    /**
     * @Function:        <destroy>
     * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
     * @Created On:      <23-11-2021>
     * @Last Modified By:Gautam Kakadiya
     * @Last Modified:   Gautam Kakadiya
     * @Description:     <This function work for Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $del = Categories::find($id);
        if ($del) {
            $this->removeSubGenreRelatedData($id);
            $del->delete();
        }
        return response()->json( ['data' => ['message' => 'Genre successfully deleted.' ] ], 200);
    }

    /**
     * @Function:        <removeSubGenreRelatedData>
     * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
     * @Created On:      <23-11-2021>
     * @Last Modified By:Gautam Kakadiya
     * @Last Modified:   Gautam Kakadiya
     * @Description:     <This function work for Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function removeSubGenreRelatedData($id)
    {
        Categories::where('parent_id', $id)->delete();
    }
}
