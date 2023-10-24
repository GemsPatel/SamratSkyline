<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Blogs;
use App\Models\Admin\BlogTagMaps;
use App\Models\Admin\Categories;
use App\Models\Admin\Recommended;
use App\Models\Admin\Tags;
use Illuminate\Http\Request;
use Image;

class BlogsController extends Controller
{
    public $websiteDetails = "";
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
        $this->websiteDetails = getHeaderInformation();
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
        $headerInfo = $this->websiteDetails;
        $dataArr = Blogs::with('category', 'sub_category')
                    ->orderBy( 'id', 'desc' )
                    ->where([
                        'website_id' => $headerInfo->id
                    ])
                    ->get();
        return view('admin.blogs.index', compact('dataArr', 'headerInfo'));
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
        $headerInfo = $this->websiteDetails;
        $categoryArr = Categories::where( [
            'status' => 1, 
            'parent_id' => 0,
            'website_id' => $headerInfo->id,
        ] )
        ->get();

        $subCategoryArr = Categories::where([
            'status' => 1,
            'website_id' => $headerInfo->id,
        ])
        ->where( 'parent_id', '!=', 0 )
        ->get();

        $blogArr = Blogs::select( 'id', 'title' )->where( [
            'status' => 1,
            'website_id' => $headerInfo->id,
        ] )
        ->get();
        return view('admin.blogs.create', compact('categoryArr', 'subCategoryArr', 'blogArr', 'headerInfo') );
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
            'title' => 'required|min:1|max:256',
            'category_id' => 'required',
            // 'sub_category_id' => 'required',
            'short_description' => 'required',
            // 'description' => 'required',
        ]);

		$blog = new Blogs();

        $path = "";
        if ($request->hasFile('image')) {
            $filename = $request->image->getClientOriginalName();
            // $request->image->storeAs('blog', $filename, 'public' );

            $image = $request->file('image');
            $destinationPath = storage_path('/app/public/blog');
            $img = Image::make($image->path());
            $img->resize(820, 400, function ($constraint) {
                //$constraint->aspectRatio();
            })->save($destinationPath.'/'.$filename);

			$path = "public/blog/".$filename;
        }

        $slug = rtrim( convertStringToSlug( $request->title ), "-" );
		//$short_url = _en( time() );
        $user_id = auth()->guard('admin')->user()->id;
        $blog->user_id = $user_id;
        $blog->category_id = $request->category_id;
        $blog->sub_category_id = $request->sub_category_id;
        $blog->website_id = $this->websiteDetails->id;
        $blog->title = $request->title;
        $blog->slug = $slug;
		$blog->image = $path;
        $blog->short_description = $request->short_description;
        $blog->description = $request->description;
		$blog->keyword = $request->keyword;
        $blog->status = $request->status;
        $blog->save();

        //save blog tags
        if( isset( $request->tags ) && COUNT( $request->tags ) > 0 ){
            foreach( $request->tags as $tag ){
                $tags = Tags::where( 'slug', convertStringToSlug( $tag ) )->first();
                $blogTags = new BlogTagMaps();
                $blogTags->user_id = $user_id;
                $blogTags->category_id = $request->category_id;
                $blogTags->sub_category_id = $request->sub_category_id;
                $blogTags->blog_id = $blog->id;
                $blogTags->tag_id = $tags->id;
                $blogTags->save();
            }
        }

         //save blog recommended
         if( isset( $request->blog_id ) && $request->blog_id != "" ){
            $rec = new Recommended();
            $rec->user_id = $user_id;
            $rec->category_id = $request->category_id;
            $rec->sub_category_id = $request->sub_category_id;
            $rec->blog_id = $blog->id;
            $rec->save();
        }

		$blog->short_url = _en( $blog->id );
		$blog->save();
		
        $request->session()->flash('message', 'Blog successfully created');
        return redirect()->route('admin.blogs');
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
        $note = Blogs::with('user')->with('status')->find($id);
        return view('admin.blogs.show', [ 'note' => $note ]);
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
        $headerInfo = $this->websiteDetails;
        $dataArr = Blogs::find($id);
        $categoryArr = Categories::where( [
            'status' => 1, 
            'parent_id' => 0,
            'website_id' => $headerInfo->id
        ] )->get();

        $subCategoryArr = Categories::where([
            'status' => 1,
            'website_id' => $headerInfo->id
        ])
        ->where( 'parent_id', '!=', 0 )
        ->get();

        $blogArr = Blogs::select( 'id', 'title' )->where( [
            'status' => 1,
            'website_id' => $headerInfo->id
        ] )
        ->get();

        return view('admin.blogs.edit', compact( 'dataArr', 'categoryArr', 'subCategoryArr', 'blogArr', 'headerInfo'));
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
            'title' => 'required|min:1|max:256',
            'category_id' => 'required',
            // 'sub_category_id' => 'required',
            'short_description' => 'required',
            // 'description' => 'required',
        ]);

        $blog = Blogs::find($id);
        if ($request->hasFile('image')) {
			$filename = $request->image->getClientOriginalName();
            // $request->image->storeAs('blog', $filename, 'public' );

            $image = $request->file('image');
            $destinationPath = storage_path('/app/public/blog');
            $img = Image::make($image->path());
            $img->resize(820, 400, function ($constraint) {
                //$constraint->aspectRatio();
            })->save($destinationPath.'/'.$filename);
			$blog->image = "public/blog/".$filename;
        }

        $blog->user_id = auth()->guard('admin')->user()->id;
        $blog->category_id = $request->category_id;
        $blog->sub_category_id = $request->sub_category_id;
        $blog->website_id = $this->websiteDetails->id;
        $blog->title = $request->title;
        //$blog->slug = convertStringToSlug( $request->title );
        $blog->short_description = $request->short_description;
        $blog->description = $request->description;
		$blog->keyword = $request->keyword;
        $blog->status = $request->status;
        $blog->save();

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
        // return redirect()->route('admin.role');
    }
}
