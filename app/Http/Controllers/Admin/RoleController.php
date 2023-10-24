<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Role;
use App\Models\Admin\Permission;
use Illuminate\Http\Request;

class RoleController extends Controller
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
        $dataArr = Role::all();
        return view('admin.role.index', compact('dataArr'));
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
        return view('admin.role.create', [ 'dataArr' => Role::all() ] );
        // return view('admin.role.create', [] );
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
            'parent_menu_id' => 'required|array',
        ]);

        $role = new Role();
        $role->title = $request->title;
        $role->status = $request->status;
        $role->save();

        if( isset( $request->parent_menu_id ) && COUNT( $request->parent_menu_id ) ){
            foreach( $request->parent_menu_id as $pid )
            {
                $permission = new Permission();
                $permission->user_id = 0;
                $permission->menu_id = $pid;
                $permission->role_id = $role->id;
                $permission->add = 1;
                $permission->edit = 1;
                $permission->delete = 1;
                $permission->view = 1;
                $permission->save();
            }
        }

        if( isset( $request->child_menu_id ) && COUNT( $request->child_menu_id )){
            foreach( $request->child_menu_id as $cid )
            {
                $permission = new Permission();
                $permission->user_id = 0;
                $permission->menu_id = $cid;
                $permission->role_id = $role->id;
                $permission->add = 1;
                $permission->edit = 1;
                $permission->delete = 1;
                $permission->view = 1;
                $permission->save();
            }
        }

        $request->session()->flash('message', 'Role successfully created');
        return redirect()->route('admin.role'); 
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
        $note = Role::with('user')->with('status')->find($id);
        return view('admin.role.show', [ 'note' => $note ]);
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
        $dataArr = Role::find($id);
        $permissionArr = Permission::where( 'role_id', $id )->get()->pluck('menu_id');
        $menuArr = [];
        foreach( $permissionArr as $id ){
            $menuArr[] = $id;
        }
        return view('admin.role.edit', compact( 'dataArr', 'menuArr'));
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
            'parent_menu_id' => 'required|array',
        ]);

        $role = Role::find($id);
        $role->title = $request->title;
        $role->status = $request->status;
        $role->save();

        //delete old role permission
        Permission::where('role_id', $id)->delete();
        if( isset( $request->parent_menu_id ) && COUNT( $request->parent_menu_id ) ){
            foreach( $request->parent_menu_id as $pid )
            {
                $permission = new Permission();
                $permission->user_id = 0;
                $permission->menu_id = $pid;
                $permission->role_id = $id;
                $permission->add = 1;
                $permission->edit = 1;
                $permission->delete = 1;
                $permission->view = 1;
                $permission->save();
            }
        }

        if( isset( $request->child_menu_id ) && COUNT( $request->child_menu_id ) ){
            foreach( $request->child_menu_id as $cid )
            {
                $permission = new Permission();
                $permission->user_id = 0;
                $permission->menu_id = $cid;
                $permission->role_id = $id;
                $permission->add = 1;
                $permission->edit = 1;
                $permission->delete = 1;
                $permission->view = 1;
                $permission->save();
            }
        }
        
        $request->session()->flash('message', 'Role successfully updated');
        return redirect()->route('admin.role'); 
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
        $del = Role::find($id);
        if($del){
            $del->delete();
        }

        return response()->json( ['data' => ['message' => 'Role successfully deleted.' ] ], 200);
        // return redirect()->route('admin.role');
    }
}
