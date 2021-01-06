<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Permission;
use App\Services\Admin\PermissionService;
use App\Http\Controllers\Administrator;
use App;
use App\Models\Reservation;
use App\Models\Config as ModelsConfig;

class ReservationController extends Administrator
{
    public $model;
    public $module;
    public $rules;
    protected $permissionService;

    // protected $protect_methods = [
    //     'create' => ['store'],    // protects store() method on create.user (create.alias)
    //     'view'   => ['index', 'create', 'show', 'edit'],     // protects index(), create(), show(), edit() methods on view.user permission.
    //     'update' => ['update'],
    //     'delete' => ['destroy']
    // ];

    public function __construct(Permission $model)
    {
        // parent::__construct();
        $this->module = 'permissions';
        $this->model = $model;
        $this->permissionService = new PermissionService($model);
    }

    public function index()
    {
        // authorize('view-' . $this->module);
        $rows = $this->permissionService->index();
        $breadcrumbs = [
            ['link' => "/admin", 'name' => __('admin.Home')], [ 'name' => __('admin.Permissions')],
          ];
        return view('admin.' . $this->module . '.index', [
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
        $row = $this->permissionService->store($request->except([]));

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
        $row = $this->permissionService->show($id);
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
        $row = $this->permissionService->update($request->except([]), $id);
        if ($status) {
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
        $this->permissionService->destroy($id);
        flash()->success(trans('admin.Delete successfull'));
        return back();
    }

    public function reserve(Request $request)
    {
        $request['status']=2;
        $res_type = $request->reservation_type;
        $f_name = $res_type == 1 ? 'c_price' : ($res_type == 2 ? 'f_price' : 'v_price');
        $price = ModelsConfig::where("field_name", $f_name)->first()->value;
        $request['price'] = $price;

        // $this->validate($request, $rules);
        if ($row = Reservation::create($request->except([]))) {
            $row->total = $row->price;
            $row->status = 2;
            if ($row->discount) {
                $row->total = $row->total - $row->discount;
            }
            if ($row->extra) {
                $row->total = $row->total + $row->extra;
            }
            $row->created_at = date('Y-m-d');
            $last=Reservation::whereNull('extra')->whereDate('created_at', '=', date('Y-m-d'))->count();
            // if ($last > 0) {
            //     $last =$last+1;
            // } else {
            //     $last =1;
            // }
            $row->save();
        }
        // $row = Reservation::create($request->all());
        if ($row) {
            // flash()->success(trans('admin.Reservation Done'));
            return  response(['msg'=>__('admin.Reservation Done')], 200);
        } else {
            // flash()->error(trans('admin.Reservation Failed'));
        }
        return response(['msg'=>__('admin.Reservation Failed')], 400);
    }
}
