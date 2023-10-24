<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Website;
use Illuminate\Http\Request;
use Image;

class WebsitesController extends Controller
{
    /**
     * @Function:        <__construct>
     * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
     * @Created On:      <30-09-2023>
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
     * @Created On:      <30-09-2023>
     * @Last Modified By:Gautam Kakadiya
     * @Last Modified:   Gautam Kakadiya
     * @Description:     <This function work for Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataArr = Website::get();
        return view('admin.websites.index', compact('dataArr'));
    }

    /**
     * @Function:        <create>
     * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
     * @Created On:      <30-09-2023>
     * @Last Modified By:Gautam Kakadiya
     * @Last Modified:   Gautam Kakadiya
     * @Description:     <This function work for Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view( 'admin.websites.create' );
    }

    /**
     * @Function:        <store>
     * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
     * @Created On:      <30-09-2023>
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
            'name' => 'required|min:1|max:30',
            'favicon' => 'required',
            'header_logo' => 'required',
        ]);

		$website = new Website();

        $favicon = $header_logo = $footer_logo = "";
        if ( $request->hasFile('favicon') ) {
            $filename = $request->favicon->getClientOriginalName();
            $request->favicon->storeAs('website', $filename, 'public' );
			$favicon = "public/website/".$filename;
        }

        if ( $request->hasFile('header_logo') ) {
            $filename = $request->header_logo->getClientOriginalName();
            $image = $request->file('header_logo');
            $destinationPath = storage_path('/app/public/website');
            $img = Image::make($image->path());
            $img->resize(478, 147, function ($constraint) {
                //$constraint->aspectRatio();
            })->save($destinationPath.'/'.$filename);

			$header_logo = "public/website/".$filename;
        }

        if ( $request->hasFile('footer_logo') ) {
            $filename = $request->footer_logo->getClientOriginalName();
            $image = $request->file('footer_logo');
            $destinationPath = storage_path('/app/public/website');
            $img = Image::make($image->path());
            $img->resize(478, 147, function ($constraint) {
                //$constraint->aspectRatio();
            })->save($destinationPath.'/'.$filename);

			$footer_logo = "public/website/".$filename;
        } else {
            $header_logo = $footer_logo;
        }

        $slug = rtrim( convertStringToSlug( $request->name ), "-" );
        $website->name = $request->name;
        $website->slug = $slug;
        $website->favicon = $favicon;
        $website->header_logo = $header_logo;
		$website->footer_logo = $footer_logo;
        $website->is_run_advertisement = $request->is_run_advertisement;
        $website->google_analytics_code = $request->google_analytics_code;
		$website->google_tag_manager_code = $request->google_tag_manager_code;
        $website->status = $request->status;
        $website->save();

        if( $request->status == 1 ){
            Website::where( 'id', '!=', $website->id )->update( [ 'status' => 0 ] );
        }

        $request->session()->flash('message', 'Website successfully created');
        return redirect()->route('admin.website');
    }

    /**
     * @Function:        <show>
     * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
     * @Created On:      <30-09-2023>
     * @Last Modified By:Gautam Kakadiya
     * @Last Modified:   Gautam Kakadiya
     * @Description:     <This function work for Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $note = Website::find($id);
        return view('admin.websites.show', [ 'note' => $note ]);
    }

    /**
     * @Function:        <edit>
     * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
     * @Created On:      <30-09-2023>
     * @Last Modified By:Gautam Kakadiya
     * @Last Modified:   Gautam Kakadiya
     * @Description:     <This function work for Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( $id ){
        $dataArr = Website::find($id);
        return view( 'admin.websites.edit', compact( 'dataArr' ) );
    }

    /**
     * @Function:        <update>
     * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
     * @Created On:      <30-09-2023>
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
            'name' => 'required|min:1|max:30',
        ]);

		$website = Website::find( $id );

        $favicon = $header_logo = $footer_logo = "";
        if ( $request->hasFile('favicon') ) {
            $filename = $request->favicon->getClientOriginalName();
            $request->favicon->storeAs('website', $filename, 'public' );
			$favicon = "public/website/".$filename;
            $website->favicon = $favicon;
        }

        if ( $request->hasFile('header_logo') ) {
            $filename = $request->header_logo->getClientOriginalName();
            $image = $request->file('header_logo');
            $destinationPath = storage_path('/app/public/website');
            $img = Image::make($image->path());
            $img->resize(478, 147, function ($constraint) {
                //$constraint->aspectRatio();
            })->save($destinationPath.'/'.$filename);

			$header_logo = "public/website/".$filename;
            $website->header_logo = $header_logo;
        }

        if ( $request->hasFile('footer_logo') ) {
            $filename = $request->footer_logo->getClientOriginalName();
            $image = $request->file('footer_logo');
            $destinationPath = storage_path('/app/public/website');
            $img = Image::make($image->path());
            $img->resize(478, 147, function ($constraint) {
                //$constraint->aspectRatio();
            })->save($destinationPath.'/'.$filename);

			$footer_logo = "public/website/".$filename;
        } else if( $header_logo != "" ){
            $header_logo = $footer_logo;
            $website->footer_logo = $footer_logo;
        }

        $slug = rtrim( convertStringToSlug( $request->name ), "-" );
        $website->name = $request->name;
        $website->slug = $slug;
        $website->is_run_advertisement = $request->is_run_advertisement;
        $website->google_analytics_code = $request->google_analytics_code;
		$website->google_tag_manager_code = $request->google_tag_manager_code;
        $website->status = $request->status;
        $website->save();

        if( $request->status == 1 ){
            Website::where( 'id', '!=', $website->id )->update( [ 'status' => 0 ] );
        }
        
        $request->session()->flash('message', 'Website successfully updated');
        return redirect()->route('admin.website');
    }

    /**
     * @Function:        <destroy>
     * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
     * @Created On:      <30-09-2023>
     * @Last Modified By:Gautam Kakadiya
     * @Last Modified:   Gautam Kakadiya
     * @Description:     <This function work for Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $del = Website::find($id);
        if($del){
            $del->delete();
        }

        return response()->json( ['data' => ['message' => 'Website successfully deleted.' ] ], 200);
    }
}
