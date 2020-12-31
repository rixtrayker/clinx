<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Request;

class Patient extends BaseModel
{
    protected $guarded = [
        'reset_token',
        'confirm_token',
        'token',
        'password_confirmation',
    ];
    public $table = "patients";
    protected $hidden = ['password', 'remember_token', 'confirmed', 'published',
        'admin_id', 'reset_token', 'confirm_token', 'token', 'updated_at'];
}
