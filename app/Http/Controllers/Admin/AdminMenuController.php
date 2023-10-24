<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\AdminMenu;
use App\Models\Admin\Permission;
use Illuminate\Http\Request;

class AdminMenuController extends Controller
{
    /**
     * @Function:        <__construct>
     * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
     * @Created On:      <23-11-2021>
     * @Last Modified By:Gautam Kakadiya
     * @Last Modified:   Gautam Kakadiya
     * @Description:     <This function work for Create a new controller instance.>
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * @Function:        <index>
     * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
     * @Created On:      <23-11-2021>
     * @Last Modified By:Gautam Kakadiya
     * @Last Modified:   Gautam Kakadiya
     * @Description:     <This function work for Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.menu.index', [ 'dataArr' => AdminMenu::all() ]);
    }

    /**
     * @Function:        <create>
     * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
     * @Created On:      <23-11-2021>
     * @Last Modified By:Gautam Kakadiya
     * @Last Modified:   Gautam Kakadiya
     * @Description:     <This function work for Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('admin.menu.create', [ 'dataArr' => AdminMenu::all() ] );
    }

    /**
     * @Function:        <store>
     * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
     * @Created On:      <23-11-2021>
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
            'class_name' => 'required|min:1|max:64',
            'name' => 'required|min:1|max:64',
            'icon' => 'required|min:1|max:64',
        ]);

        $data = new AdminMenu();
        $data->class_name = $request->class_name;
        $data->parent_id = $request->parent_id;
        $data->name = $request->name;
        $data->slug = convertStringToSlug( $request->name );
        $data->icon = $request->icon;
        $data->status = $request->status;
        $data->sort_order = $request->sort_order;
        $data->save();

        $permission = new Permission();
        $permission->user_id = 0;
        $permission->menu_id = $data->id;
        $permission->role_id = 1;
        $permission->add = 1;
        $permission->edit = 1;
        $permission->delete = 1;
        $permission->view = 1;
        $permission->save();

        $request->session()->flash('message', 'Menu successfully created.');
        return redirect()->route('admin.menu'); 
    }

    /**
     * @Function:        <show>
     * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
     * @Created On:      <23-11-2021>
     * @Last Modified By:Gautam Kakadiya
     * @Last Modified:   Gautam Kakadiya
     * @Description:     <This function work for Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $note = AdminMenu::with('user')->with('status')->find($id);
        return view('admin.menu.show', [ 'note' => $note ]);
    }

    /**
     * @Function:        <edit>
     * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
     * @Created On:      <23-11-2021>
     * @Last Modified By:Gautam Kakadiya
     * @Last Modified:   Gautam Kakadiya
     * @Description:     <This function work for Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( $id ){
        return view('admin.menu.edit',['dataArr'  => AdminMenu::find($id), 'menuArr' => AdminMenu::all() ]);
    }

    /**
     * @Function:        <update>
     * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
     * @Created On:      <23-11-2021>
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
            'class_name' => 'required|min:1|max:64',
            'name' => 'required|min:1|max:64',
            'icon' => 'required|min:1|max:64',
        ]);

        $data = AdminMenu::find($id);
        $data->class_name = $request->class_name;
        $data->parent_id = $request->parent_id;
        $data->name = $request->name;
        $data->slug = convertStringToSlug( $request->name );
        $data->icon = $request->icon;
        $data->status = $request->status;
        $data->sort_order = $request->sort_order;
        $data->save();
        $request->session()->flash('message', 'Menu successfully updated');
        return redirect()->route('admin.menu'); 
    }

    /**
     * @Function:        <destroy>
     * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
     * @Created On:      <23-11-2021>
     * @Last Modified By:Gautam Kakadiya
     * @Last Modified:   Gautam Kakadiya
     * @Description:     <This function work for Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $del = AdminMenu::find($id);
        if($del){
            $del->delete();
        }
        return response()->json( ['data' => ['message' => 'Menu successfully deleted.' ] ], 200);
        // return redirect()->route('admin.menu');
    }
}
