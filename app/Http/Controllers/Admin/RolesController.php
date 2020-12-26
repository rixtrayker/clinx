<?php

namespace App\Http\Controllers\Admin;

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
class RolesController extends Administrator {

    public $model;
    public $module;
    public $rules;

    public function __construct(Role $model) {
        parent::__construct();
        $this->module = 'roles';
        $this->model = $model;
        $this->rules = [
            'name' => 'required|unique:roles,name',
            'description' => 'required'
        ];
    }

    public function getIndex(Request $request) {
        authorize('view-' . $this->module);
        $rows = $this->model->latest();
        $rows = $rows->get();
        return view('admin.' . $this->module . '.index', ['rows' => $rows, 'module' => $this->module]);
    }

    public function getCreate() {

        authorize('create-'.$this->module);
        $row = $this->model;
        return view('admin.' . $this->module . '.create', ['row' => $row, 'module' => $this->module]);
    }

    public function postCreate(Request $request) {

        authorize('create-'.$this->module);
        $this->validate($request, $this->rules);
        if ($row = $this->model->create($request->except([]))) {
          SaveActionLog($request->path());

            flash()->success(trans('admin.Add successfull'));
            return redirect('/admin/' . $this->module . '');

        }

        flash()->error(trans('admin.failed to save'));
    }

    public function getEdit($id) {
        authorize('edit-'.$this->module);
        $row = $this->model->findOrFail($id);
        return view('admin.' . $this->module . '.edit', ['row' => $row, 'module' => $this->module]);
    }

    public function postEdit($id, Request $request) {
        authorize('edit-'.$this->module);
        $row = $this->model->findOrFail($id);
        $rules = [
            'name' => 'required|unique:roles,name,'.$id,
            'description' => 'required',
        ];
        $this->validate($request, $rules);
        if ($row->update($request->except([]))) {
            flash()->success(trans('admin.Edit successfull'));
            return redirect('/admin/' . $this->module . '');

        }
        flash()->error(trans('admin.failed to save'));
    }

    public function getDelete($id) {
        authorize('delete-'.$this->module);
        $row = $this->model->findOrFail($id);
        $row->delete();
        flash()->success(trans('admin.Delete successfull'));
        return back();
    }

    public function getPermissions($id) {
        authorize('create-'.$this->module);
        $row = $this->model->findOrFail($id);
        $permissions = \App\Models\Permission::all();
        return view('admin.' . $this->module . '.permissions', ['permissions'=>$permissions,'row' => $row, 'module' => $this->module]);
    }

    public function postPermissions($id, Request $request) {
        $row = $this->model->findOrFail($id);
        authorize('create-'.$this->module);
        try {
          $row->permissions()->sync((array) $request->input('role_list'));
          SaveActionLog('admin/add_permission/create');

          flash()->success(trans('admin.Permission set successfull'));
          return redirect('/admin/' . $this->module . '');
        } catch (\Exception $e) {
          flash()->error(trans('admin.failed to save'));
        }
    }

    
}
