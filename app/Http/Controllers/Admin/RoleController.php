<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Services\Admin\RoleService;
use App\Http\Controllers\Administrator;
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

    public function index()
    {
        // authorize('view-' . $this->module);
        $rows = $roleService->index();

        return view('admin.' . $this->module . '.index', ['rows' => $rows, 'module' => $this->module]);
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
        return view('admin.' . $this->module . '.create', ['row' => $row, 'module' => $this->module]);

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
        $row = $roleService->store($request->except([]), $request->path());
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
        return view('admin.' . $this->module . '.edit', ['row' => $row, 'module' => $this->module]);
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
        if ($status){
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
}
