<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Services\Admin\PatientService;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public $model;
    public $module;
    public $rules;
    protected $patientService;

    public function __construct(Patient $model)
    {
        // parent::__construct();
        $this->module = 'patients';
        $this->model = $model;
        $this->patientService = new PatientService($model);
    }

    public function index()
    {
        $rows = $this->patientService->index();
        $breadcrumbs = [
            ['link' => "/admin", 'name' => __('admin.Home')], [ 'name' => __('admin.Children')],
          ];
        return view('admin.' . $this->module . '.index', [
            'breadcrumbs' => $breadcrumbs,
            'rows' => $rows,
             'module' => $this->module
          ]);
    }
    public function json_index()
    {
        return $this->patientService->json_index();
    }


    public function create()
    {
        $row = $this->model;
        return view('admin.' . $this->module . '.create', ['row' => $row, 'module' => $this->module]);
    }


    public function store(Request $request)
    {
        $row = $this->patientService->store($request->except([]));

        if ($row) {
            flash()->success(trans('admin.Add successfull'));
            return redirect('/admin/' . $this->module . '');
        }

        flash()->error(trans('admin.failed to save'));
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $row = $this->patientService->show($id);
        return view('admin.' . $this->module . '.edit', ['row' => $row, 'module' => $this->module]);
    }


    public function update(Request $request, $id)
    {
        $row = $this->patientService->update($request->except([]), $id);
        if ($status) {
            flash()->success(trans('admin.Edit successfull'));
            return redirect('/admin/' . $this->module . '');
        }
        flash()->error(trans('admin.failed to save'));
    }

    public function destroy($id)
    {
        $this->patientService->destroy($id);
        flash()->success(trans('admin.Delete successfull'));
        return back();
    }
}
