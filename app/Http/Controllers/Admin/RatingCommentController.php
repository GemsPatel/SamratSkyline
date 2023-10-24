<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\RatingComment;
use Illuminate\Http\Request;

class RatingCommentController extends Controller
{
    /**
     * @Function:        <__construct>
     * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
     * @Created On:      <27-11-2021>
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
     * @Created On:      <27-11-2021>
     * @Last Modified By:Gautam Kakadiya
     * @Last Modified:   Gautam Kakadiya
     * @Description:     <This function work for Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataArr = RatingComment::with('customer')->get();
        return view('admin.rating-comment.index', compact('dataArr'));
    }

    /**
     * @Function:        <create>
     * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
     * @Created On:      <27-11-2021>
     * @Last Modified By:Gautam Kakadiya
     * @Last Modified:   Gautam Kakadiya
     * @Description:     <This function work for Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('admin.rating-comment.create', [] );
    }

    /**
     * @Function:        <store>
     * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
     * @Created On:      <27-11-2021>
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

        $rat_com = new RatingComment();
        $rat_com->title = $request->title;
        $rat_com->slug = $request->slug;
        $rat_com->parent_id = 0;
        $rat_com->image = '';
        $rat_com->status = $request->status;
        $rat_com->save();
        $request->session()->flash('message', 'Rating & Comment successfully created');
        return redirect()->route('admin.rating-comment'); 
    }

    /**
     * @Function:        <show>
     * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
     * @Created On:      <27-11-2021>
     * @Last Modified By:Gautam Kakadiya
     * @Last Modified:   Gautam Kakadiya
     * @Description:     <This function work for Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $note = RatingComment::with('user')->with('status')->find($id);
        return view('admin.rating-comment.show', [ 'note' => $note ]);
    }

    /**
     * @Function:        <edit>
     * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
     * @Created On:      <27-11-2021>
     * @Last Modified By:Gautam Kakadiya
     * @Last Modified:   Gautam Kakadiya
     * @Description:     <This function work for Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( $id ){
        return view('admin.rating-comment.edit',['dataArr'  => RatingComment::find($id) ]);
    }

    /**
     * @Function:        <update>
     * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
     * @Created On:      <27-11-2021>
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

        $rat_com = RatingComment::find($id);
        $rat_com->title = $request->title;
        $rat_com->slug = $request->slug;
        $rat_com->parent_id = 0;
        $rat_com->image = '';
        $rat_com->status = $request->status;
        $rat_com->save();
        $request->session()->flash('message', 'Rating & Comment successfully updated');
        return redirect()->route('admin.rating-comment'); 
    }

    /**
     * @Function:        <destroy>
     * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
     * @Created On:      <27-11-2021>
     * @Last Modified By:Gautam Kakadiya
     * @Last Modified:   Gautam Kakadiya
     * @Description:     <This function work for Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $del = RatingComment::find($id);
        if($del){
            $del->delete();
        }

        return response()->json( ['data' => ['message' => 'Ratting & Comment successfully deleted.' ] ], 200);
        // return redirect()->route('admin.rating-comment');
    }
}
