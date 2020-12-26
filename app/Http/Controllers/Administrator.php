<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Libs\ACL;
use App\Libs\Adminauth;
use Request;
use Session;
use Form;
use App;
use Config;
class Administrator extends Controller
{
    public function __construct()
    {
        $this->middleware('AdminAuthenticate');
        $this->middleware('AclAuthenticate', ['except' => ['getDeleteImage']]);


        $this->middleware('acl');
        Session::put('locales', Config::get('app.locales'));

    }
}
