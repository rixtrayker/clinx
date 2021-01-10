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

class PermissionService
{
    public $model;
    public $module;
    public $rules;

    public function __construct(Permission $model)
    {
        $this->module = 'permissions';
        $this->model = $model;
        $this->rules = [
            'name' => 'required',
            // 'name' => 'required|unique:permissions,name',
            'guard_name' => 'required|in:admin,web'
        ];
    }

    public function index()
    {
        $rows = $this->model->latest();

        $rows = $rows->get();
        return $rows;
    }

    public function store($data)
    {
        request()->validate($this->rules);
        $data['guard_name'] = 'admin';

        $row = $this->model->create($data);


        if ($row) {
            SaveActionLog();
        }
        return $row;
    }

    public function show($id)
    {
        return $this->model->findOrFail($id);

    }

    public function edit($id)
    {
        // authorize('edit-'.$this->module);
        $row = $this->permissionService->show($id);
        return view('admin.' . $this->module . '.edit', ['row' => $row, 'module' => $this->module]);
    }

    public function update($data, $id)
    {
        request()->validate($rules);

        $row = $this->permissionService->show($id);
        try {
            $row->update($data);
            return true;
        } catch (Exception $e) {
            return null;
        }
    }
    public function destroy($id)
    {
        $row = $this->permissionService->show($id);
        try {
            $row->delete($data);
            return true;
        } catch (Exception $e) {
            return null;
        }
    }
}
