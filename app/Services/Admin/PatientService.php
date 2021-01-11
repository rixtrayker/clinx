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
use App\Models\Config as ModelsConfig;
use App\Models\Reservation;

use Exception;

class PatientService
{
    public $model;
    public $module;
    public $rules;
    public $errors;

    public function __construct(Patient $model)
    {
        $this->module = 'patients';
        $this->model = $model;
        $this->rules = [
            'name' => 'required',
            'patient_number' => 'required',
            // 'guard_name' => 'required|in:admin,web'
        ];

        $this->errors = [
            'name.required' => __('validation.name required'),
            'patient_number.required' => __('validation.patient number required'),
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
        $rows = Patient::latest()->select('id', 'patient_number', 'name', 'telephone', 'clinic')->get();

        return $rows->toJson();

    }

    public function store($data)
    {
        request()->validate($this->rules, $this->errors);
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
        request()->validate($this->rules, $this->errors);
        // dd($data['chronic_diseases']);
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
            $row->delete();

            return true;
        } catch (Exception $e) {
            return null;
        }
    }

    public function postAddReservation($data) {
        // authorize('addvacc-'.$this->module);
        $rules = [
            'patient_id' => 'required',
        ];
        $res_type = $request->reservation_type;
        $f_name = $res_type == 1 ? 'c_price' : ($res_type == 2 ? 'f_price' : 'v_price');
        $price = ModelsConfig::where("field_name",$f_name)->first()->value;
        $data['price'] = $price;

        // $this->validate($request, $rules);
        if ($row = Reservation::create($data)) {
            $row->total = $row->price;
            $row->status = 2;
            if($row->discount){
              $row->total = $row->total - $row->discount;
            }
            if($row->extra){
              $row->total = $row->total + $row->extra;
            }
            $row->created_at = date('Y-m-d');
            $last=Reservation::whereNull('extra')->whereDate('created_date', '=', date('Y-m-d'))->count();
            if($last > 0){
              $last =$last+1;
            }else{
              $last =1;
            }
            if(!$row->extra){
              $row->reservation_number =$last;
            }
            $row->save();

            if(!$row->extra){
              $row->reservation_number =$last;
            }

            if($row->extra){
              $last=Reservation::whereNotNull('extra')->whereDate('created_date', '=', date('Y-m-d'))->count() - 1;
              flash()->success("تم الاضافة بنجاح، يتم الدخول بعد " .$last  . " حالات مستعجل");
            }else{
              flash()->success("تم الاضافة بنجاح، رقم الحجز: ".$last);
            }
            return redirect(App::getLocale().'/admin/' . $this->module . '/view/'.$row->patient_id."?tab=profile4");
        }

        flash()->error(trans('admin.failed to save'));
      }
}
