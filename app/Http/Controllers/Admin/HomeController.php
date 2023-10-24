<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Home;
use App\Models\Admin\HomeMaintanance;
use App\Models\Admin\Wing;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * @Function:        <__construct>
     * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
     * @Created On:      <21-10-2023>
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
     * @Created On:      <21-10-2023>
     * @Last Modified By:Gautam Kakadiya
     * @Last Modified:   Gautam Kakadiya
     * @Description:     <This function work for Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataArr = Home::with( 'wing' )->get();
        return view('admin.home.index', compact('dataArr'));
    }

    /**
     * @Function:        <create>
     * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
     * @Created On:      <21-10-2023>
     * @Last Modified By:Gautam Kakadiya
     * @Last Modified:   Gautam Kakadiya
     * @Description:     <This function work for Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $wings = Wing::where( 'status', 1 )->get();
        return view('admin.home.create', compact('wings') );
    }

    /**
     * @Function:        <store>
     * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
     * @Created On:      <21-10-2023>
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
            'name' => 'required|min:1|max:64',
            'number' => 'required',
            'mobile_number' => 'required|numeric|min:10'
        ]);

        $home = new Home();
        $home->user_id = auth()->guard('admin')->user()->id;
        $home->wing_id = $request->wing_id;
        $home->name = $request->name;
        $home->number = $request->number;
        $home->mobile_number = $request->mobile_number;
        $home->status = $request->status;
        $home->save();
        $request->session()->flash('message', 'Home successfully created');
        return redirect()->route('admin.home'); 
    }

    /**
     * @Function:        <store>
     * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
     * @Created On:      <22-10-2023>
     * @Last Modified By:Gautam Kakadiya
     * @Last Modified:   Gautam Kakadiya
     * @Description:     <This function work for Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeMaintanance(Request $request)
    {
        $validatedData = $request->validate([
            'amount' => 'required|min:1',
            'paid_date' => 'required',
        ]);

        $home = new HomeMaintanance();
        $home->user_id = auth()->guard('admin')->user()->id;
        $home->wing_id = $request->wing_id;
        $home->home_id = $request->home_id;
        $home->amount = $request->amount;
        $home->paid_date = $request->paid_date;
        $home->save();
        $request->session()->flash('message', 'Home Maintanance successfully created');
        return redirect()->route('admin.home'); 
    }

    /**
     * @Function:        <show>
     * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
     * @Created On:      <21-10-2023>
     * @Last Modified By:Gautam Kakadiya
     * @Last Modified:   Gautam Kakadiya
     * @Description:     <This function work for Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $note = Home::find($id);
        return view('admin.home.show', [ 'note' => $note ]);
    }

    /**
     * @Function:        <edit>
     * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
     * @Created On:      <21-10-2023>
     * @Last Modified By:Gautam Kakadiya
     * @Last Modified:   Gautam Kakadiya
     * @Description:     <This function work for Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( $id ){
        $dataArr = Home::find( $id );
        $wings = Wing::where( 'status', 1 )->get();
        $maintananceArr = HomeMaintanance::where( 'home_id', $id )->get();
        return view('admin.home.edit', compact( 'dataArr', 'wings', 'maintananceArr' ) );
    }

    /**
     * @Function:        <update>
     * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
     * @Created On:      <21-10-2023>
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
            'message' => 'required|min:1'
        ]);

        $home = Home::find($id);
        $home->message = $request->message;
        $home->title = $request->title;
        $home->is_android_send = 0;
        $home->is_ios_send = 0;
        $home->status = $request->status;
        $home->save();
        $request->session()->flash('message', 'Home successfully updated');
        return redirect()->route('admin.home'); 
    }

    /**
     * @Function:        <destroy>
     * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
     * @Created On:      <21-10-2023>
     * @Last Modified By:Gautam Kakadiya
     * @Last Modified:   Gautam Kakadiya
     * @Description:     <This function work for Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Home::where('id', $id)->delete();
        return response()->json( ['data' => ['message' => 'Home successfully deleted.' ] ], 200);
    }
}
