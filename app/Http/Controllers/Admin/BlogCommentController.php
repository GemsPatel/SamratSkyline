<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\BlogComments;
use Illuminate\Http\Request;

class BlogCommentController extends Controller
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
        $dataArr = BlogComments::with('blog')->where( 'parent_id', 0 )->get();
        return view('admin.blog-comments.index', compact('dataArr'));
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
        return view('admin.blog-comments.create', [] );
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

        $rat_com = new BlogComments();
        $rat_com->title = $request->title;
        $rat_com->slug = $request->slug;
        $rat_com->parent_id = 0;
        $rat_com->image = '';
        $rat_com->status = $request->status;
        $rat_com->save();
        $request->session()->flash('message', 'Rating & Comment successfully created');
        return redirect()->route('admin.blog-comments'); 
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
        $note = BlogComments::with('user')->with('status')->find($id);
        return view('admin.blog-comments.show', [ 'note' => $note ]);
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
        $dataArr  = BlogComments::with('blog')->find($id);
        $replyArr  = BlogComments::where( 'parent_id', $id )->first();
        return view('admin.blog-comments.reply',compact( 'dataArr', 'replyArr' ) );
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
            'content' => 'required'
        ]);

        $rat_com = BlogComments::find($id);
        $rat_com->blog_id = $request->blog_id;
        $rat_com->parent_id = $request->parent_id;
        $rat_com->name = auth()->guard('admin')->user()->name;
        $rat_com->email = auth()->guard('admin')->user()->email;
        $rat_com->admin_id = auth()->guard('admin')->user()->id;
        $rat_com->content = $request->content;
        $rat_com->ip_address = $request->ip();
        $rat_com->status = $request->status;
        $rat_com->save();
        $request->session()->flash('message', 'Comment reply successfully updated');
        return redirect()->route('admin.blog-comments'); 
    }

    /**
     * @Function:        <reply>
     * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
     * @Created On:      <27-11-2021>
     * @Last Modified By:Gautam Kakadiya
     * @Last Modified:   Gautam Kakadiya
     * @Description:     <This function work for reply the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function reply(Request $request, $id)
    {
        $validatedData = $request->validate([
            'content' => 'required'
        ]);

        $reply = new BlogComments();
        $reply->blog_id = $request->blog_id;
        $reply->parent_id = $id;
        $reply->name = auth()->guard('admin')->user()->name;
        $reply->email = auth()->guard('admin')->user()->email;
        $reply->admin_id = auth()->guard('admin')->user()->id;
        $reply->content = $request->content;
        $reply->ip_address = $request->ip();
        $reply->status = $request->status;
        $reply->save();

        $replyParent = BlogComments::find( $id );
        $replyParent->status = $request->status;
        $replyParent->save();
        $request->session()->flash('message', 'Comment reply successfully updated');
        return redirect()->route('admin.blog-comments'); 
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
        $del = BlogComments::find($id);
        if($del){
            $del->delete();
        }

        return response()->json( ['data' => ['message' => 'Ratting & Comment successfully deleted.' ] ], 200);
        // return redirect()->route('admin.blog-comments');
    }
}
