<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\HomeMaintanance;
use App\Models\Admin\Maintanance;
use App\Models\Admin\MaintananceReport;
use Illuminate\Http\Request;
use Image;

class MaintananceController extends Controller
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
        $dataArr = Maintanance::all();
        return view('admin.maintanance.index', compact('dataArr'));
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
        return view('admin.maintanance.create', []  );
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
    public function reportCreate(){

        $dataArr = MaintananceReport::where( [
            'user_id' => auth()->guard('admin')->user()->id,
            'wing_id' => auth()->guard('admin')->user()->wing_id,
        ] )
        ->get();
        return view('admin.maintanance.report_create', compact( 'dataArr' )  );
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
            'title' => 'required|min:1|max:64',
            'short_description' => 'required|min:1',
            'amount' => 'required|min:1',
        ]);

        $path = "";
        if ($request->hasFile('image')) {
            $filename = $request->image->getClientOriginalName();
            // $request->image->storeAs('blog', $filename, 'public' );

            $image = $request->file('image');
            $destinationPath = storage_path('/app/public/maintanance');
            $img = Image::make($image->path());
            $img->resize(1024, 768, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$filename);

			$path = "public/maintanance/".$filename;
        }

        $maintanance = new Maintanance();
        $maintanance->user_id = auth()->guard('admin')->user()->id;
        $maintanance->wing_id = auth()->guard('admin')->user()->wing_id;
        $maintanance->short_description = $request->short_description;
        $maintanance->title = $request->title;
        $maintanance->image = $path;
        $maintanance->amount = $request->amount;
        $maintanance->paid_date = $request->paid_date;
        $maintanance->save();
        $request->session()->flash('message', 'Maintanance successfully created');
        return redirect()->route('admin.maintanance'); 
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
    public function reportStore(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|min:1|max:64',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        $maintanance = new MaintananceReport();
        $maintanance->user_id = auth()->guard('admin')->user()->id;
        $maintanance->wing_id = auth()->guard('admin')->user()->wing_id;
        $maintanance->name = $request->name;
        $maintanance->start_date = $request->start_date;
        $maintanance->end_date = $request->end_date;
        $maintanance->save();
        
        $request->session()->flash('message', 'Maintanance Report successfully created');
        return redirect()->route('admin.maintanance.report-create'); 
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
    public function reportView($id)
    {
        $maintananceReport = MaintananceReport::find($id);
        $receiveMaintanance = HomeMaintanance::with( 'home' )
        ->where([
            'user_id' => auth()->guard('admin')->user()->id,
            'wing_id' => auth()->guard('admin')->user()->wing_id,
        ])
        ->whereBetween( 'paid_date', [ $maintananceReport->start_date, $maintananceReport->end_date ] )
        ->get();

        $paidMaintanance = Maintanance::where([
            'user_id' => auth()->guard('admin')->user()->id,
            'wing_id' => auth()->guard('admin')->user()->wing_id,
        ])
        ->whereBetween( 'paid_date', [ $maintananceReport->start_date, $maintananceReport->end_date ])
        ->get();

        $halfReceiveMaintanance = ( COUNT( $receiveMaintanance ) / 2 );
        $halfPaidMaintanance = ( COUNT( $paidMaintanance ) / 2 );
        return view('admin.maintanance.report_view', compact( 'maintananceReport', 'receiveMaintanance', 'paidMaintanance', 'halfReceiveMaintanance', 'halfPaidMaintanance' ));
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
        return view('admin.maintanance.edit', ['dataArr'  => Maintanance::find($id)]);
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
            'short_description' => 'required|min:1',
            'amount' => 'required|min:1',
        ]);

        $maintanance = Maintanance::find($id);

        if ($request->hasFile('image')) {
            $filename = $request->image->getClientOriginalName();
            // $request->image->storeAs('blog', $filename, 'public' );

            $image = $request->file('image');
            $destinationPath = storage_path('/app/public/maintanance');
            $img = Image::make($image->path());
            $img->resize(1024, 768, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$filename);

			$maintanance->image = "public/maintanance/".$filename;
        }

        $maintanance->short_description = $request->short_description;
        $maintanance->title = $request->title;
        $maintanance->amount = $request->amount;
        $maintanance->paid_date = $request->paid_date;
        $maintanance->save();
        $request->session()->flash('message', 'Maintanance successfully updated');
        return redirect()->route('admin.maintanance'); 
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
        Maintanance::where('id', $id)->delete();
        return response()->json( ['data' => ['message' => 'Maintanance successfully deleted.' ] ], 200);
    }
}
