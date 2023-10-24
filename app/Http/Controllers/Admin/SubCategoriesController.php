<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Categories;
use Illuminate\Http\Request;

class SubCategoriesController extends Controller
{
    /**
     * @Function:        <__construct>
     * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
     * @Created On:      <23-11-2021>
     * @Last Modified By:Gautam Kakadiya
     * @Last Modified:   Gautam Kakadiya
     * @Description:     <This function work for Create a new controller instance.>
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
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
        $dataArr = Categories::where( 'parent_id', '!=', 0 )->get();
        return view('admin.subcategory.index', compact('dataArr'));
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
        $catArr = Categories::where( [ 'status' => 1, 'parent_id' => 0 ] )->get();
        return view('admin.subcategory.create', compact( 'catArr') );
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
            'parent_id' => 'required',
        ]);

        $path = "";
        if( $request->hasFile('image') ){
            $path = $request->file('image')->storeAs(
                'public/sub-category',
                $request->slug.'.png',
            );
        }

        $category = new Categories();
        $category->title = $request->title;
        $category->slug = $request->slug;
        $category->parent_id = $request->parent_id;
        $category->image = $path;
        $category->status = $request->status;
        $category->save();
        $request->session()->flash('message', 'Sub category successfully created');
        return redirect()->route('admin.subcategory');
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
        return view('admin.subcategory.show', [ 'note' => $note ]);
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
        $catArr = Categories::where( [ 'status' => 1, 'parent_id' => 0 ] )->get();

        return view('admin.subcategory.edit', compact('dataArr', 'catArr'));
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
            'title' => 'required|min:1|max:64',
            'parent_id' => 'required',
        ]);

        $category = Categories::find($id);
        if( $request->hasFile('image') ){
            $path = $request->file('image')->storeAs(
                'public/sub-genre',
                $request->slug.'.png',
            );
            $category->image = $path;
        }

        $category->title = $request->title;
        $category->slug = $request->slug;
        $category->parent_id = $request->parent_id;
        $category->status = $request->status;
        $category->save();
        $request->session()->flash('message', 'Subgenre successfully updated');
        return redirect()->route('admin.subcategory');
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
        if($del){
            $del->delete();
        }

        return response()->json( ['data' => ['message' => 'Sub category successfully deleted.' ] ], 200);
    }
}
