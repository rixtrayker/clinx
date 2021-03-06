<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Clinic;
use App\Models\Government;

use App\Models\Patient;
use App\Models\Vaccination;

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
        $latestchild =  Patient::orderBy('patient_number', "desc")->first();
        if ($latestchild == null) {
            $latestchild = new Patient();
            $latestchild->patient_number =0;
        }
        $patient_number = $latestchild->patient_number + 1;
        $clinics =Clinic::published()->get()->pluck("title", "id")->toArray();
        $govs =Government::published()->get()->pluck("title", "id")->toArray();
        $vaccinations =Vaccination::published()->get()->pluck("title", "id")->toArray();
        $cities =City::published()->get()->pluck("title", "id")->toArray();




        return view('admin.' . $this->module . '.create', ["clinics"=>$clinics,"govs"=>$govs,"cities"=>$cities,
        "vaccinations"=>$vaccinations,"patient_number"=>$patient_number,'row' => $row, 'module' => $this->module]);

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
        $patientNo = $row->patient_number;
        $clinics =Clinic::published()->get()->pluck("title", "id")->toArray();
        $govs =Government::published()->get()->pluck("title", "id")->toArray();
        $vaccinations =Vaccination::published()->get()->pluck("title", "id")->toArray();
        $cities =City::published()->get()->pluck("title", "id")->toArray();
        return view('admin.' . $this->module . '.edit', ["clinics"=>$clinics,"govs"=>$govs,"cities"=>$cities,
        "vaccinations"=>$vaccinations,"patientNo"=>$patientNo,'row' => $row, 'module' => $this->module]);

    }


    public function update(Request $request, $id)
    {
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
        $row = $this->patientService->update($request->except([]), $id);
        if ($row) {
            flash()->success(trans('admin.Edit successfull'));
            return redirect('/admin/' . $this->module . '');
        }
        flash()->error(trans('admin.failed to save'));
        return \redirect()->route('patients.index');

    }

    public function destroy($id)
    {
        $row =  $this->patientService->destroy($id);
        if ($row) {
            return \response(['msg'=>__('admin.Deleted successfully')], 200);
        } else {
            return \response(['msg'=>__('admin.Delete Failed')], 400);
        }
        // flash()->success(trans('admin.Delete successfull'));
        // return ()
        // return back();
    }
}
