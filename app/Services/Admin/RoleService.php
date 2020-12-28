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
            'name' => 'required|unique:roles,name',
            'description' => 'required'
        ];
    }

    public function index()
    {
        $rows = $this->model->latest();
        $rows = $rows->get();
        return $rows;
    }

    public function store($data,$requestPath)
    {
        $this->validate($data, $this->rules);
        $row = $this->model->create($data);

        if($row) SaveActionLog($requestPath);
        return $row;
    }

    public function edit($id)
    {
        // authorize('edit-'.$this->module);
        $row = $this->roleService->show($id);
        return view('admin.' . $this->module . '.edit', ['row' => $row, 'module' => $this->module]);
    }

    public function update($data, $id)
    {
        $this->validate($data, $rules);
        $row = $this->roleService->show($id);
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
        $row = $this->roleService->show($id);
        try{
            $row->delete($data);
            return true;
        }
        catch (Exception $e){
            return null;
        }
    }
}
