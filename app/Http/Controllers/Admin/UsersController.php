<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
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
        $this->module = 'users';
        $this->model = new User;
    }

    public function index()
    {
        $rows = User::all();

        return view('admin.users.index', [
            'rows'=>$rows,
            'module'=>'users',
        ]);
    }


    public function create()
    {
        $row = $this->model;
        $roles = Role::where('guard_name', 'web')->pluck('name', 'id');
        return view('admin.users.create', [
            'row'=>$row,
            'roles'=>$roles,
            'module'=>'users',
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
            'email'=>'required|email',
            'password'=>'required|min:4',
            'role_id'=>'required',
        ];

        $request->validate($rules);
        $request['password'] = Hash::make($request['password']);
        $row = User::create($request->except(['role_id','_token']));
        $row->assignRole($request['role_id']);
        return redirect(route('users.index'));
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
        $row = User::findOrFail($id);
        $roles = Role::where('guard_name', 'web')->pluck('name', 'id');
        return view('admin.users.edit', [
            'row'=>$row,
            'roles'=>$roles,
            'module'=>'users',
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
            'email'=>'required|email',
            'password'=>'nullable|min:4',
            'role_id'=>'required',
        ];

        $request->validate($rules);
        $row = User::findOrFail($id);

        if (filled($request['password'])) {
            $request['password'] = Hash::make($request['password']);
            $row->update($request->except(['role_id','_token']));
        } else {
            $row->update($request->except(['role_id','password','_token']));
        }
        $row->syncRoles($request['role_id']);

        return redirect(route('users.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $row = User::findOrFail($id);
        if ($row) {
            $row->delete();
        }

        return redirect(route('users.index'));
    }
}
