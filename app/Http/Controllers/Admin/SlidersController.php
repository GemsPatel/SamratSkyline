<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Blogs;
use App\Models\Admin\Categories;
use App\Models\Admin\Sliders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SlidersController extends Controller
{
    /**
     * @Function:        <__construct>
     * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
     * @Created On:      <25-11-2021>
     * @Last Modified By:Gautam Kakadiya
     * @Last Modified:   Gautam Kakadiya
     * @Description:     <This function work for Create a new controller instance.>
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('admin');
    }

    /**
     * @Function:        <index>
     * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
     * @Created On:      <25-11-2021>
     * @Last Modified By:Gautam Kakadiya
     * @Last Modified:   Gautam Kakadiya
     * @Description:     <This function work for Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataArr = Sliders::with('category')->get();
        return view('admin.sliders.index', compact('dataArr'));
    }

    /**
     * @Function:        <create>
     * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
     * @Created On:      <25-11-2021>
     * @Last Modified By:Gautam Kakadiya
     * @Last Modified:   Gautam Kakadiya
     * @Description:     <This function work for Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $categoryArr = Categories::where( ['status' => 1, 'parent_id' => 0 ] )->get();
        return view('admin.sliders.create', compact('categoryArr') );
    }

    /**
     * @Function:        <store>
     * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
     * @Created On:      <25-11-2021>
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
            'category_id' => 'required',
            'short_description' => 'required',
        ]);

        $path = "";
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('public/slider');
        }

        $slider = new Sliders();
        $slider->user_id = auth()->guard('admin')->user()->id;
        $slider->category_id = $request->category_id;
        $slider->title = $request->title;
        $slider->slug = convertStringToSlug( $request->title );
        $slider->image = $path;
        $slider->short_description = $request->short_description;
        $slider->status = $request->status;
        $slider->save();

        $request->session()->flash('message', 'Slider successfully created');
        return redirect()->route('admin.sliders'); 
    }

    /**
     * @Function:        <show>
     * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
     * @Created On:      <25-11-2021>
     * @Last Modified By:Gautam Kakadiya
     * @Last Modified:   Gautam Kakadiya
     * @Description:     <This function work for Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $note = Sliders::with('user')->with('status')->find($id);
        return view('admin.sliders.show', [ 'note' => $note ]);
    }

    /**
     * @Function:        <edit>
     * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
     * @Created On:      <25-11-2021>
     * @Last Modified By:Gautam Kakadiya
     * @Last Modified:   Gautam Kakadiya
     * @Description:     <This function work for Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( $id ){
        $dataArr = Sliders::find($id);
        $categoryArr = Categories::where( ['status' => 1, 'parent_id' => 0 ] )->get();
        return view('admin.sliders.edit', compact( 'dataArr', 'categoryArr'));
    }

    /**
     * @Function:        <update>
     * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
     * @Created On:      <25-11-2021>
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
            'category_id' => 'required',
            'short_description' => 'required',
        ]);

        $slider = Blogs::find($id);
        if ($request->hasFile('image')) {
            $slider->image = $request->file('image')->store('public/blog');
        }

        $slider->user_id = auth()->guard('admin')->user()->id;
        $slider->category_id = $request->category_id;
        $slider->title = $request->title;
        $slider->slug = convertStringToSlug( $request->title );
        $slider->short_description = $request->short_description;
        $slider->status = $request->status;
        $slider->save();
        
        $request->session()->flash('message', 'Blog successfully updated');
        return redirect()->route('admin.blogs'); 
    }

    /**
     * @Function:        <destroy>
     * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
     * @Created On:      <25-11-2021>
     * @Last Modified By:Gautam Kakadiya
     * @Last Modified:   Gautam Kakadiya
     * @Description:     <This function work for Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $del = Blogs::find($id);
        if($del){
            $del->delete();
        }

        return response()->json( ['data' => ['message' => 'Blog successfully deleted.' ] ], 200);
    }
}