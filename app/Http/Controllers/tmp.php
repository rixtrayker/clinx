
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Administrator;
use Illuminate\Http\Request;
use App\Libs\ACL;
use App\Libs\Adminauth;
use Config;
use App\Models\Role;
use App\Models\Permission;
use App\Models\Patient;
use Session;
use Mail;
use Validator;
use App;
use Excel;

class PatientsController extends Administrator {

    public $model;
    public $module;
    public $rules;

    public function __construct(Patient $model) {
        parent::__construct();
        $this->module = 'patients';
        $this->model = $model;
        $this->rules = [
            'name' => 'required|unique:roles,name',
            'description' => 'required'
        ];
    }

    public function getView($id) {
        authorize('view-' . $this->module);
        $row = $this->model->findOrFail($id);
        return view('admin.' . $this->module . '.view', ['row' => $row, 'module' => $this->module]);
    }

    public function getIndex(Request $request) {
        authorize('view-' . $this->module);
        $rows = $this->model->orderBy('patient_number',"desc");
        if($request->clinic_id){
          $rows = $rows->where('clinic_id',$request->clinic_id);
        }
        if($request->price){
          $rows = $rows->where(function($query) use($request)
            {
              if($request->type==1 || $request->type==4){
                $query->where('name', 'like', "%".$request->price."%");
              }
              if($request->type==2 || $request->type==4){
                $query->orwhere('patient_number',$request->price);
              }
              if($request->type==3 || $request->type==4){
                $query->orwhere('telephone', 'like', "%".$request->price."%");
              }
            });
        }
        $rows = $rows->paginate(25);
        return view('admin.' . $this->module . '.index', ['rows' => $rows, 'module' => $this->module]);
    }

    public function getImport(Request $request) {
        authorize('import-' . $this->module);
        $row = $this->model;

        return view('admin.' . $this->module . '.import', ['row' => $row, 'module' => $this->module]);
    }

    public function postImport(Request $request) {
        authorize('import-' . $this->module);

        $field = 'file';
        $this->rules = [
            'file' => 'required'
        ];
        $patients=[];
        $this->validate($request, $this->rules);
        if ($request->hasFile($field) && $request->file($field)->isValid()) {
            $file = $request->file($field);
            Excel::load($file->getPathName(), function($reader) use ($request,&$patients) {
              $reader->formatDates(false);
              $results = $reader->get()->toArray();
              if ($results) {
                foreach ($results as $item) {
                  $rowArray=[];
                  if($item["file_number"]){
                    $rowArray["patient_number"]=(int)$item["file_number"]."";
                  }
                  if($item["child_name"]){
                    $rowArray["name"]=$item["child_name"];
                  }
                  if($item["mobile"]){
                    $rowArray["telephone"]="0".$item["mobile"];
                  }
                  if($item["whatsapp"]){
                    $rowArray["whatspap"]="0".$item["whatsapp"];
                  }
                  if($item["creation_date"]){
                    $rowArray["opening_date"]=date("Y-m-d", strtotime($item["creation_date"]));;
                  }
                  if($item["address"]){
                    $rowArray["street"]=$item["address"];
                  }
                  if($item["how_know_us"]){
                    if($item["how_know_us"] == "صديق"){
                      $rowArray["how_know_us"]=1;
                    }
                    elseif($item["how_know_us"] == "فيس بوك"){
                      $rowArray["how_know_us"]=2;
                    }
                    elseif($item["how_know_us"] == "تويتر"){
                      $rowArray["how_know_us"]=3;
                    }
                    elseif($item["how_know_us"] == "انستجرام"){
                      $rowArray["how_know_us"]=4;
                    }
                    elseif($item["how_know_us"] == "جوجل"){
                      $rowArray["how_know_us"]=5;
                    }else{
                      $rowArray["how_know_us"]=1;
                    }
                  }
                  if($item["nationality"]){
                    $rowArray["nationality"]=$item["nationality"];
                  }
                  $rowArray["clinic_id"]=6;
                  $rowArray["clinic"]="عيادة مدينة نصر";
                  $patients[] =$rowArray;
                  $row = Patient::where("patient_number",$rowArray["patient_number"])->first();
                  if(!$row){
                    Patient::create($rowArray);
                  }
                }
              }
            });
        }

        flash()->success("تم الاضافه بنجاح");
        return back();
    }

