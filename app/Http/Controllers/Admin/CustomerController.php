<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\MembershipPlanBuy;
use App\Models\User;
use App\Rules\MatchAdminOldPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

class CustomerController extends Controller
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
        $dataArr = Customer::get();
        return view('admin.customer.index', compact('dataArr'));
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
        return view('admin.customer.create', [] );
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
            'name' => 'required|min:1|max:64',
            'email' => 'required|min:1|max:64',
            'password' => 'required|min:1|max:64',
            'mobile_number' => 'required|min:1|max:10',
        ]);

        $customer = new Customer();
        $customer->role_id = $request->role_id;
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->csrf = $request->password;
        $customer->password = Hash::make($request->password);
        $customer->mobile_number = $request->mobile_number;
        $customer->status = $request->status;
        $customer->save();
        $request->session()->flash('message', 'Customer successfully updated');
        return redirect()->route('admin.customer'); 
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
        return view('admin.customer.show', [ 'dataArr' => Customer::find($id) ] );
    }

    /**
     * @Function:        <customerPlanHistory>
     * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
     * @Created On:      <24-12-2021>
     * @Last Modified By:Gautam Kakadiya
     * @Last Modified:   Gautam Kakadiya
     * @Description:     <This function work for Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function customerPlanHistory($id)
    {
        return view('admin.customer.show-payment-history', [ 'dataArr' => MembershipPlanBuy::with('customer', 'plan')->where( 'customer_id', $id)->get() ] );
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
        return view('admin.customer.edit', [ 'dataArr' => Customer::find($id) ] );
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
            'name' => 'required|min:1|max:64',
            'email' => 'required|min:1|max:64',
            // 'password' => 'required|min:1|max:64',
            'mobile_number' => 'required|min:1|max:10',
        ]);

        $customer = Customer::find($id);
        $customer->name = $request->name;
        $customer->email = $request->email;

        if( !empty( $request->password ) ){
            $customer->csrf = $request->password;
            $customer->password = Hash::make($request->password);
        }

        $customer->status = $request->status;
        $customer->mobile_number = $request->mobile_number;
        $customer->save();

        $request->session()->flash('message', 'Customer successfully updated');
        return redirect()->route('admin.customer'); 
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
        $del = Customer::find($id);
        if($del){
            $del->delete();
        }

        return response()->json( ['data' => ['message' => 'Customer successfully deleted.' ] ], 200);
        // return redirect()->route('admin.customer');
    }

    /**
     * @Function:        <profileIndex>
     * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
     * @Created On:      <11-01-2022>
     * @Last Modified By:Gautam Kakadiya
     * @Last Modified:   Gautam Kakadiya
     * @Description:     <This function work for Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function profileIndex()
    {
        $dataArr = Auth::guard('admin')->user();
        return view('admin.update-profile.edit', compact('dataArr'));
    }

    /**
     * @Function:        <profileUpdate>
     * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
     * @Created On:      <11-01-2022>
     * @Last Modified By:Gautam Kakadiya
     * @Last Modified:   Gautam Kakadiya
     * @Description:     <This function work for Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function profileUpdate( Request $request )
    {
        $request->validate(['old_password' => ['required', new MatchAdminOldPassword],
            'password' => 'required|same:confirm_password',
            'confirm_password' => 'required',
        ]);

        User::find(auth('admin')->user()->id)->update(['password' => Hash::make($request->password)]);
   
        $request->session()->flash('message', 'Password change successfully.');

        $dataArr = Auth::guard('admin')->user();
        return view('admin.update-profile.edit', compact('dataArr'));
    }
}
