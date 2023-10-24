<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    /**
     * @Function:        <__construct>
     * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
     * @Created On:      <01-12-2021>
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
     * @Created On:      <01-12-2021>
     * @Last Modified By:Gautam Kakadiya
     * @Last Modified:   Gautam Kakadiya
     * @Description:     <This function work for Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataArr = Country::get();
        return view('admin.country.index', compact('dataArr'));
    }

    /**
     * @Function:        <create>
     * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
     * @Created On:      <01-12-2021>
     * @Last Modified By:Gautam Kakadiya
     * @Last Modified:   Gautam Kakadiya
     * @Description:     <This function work for Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('admin.country.create', [ 'catArr' => Country::get()] );
    }

    /**
     * @Function:        <store>
     * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
     * @Created On:      <01-12-2021>
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
            'sortname' => 'required',
            // 'symbol' => 'required',
            'code' => 'required',
        ]);

        $path = "";
        if( $request->hasFile('image') ){
            $path = $request->file('image')->storeAs(
                'app/public/country',
                $request->sortname.'.png',
            );
        }

        $country = new Country();
        $country->name = $request->name;
        $country->sortname = $request->sortname;
        $country->symbol = $request->symbol;
        $country->code = $request->code;
        $country->image = $path;
        $country->status = $request->status;
        $country->alias = convertStringToSlug($request->name);
        $country->save();
        $request->session()->flash('message', 'Country successfully created');
        return redirect()->route('admin.country'); 
    }

    /**
     * @Function:        <show>
     * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
     * @Created On:      <01-12-2021>
     * @Last Modified By:Gautam Kakadiya
     * @Last Modified:   Gautam Kakadiya
     * @Description:     <This function work for Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $note = Country::find($id);
        return view('admin.country.show', [ 'note' => $note ]);
    }

    /**
     * @Function:        <edit>
     * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
     * @Created On:      <01-12-2021>
     * @Last Modified By:Gautam Kakadiya
     * @Last Modified:   Gautam Kakadiya
     * @Description:     <This function work for Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( $id ){
        return view('admin.country.edit',[ 'dataArr'  => Country::find($id) ]);
    }

    /**
     * @Function:        <update>
     * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
     * @Created On:      <01-12-2021>
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
            'name' => 'required|min:1|max:64',
            'sortname' => 'required',
            // 'symbol' => 'required',
            'code' => 'required',
        ]);


        $country = Country::find($id);
        if( $request->hasFile('image') ){
            $path = $request->file('image')->storeAs(
                'app/public/country',
                $request->sortname.'.png',
            );
            $country->image = $path;
        }

        $country->name = $request->name;
        $country->sortname = $request->sortname;
        $country->symbol = $request->symbol;
        $country->code = $request->code;
        $country->status = $request->status;
        $country->alias = convertStringToSlug($request->name);
        $country->save();
        $request->session()->flash('message', 'Country successfully updated');
        return redirect()->route('admin.country'); 
    }

    /**
     * @Function:        <destroy>
     * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
     * @Created On:      <01-12-2021>
     * @Last Modified By:Gautam Kakadiya
     * @Last Modified:   Gautam Kakadiya
     * @Description:     <This function work for Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $del = Country::find($id);
        if($del){

            
            $del->delete();
        }
        return response()->json( ['data' => ['message' => 'Country successfully deleted.' ] ], 200);
        // return redirect()->route('admin.country');
    }
}
