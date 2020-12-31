<?php

namespace App\Services\Admin;

use App\Http\Controllers\Administrator;
use Illuminate\Http\Request;
use App\Libs\ACL;
use App\Libs\Adminauth;
use Config;
use App\Models\Patient;
use App\Models\Permission;
use Session;
use Mail;
use Validator;
use App;
use Exception;

class PatientService
{
    public $model;
    public $module;
    public $rules;

    public function __construct(Patient $model)
    {
        $this->module = 'patients';
        $this->model = $model;
        $this->rules = [
            'name' => 'required',
            'patient_number' => 'required|digits',
            // 'guard_name' => 'required|in:admin,web'
        ];
    }

    public function index()
    {
        $rows = Patient::latest()->paginate(25);
        // $rows = $rows->get();
        return $rows;
    }
    public function json_index()
    {
        $rows = Patient::select('id', 'patient_number', 'name', 'telephone', 'clinic')->get();
        return $rows->toArray();
    }

    public function store($data)
    {
        request()->validate($this->rules);
        $data['guard_name'] = 'admin';

        $row = Patient::create($data);

        if ($row) {
            SaveActionLog();
        }

        return $row;
    }

    public function show($id)
    {
        return Patient::findOrFail($id);
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
        // $row->permissions()->sync($data['permission_id']);

        try {
            $row->update($data);
            return true;
        } catch (Exception $e) {
            return null;
        }
    }
    public function destroy($id)
    {
        $row = $this->show($id);
        try {
            $row->delete($data);
            return true;
        } catch (Exception $e) {
            return null;
        }
    }
}
