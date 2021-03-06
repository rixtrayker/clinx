<?php

namespace App\Services\Admin;

use App\Http\Controllers\Administrator;
use Illuminate\Http\Request;
use App\Libs\ACL;
use App\Libs\Adminauth;
use Config;
use App\Models\Role;
use App\Models\Permission;
use Session;
use Mail;
use Validator;
use App;
use Exception;

class RoleService
{
    public $model;
    public $module;
    public $rules;

    public function __construct(Role $model)
    {
        $this->module = 'roles';
        $this->model = $model;
        $this->rules = [
            'name' => 'required',
            // 'guard_name' => 'required|in:admin,web'
        ];
    }

    public function index()
    {
        $rows = Role::latest();
        $rows = $rows->get();
        return $rows;
    }

    public function store($data)
    {
        request()->validate($this->rules);
        $data['guard_name'] = 'admin';

        $row = Role::create($data);

        if ($row) {
            SaveActionLog();
        }

        return $row;
    }

    public function show($id)
    {
        return Role::findOrFail($id);
    }

    public function edit($id)
    {
        // authorize('edit-'.$this->module);
        $row = $this->show($id);
        return view('admin.' . $this->module . '.edit', ['row' => $row, 'module' => $this->module]);
    }

    public function update($data, $id)
    {
        request()->validate($this->rules);

        $row = $this->show($id);
        $row->permissions()->sync($data['permission_id']);

        try{
            $row->update($data);
            return true;
        }
        catch (Exception $e){
            return null;
        }
    }
    public function destroy($id)
    {
        $row = $this->show($id);
        try{
            $row->delete($data);
            return true;
        }
        catch (Exception $e){
            return null;
        }
    }
}
