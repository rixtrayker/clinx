<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Request;

class Patient extends BaseModel
{
    protected $guarded = [];
    //     'reset_token',
    //     'confirm_token',
    //     'token',
    //     'password_confirmation',
    // ];
    public $table = "patients";
    protected $hidden = ['password', 'remember_token', 'confirmed', 'published',
        'admin_id', 'reset_token', 'confirm_token', 'token', 'updated_at'];

    // protected $casts = [
    //     'chronic_diseases' => 'array',
    // ];

    // public function setChronicDiseasesAttribute($value)
    // {
    //     $this->attributes['chronic_diseases'] = json_encode($value);
    // }
    // public function getChronicDiseasesAttribute()
    // {
    //     return json_decode($this->attributes['chronic_diseases'] );
    // }

}
