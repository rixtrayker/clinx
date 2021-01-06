<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Libs\Misc;
use Request;

class Clinic extends BaseModel {

    protected $guarded = [
    ];
    protected $hidden = [
    ];
    public $table = "clinics";

}
