<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminHomeController extends Controller
{
    public function index()
    {
        $pageConfigs = ['pageHeader' => false];
        return view('admin-home', ['pageConfigs' => $pageConfigs]);
    }
}
