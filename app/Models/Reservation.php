<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Libs\Misc;
use Request;

class Reservation extends BaseModel
{
    protected $guarded = [
    ];
    protected $hidden = [
    ];
    // public $table = "patient_reservations";

    public function patient()
    {
        return $this->belongsTo("\App\Models\Patient");
    }
    // public function reservations(){
    //   return $this->belongsTo("\App\Models\Diagnos","diagnos_id");
    // }
}
