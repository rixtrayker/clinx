<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Config;
use App\Models\Patient;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin.auth:admin');
    }

    /**
     * Show the Admin dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // public function index() {
    //     $pageConfigs = ['pageHeader' => false, 'blankPage' => true];
    //     $date = $this->ArabicDate();
    //     $last_patient = \App\Models\Reservation::whereIn("status",[2])->whereDate('created_date', '=', date('Y-m-d'))->orderBy("created_date","desc")->first();
    //     $number = \App\Models\Config::where("field_name","current_patient")->first();
    //     $flag = \App\Models\Config::where("field_name","nextType")->first();
    //     $next = \App\Models\Config::where("field_name","next_patient")->first();

    //     if (app()->getLocale() == 'en') {
    //         $date = date('Y-M-d');
    //     }
    //     $pageConfigs = ['pageHeader' => false];
    //     return view('admin-home', ['pageConfigs' => $pageConfigs,'date' => $date]);
    // }

    public function index(Request $request) {
        // $pageConfigs = ['pageHeader' => false, 'blankPage' => true];
        // $date = $this->ArabicDate();
        // if (app()->getLocale() == 'en') {
        //     $date = date('Y-M-d');
        // }
        // $pageConfigs = ['pageHeader' => false];
        // return view('admin.reports', ['pageConfigs' => $pageConfigs,'date' => $date]);


        $from = \Carbon\Carbon::now()->firstOfMonth()->format('Y-m-d');
        $to = \Carbon\Carbon::now()->format('Y-m-d');
        $clinic=null;
        return $this->reports($from,$to,$clinic);

    }



    function ArabicDate()
    {
        $months = array("Jan" => "يناير", "Feb" => "فبراير", "Mar" => "مارس", "Apr" => "أبريل", "May" => "مايو", "Jun" => "يونيو", "Jul" => "يوليو", "Aug" => "أغسطس", "Sep" => "سبتمبر", "Oct" => "أكتوبر", "Nov" => "نوفمبر", "Dec" => "ديسمبر");
        $your_date = date('y-m-d'); // The Current Date
        $en_month = date("M", strtotime($your_date));
        foreach ($months as $en => $ar) {
            if ($en == $en_month) {
                $ar_month = $ar;
            }
        }

        $find = array("Sat", "Sun", "Mon", "Tue", "Wed" , "Thu", "Fri");
        $replace = array("السبت", "الأحد", "الإثنين", "الثلاثاء", "الأربعاء", "الخميس", "الجمعة");
        $ar_day_format = date('D'); // The Current Day
        $ar_day = str_replace($find, $replace, $ar_day_format);

        header('Content-Type: text/html; charset=utf-8');
        $standard = array("0","1","2","3","4","5","6","7","8","9");
        $eastern_arabic_symbols = array("٠","١","٢","٣","٤","٥","٦","٧","٨","٩");
        $current_date = $ar_day.' '.date('d').' / '.$ar_month.' / '.date('Y');
        $arabic_date = str_replace($standard, $eastern_arabic_symbols, $current_date);

        return $arabic_date;
    }

    public function getCurrent()
    {
        $res = Reservation::whereDate('created_date',date('Y-m-d'))->where('status',0)->first();
        $patient_id = $res ? $res->patient_id : null;
        $row = Patient::find($patient_id);
        return view('admin.patients.current',['row'=>$row]);
    }

    public function nextPatient()
    {
        $rowsE = Reservation::whereNotNull("extra")->whereIn("status",[2])->
            whereDate('created_date', date('Y-m-d'))->orderBy("created_date","asc")->get();
        $rowsN = Reservation::whereNull("extra")->whereIn("status",[2])->
            whereDate('created_date', date('Y-m-d'))->orderBy("created_date","asc")->get();

        $row = Reservation::whereDate('created_date',date('Y-m-d'))->where('status',0)->first();
        $row->status = 1;
        $row->save();

        if (sizeof($rowsE) > 0) {
            $rowsE[0]->status = 0;
            $rowsE[0]->save();

        }
        elseif(sizeof($rowsN) > 0){
            $rowsN[0]->status = 0;
            $rowsN[0]->save();

             // ->patient->patient_number}} - $rowsN[0]->patient->name}}
        }
        return \redirect()->back();

    }
        // $reports = $this->getReport();
    public function getReports()
    {
        $from = !empty(\request()->input('from')) ? \request()->input('from'):null;
        $to = !empty(\request()->input('to')) ? \request()->input('to'):null;
        $clinic = !empty(\request()->input('clinic_id')) ? \request()->input('clinic_id'):null;
        return $this->reports($from,$to,$clinic);
    }

    public function reports($from,$to,$clinic)
    {

        $q = Reservation::whereIn('status',[0,1,2]);
        if($from)
            $q->whereDate('created_date','>=',$from);

        if($to)
            $q->whereDate('created_date','<=',$to);

        if($clinic)
            $q->where('clinic_id','=',$clinic);

        $res = $q->get();

        $res1 = $res->where('reservation_type',1)->count();
        $res2 = $res->where('reservation_type',2)->count();
        $res3 = $res->where('reservation_type',3)->count();

        $rev1 = $res->where('reservation_type',1)->count() * Config::where('field_name','c_price')->first()->value + $res->where('reservation_type',1)->sum('extra');
        $rev2 = $res->where('reservation_type',2)->count() * Config::where('field_name','f_price')->first()->value;
        $rev3 = $res->where('reservation_type',3)->count() * Config::where('field_name','v_price')->first()->value;

        $resD = $res->where('reservation_type',1)->whereNotNull('discount')->count();
        $revD = $res->where('reservation_type',1)->whereNotNull('discount')->sum('discount');
        $resT = $res->count();
        $revT = $rev1 + $rev2 + $rev3 - $revD;

        $data = [
            'res1'=>$res1,
            'res2'=>$res2,
            'res3'=>$res3,
            'rev1'=>$rev1,
            'rev2'=>$rev2,
            'rev3'=>$rev3,
            'resD'=>$resD,
            'revD'=>$revD,
            'resT'=>$resT,
            'revT'=>$revT,
            'from'=>$from,
            'to'=>$to,
            'clinic_id'=>$clinic,
        ];

        // dd($data);

        return view('admin.reports',$data);
    }

    public function getQueue()
    {
        return view('admin.queue');
    }
}