    public function getCreate() {

        authorize('create-'.$this->module);
        $row = $this->model;
        $latestchild =  \App\Models\Patient::orderBy('patient_number',"desc")->first();
        if($latestchild == null){
            $latestchild = new \stdClass();
            $latestchild->id =0;
        }
        $patientNo = $latestchild->patient_number + 1;
        $clinics =\App\Models\Clinic::published()->get()->pluck("title","id")->toArray();
        $govs =\App\Models\Government::published()->get()->pluck("title","id")->toArray();
        $vaccinations =\App\Models\Vaccination::published()->get()->pluck("title","id")->toArray();
        $cities =\App\Models\City::published()->get()->pluck("title","id")->toArray();
        return view('admin.' . $this->module . '.create', ["clinics"=>$clinics,"govs"=>$govs,"cities"=>$cities,
        "vaccinations"=>$vaccinations,"patientNo"=>$patientNo,'row' => $row, 'module' => $this->module]);
    }

    public function postCreate(Request $request)
    {
        $this->rules = [
            'name' => 'required',
            'opening_date' => 'required',
            'age' => 'required',
            'telephone' => 'required',
            'gender' => 'required',
            'clinic_id' => 'required',
            'birthdate' => 'required'
        ];
        authorize('create-'.$this->module);
        $this->validate($request, $this->rules);

        $latestchild =  \App\Models\Patient::orderBy('patient_number',"desc")->first();
        if($latestchild == null){
            $latestchild = new \stdClass();
            $latestchild->id =0;
        }
        $patientNo = $latestchild->patient_number + 1;
        $request->merge(["patient_number"=>$patientNo]);
        if($request->city_id){
          $request->merge(["city"=>\App\Models\City::where("id",$request->city_id)->first()->title]);
        }
        if($request->gov_id){
          $request->merge(["gov"=>\App\Models\Government::where("id",$request->gov_id)->first()->title]);
        }
        if($request->dose_id){
          $request->merge(["dose"=>\App\Models\Vaccination::where("id",$request->dose_id)->first()->title]);
        }
        if($request->clinic_id){
          $request->merge(["clinic"=>\App\Models\Clinic::where("id",$request->clinic_id)->first()->title]);
        }
        if($request->how_know_us){
          $request->merge(["how_know_us"=>implode(",",$request->how_know_us)]);
        }
        if($request->chronic_diseases){
          $request->merge(["chronic_diseases"=>implode(",",$request->chronic_diseases)]);
        }
        if($request->family_chronic_diseases){
          $request->merge(["family_chronic_diseases"=>implode(",",$request->family_chronic_diseases)]);
        }
        if($request->father_chronic_diseases){
          $request->merge(["father_chronic_diseases"=>implode(",",$request->father_chronic_diseases)]);
        }
        if($request->father_family_chronic_diseases){
          $request->merge(["father_family_chronic_diseases"=>implode(",",$request->father_family_chronic_diseases)]);
        }
        if($request->chiled_chronic_diseases){
          $request->merge(["chiled_chronic_diseases"=>implode(",",$request->chiled_chronic_diseases)]);
        }

        if ($row = $this->model->create($request->except(["family_genetic_diseases_check","hospital_care_reason_checked"
        ,"chiled_genetics_diseases_checked","drug_sensitivity_checked","did_surgery_checked",
        "compulsory_vaccinations_checked","brothers_genetic_diseases_check"]))) {
            flash()->success("تم الاضافة بنجاح");
            return redirect(App::getLocale().'/admin/' . $this->module . '');
        }

        flash()->error(trans('admin.failed to save'));
    }

