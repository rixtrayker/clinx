<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class adminsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $module;
    private $model;
    public function __constructor()
    {
        $this->module = 'admins';
        $this->model = new Admin;

    }

    public function index()
    {
        $rows = Admin::all();

        return view('admin.admins.index', [
            'rows'=>$rows,
            'module'=>'admins',
        ]);
    }


    public function create()
    {
        $row = $this->model;
        $roles = Role::where('guard_name', 'admin')->pluck('name', 'id');
        return view('admin.admins.create', [
            'row'=>$row,
            'roles'=>$roles,
            'module'=>'admins',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules=[
            'email'=>'required|email|unique:admins,email',
            'password'=>'required|min:4',
            'role_id'=>'required',
        ];

        $request->validate($rules);
        $request['password'] = Hash::make($request['password']);
        $row = Admin::create($request->except(['role_id','_token']));

        $row->assignRole($request['role_id']);
        return redirect(route('admins.index'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $row = Admin::findOrFail($id);

        $roles = Role::where('guard_name', 'admin')->pluck('name', 'id');
        return view('admin.admins.edit', [
            'row'=>$row,
            'roles'=>$roles,
            'module'=>'admins',
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'email'=>'required|email|unique:admins,email,'.$id,
            'password'=>'nullable|min:4',
            'role_id'=>'required',
        ];

        $request->validate($rules);
        $row = Admin::findOrFail($id);


        if (filled($request['password'])) {
            $request['password'] = Hash::make($request['password']);
            $row->update($request->except(['role_id','_token']));
        } else {
            $row->update($request->except(['role_id','password','_token']));
        }
        $row->syncRoles($request['role_id']);

        return redirect(route('admins.index'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $row = Admin::findOrFail($id);

        if ($row) {
            $row->delete();
        }

        return redirect(route('admins.index'));

    }
}
