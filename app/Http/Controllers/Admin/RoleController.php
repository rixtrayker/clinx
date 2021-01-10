<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Services\Admin\RoleService;
use App\Http\Controllers\Administrator;
use App;
use App\Models\Permission;

class RoleController extends Administrator
{
    public $model;
    public $module;
    public $rules;
    protected $roleService;

    // protected $protect_methods = [
    //     'create' => ['store'],    // protects store() method on create.user (create.alias)
    //     'view'   => ['index', 'create', 'show', 'edit'],     // protects index(), create(), show(), edit() methods on view.user permission.
    //     'update' => ['update'],
    //     'delete' => ['destroy']
    // ];

    public function __construct(Role $model)
    {
        // parent::__construct();
        $this->module = 'roles';
        $this->model = $model;
        $this->roleService = new RoleService($model);
    }

    public function index_data()
    {
        // authorize('view-' . $this->module);
        $rows = $this->roleService->index();
        dd(1);
        return \apiResponse(200,'',$rows);
    }

    public function index()
    {
        // authorize('view-' . $this->module);
        $rows = $this->roleService->index();
        $breadcrumbs = [
            ['link' => "/admin", 'name' => __('admin.Home')], [ 'name' => __('admin.Roles')],
          ];
          $pageConfigs = [
            'direction' => 'rtl',
        ];

          return view('admin.' . $this->module . '.index', [
            // 'pageConfigs' => $pageConfigs,

            'breadcrumbs' => $breadcrumbs,
            'rows' => $rows,
             'module' => $this->module
          ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // authorize('create-'.$this->module);
        $row = $this->model;
        $permissions = Permission::all();
        return view('admin.' . $this->module . '.create', ['row' => $row, 'module' => $this->module,'permissions' => $permissions ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // authorize('create-'.$this->module);
        $row = $this->roleService->store($request->except([]));

        if ($row) {
            flash()->success(trans('admin.Add successfull'));
            return redirect('/admin/' . $this->module . '');
        }

        flash()->error(trans('admin.failed to save'));

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
        // authorize('edit-'.$this->module);
        $row = $this->roleService->show($id);
        $permissions = Permission::all();
        return view('admin.' . $this->module . '.edit', ['row' => $row, 'module' => $this->module,'permissions' => $permissions ]);
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
        // authorize('edit-'.$this->module);
        $row = $this->roleService->update($request->except([]),$id);
        if ($row){
            flash()->success(trans('admin.Edit successfull'));
            return redirect('/admin/' . $this->module . '');
        }
        flash()->error(trans('admin.failed to save'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // authorize('delete-'.$this->module);
        $this->roleService->destroy($id);
        flash()->success(trans('admin.Delete successfull'));
        return back();
    }

    public function getPermissions($id) {
        // authorize('create-'.$this->module);
        $row = $this->model->findOrFail($id);
        $permissions = \App\Models\Permission::all();
        return view('admin.' . $this->module . '.permissions', ['permissions'=>$permissions,'row' => $row, 'module' => $this->module]);
    }

    public function postPermissions($id, Request $request) {
        $row = $this->model->findOrFail($id);
        // authorize('create-'.$this->module);
        try {
          $row->permissions()->sync((array) $request->input('role_list'));
          SaveActionLog('admin/add_permission/create');

          flash()->success(trans('admin.Permission set successfull'));
          return redirect(app()->getLocale().'/admin/' . $this->module . '');

        } catch (\Exception $e) {
          flash()->error(trans('admin.failed to save'));
        }
    }

}