    public function getEdit($id) {
        authorize('edit-'.$this->module);
        $row = $this->model->findOrFail($id);

        $clinics =\App\Models\Clinic::published()->get()->pluck("title","id")->toArray();
        $govs =\App\Models\Government::published()->get()->pluck("title","id")->toArray();
        $vaccinations =\App\Models\Vaccination::published()->get()->pluck("title","id")->toArray();
        $cities =\App\Models\City::published()->get()->pluck("title","id")->toArray();
        return view('admin.' . $this->module . '.edit', ["clinics"=>$clinics,"govs"=>$govs,"cities"=>$cities,
        "vaccinations"=>$vaccinations,'row' => $row, 'module' => $this->module]);
    }

    public function postEdit($id, Request $request) {
        authorize('edit-'.$this->module);
        $row = $this->model->findOrFail($id);
        $rules = [
            'name' => 'required',
            'opening_date' => 'required',
            'age' => 'required',
            'telephone' => 'required',
            'gender' => 'required',
            'clinic_id' => 'required',
            'birthdate' => 'required'
        ];
        $this->validate($request, $rules);
        if($request->city_id){
          $request->merge(["city"=>\App\Models\City::where("id",$request->city_id)->first()->title]);
        }
        if($request->gov_id){
          $request->merge(["gov"=>\App\Models\Government::where("id",$request->gov_id)->first()->title]);
        }
        if($request->dose_id){
          $request->merge(["dose"=>\App\Models\Vaccination::where("id",$request->dose_id)->first()->title]);
        }
        if($request->clinic_id){
          $request->merge(["clinic"=>\App\Models\Clinic::where("id",$request->clinic_id)->first()->title]);
        }
        if($request->how_know_us){
          $request->merge(["how_know_us"=>implode(",",$request->how_know_us)]);
        }
        if($request->chronic_diseases){
          $request->merge(["chronic_diseases"=>implode(",",$request->chronic_diseases)]);
        }
        if($request->family_chronic_diseases){
          $request->merge(["family_chronic_diseases"=>implode(",",$request->family_chronic_diseases)]);
        }
        if($request->father_chronic_diseases){
          $request->merge(["father_chronic_diseases"=>implode(",",$request->father_chronic_diseases)]);
        }
        if($request->father_family_chronic_diseases){
          $request->merge(["father_family_chronic_diseases"=>implode(",",$request->father_family_chronic_diseases)]);
        }
        if($request->chiled_chronic_diseases){
          $request->merge(["chiled_chronic_diseases"=>implode(",",$request->chiled_chronic_diseases)]);
        }

        if ($row->update($request->except(["family_genetic_diseases_check","hospital_care_reason_checked"
        ,"chiled_genetics_diseases_checked","drug_sensitivity_checked","did_surgery_checked",
        "compulsory_vaccinations_checked","brothers_genetic_diseases_check","patient_number"]))) {

            flash()->success(trans('admin.Edit successfull'));
            return redirect(App::getLocale().'/admin/' . $this->module . '' );
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

    public function getDeleteVacc($id) {
        authorize('deletevacc-'.$this->module);
        $row =\App\Models\PatientVacc::findOrFail($id);
        $row->delete();

        flash()->success(trans('admin.Delete successfull'));
        return redirect(App::getLocale().'/admin/' . $this->module . '/view/'.$row->patient_id."?tab=profile3");
    }

    public function getDeleteReservation($id) {
        authorize('deletevacc-'.$this->module);
        $row =\App\Models\PatientReservation::findOrFail($id);
        $row->delete();

        flash()->success(trans('admin.Delete successfull'));
        return redirect(App::getLocale().'/admin/' . $this->module . '/view/'.$row->patient_id."?tab=profile4");
    }

    public function postAddDiagnos(Request $request) {
      authorize('addvacc-'.$this->module);
      $row =\App\Models\PatientReservation::where("patient_id",$request->patient_id)->findOrFail($request->reservation_id);
      if ($row->update($request->except(["reservation_id","diagnos_id","diagnos_notes","treatments_id","treatments_notes","invests_id","invests_notes","complaints_id","complaints_notes"]))) {
          $row->diagnos_status = 1;
          $row->save();

          for($i=0;$i<sizeof($request->diagnos_id); $i++){
            $data=["reservation_id"=>$row->id,"diagnose_id"=>$request->diagnos_id[$i]];
            if(isset($request->diagnos_notes[$i])){
              $data['notes']=$request->diagnos_notes[$i];
            }
            \App\Models\ReservationDiagnoses::create($data);
          }
          for($i=0;$i<sizeof($request->complaints_id); $i++){
            $data=["reservation_id"=>$row->id,"diagnose_id"=>$request->complaints_id[$i]];
            if(isset($request->complaints_notes[$i])){
              $data['notes']=$request->complaints_notes[$i];
            }
            \App\Models\ReservationComplaints::create($data);
          }
          for($i=0;$i<sizeof($request->invests_id); $i++){
            $data=["reservation_id"=>$row->id,"diagnose_id"=>$request->invests_id[$i]];
            if(isset($request->invests_notes[$i])){
              $data['notes']=$request->invests_notes[$i];
            }
            \App\Models\ReservationInvests::create($data);
          }
          for($i=0;$i<sizeof($request->treatments_id); $i++){
            $data=["reservation_id"=>$row->id,"diagnose_id"=>$request->treatments_id[$i]];
            if(isset($request->treatments_notes[$i])){
              $data['notes']=$request->treatments_notes[$i];
            }
            \App\Models\ReservationTreatment::create($data);
          }
          flash()->success("تم الاضافة بنجاح");
          return redirect('ar/admin/' . $this->module . '/view/'.$row->patient_id."?tab=profile4");
      }

      flash()->error(trans('admin.failed to save'));
    }

    public function postAddReservation(Request $request) {
      authorize('addvacc-'.$this->module);
      $rules = [
          'patient_id' => 'required',
          'reservation_type' => 'required'
      ];

      if($request->reservation_type == 1){
        $request->merge(['price'=>\App\Models\Config::where("field_name","c_price")->first()->value]);
      }elseif($request->reservation_type == 1){
        $request->merge(['price'=>\App\Models\Config::where("field_name","f_price")->first()->value]);
      }else{
        $request->merge(['price'=>20]);
      }
      $this->validate($request, $rules);
      if ($row = \App\Models\PatientReservation::create($request->except([]))) {
          $row->total = $row->price;
          $row->status = 2;
          if($row->discount){
            $row->total = $row->total - $row->discount;
          }
          if($row->extra){
            $row->total = $row->total + $row->extra;
          }
          $row->created_date = date('Y-m-d');
          $last=\App\Models\PatientReservation::whereNull('extra')->whereDate('created_date', '=', date('Y-m-d'))->count();
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
            $last=\App\Models\PatientReservation::whereNotNull('extra')->whereDate('created_date', '=', date('Y-m-d'))->count() - 1;
            flash()->success("تم الاضافة بنجاح، يتم الدخول بعد " .$last  . " حالات مستعجل");
          }else{
            flash()->success("تم الاضافة بنجاح، رقم الحجز: ".$last);
          }
          return redirect(App::getLocale().'/admin/' . $this->module . '/view/'.$row->patient_id."?tab=profile4");
      }

      flash()->error(trans('admin.failed to save'));
    }

    public function postAddVacc(Request $request) {
      authorize('addvacc-'.$this->module);
      $rules = [
          'vacc_date' => 'required',
          'patient_id' => 'required',
          'vacc_id' => 'required',
          'status' => 'required'
      ];
      $this->validate($request, $rules);
      if ($row = \App\Models\PatientVacc::create($request->except([]))) {
          flash()->success("تم الاضافة بنجاح");
          return redirect(App::getLocale().'/admin/' . $this->module . '/view/'.$row->patient_id."?tab=profile3");
      }

      flash()->error(trans('admin.failed to save'));
    }
    public function getPublish($value, $id) {
        authorize('publish-'.$this->module);
        $row = \App\Models\PatientVacc::findOrFail($id);
        if ($value == 0) {
            $row->status = 0;
            $published ="تم الغاء التفعيل";
        } else {
            $row->status = 1;
            $published = "تم التفعيل";
        }
        $row->save();
        flash()->success($published . " " . "بنجاح");
        return redirect(App::getLocale().'/admin/' . $this->module . '/view/'.$row->patient_id."?tab=profile3");
    }
}
