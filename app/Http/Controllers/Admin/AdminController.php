<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Administrator;
use Illuminate\Http\Request;
use App\Libs\ACL;
use App\Libs\Adminauth;
use Config;
use App\Models\Admin;
use Session;
use Mail;
use Hash;
use App;

class Admins extends Administrator {

    public $model;
    public $module;
    public $rules;

    public function __construct(Admin $model) {
        parent::__construct();
        $this->module = 'admins';
        $this->model = $model;
        $this->rules = [
            'name' => 'required',
            'mobile' => 'required',
            'email' => 'required|email|unique:admins,email',
            "password" => "required",
        ];
    }

}
