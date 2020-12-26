<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
use Auth;
use Session;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('AdminAuthenticate');
        $this->middleware('AclAuthenticate', ['except' => ['getDeleteImage']]);

        $this->middleware('acl');
        // Session::put('locales', Config::get('app.locales'));
    }
    public function getUpdatePassword()
    {
        return view('admin.profile.updatePassword');
    }
    public function postUpdatePassword(Request $request)
    {
        $row = $this->model->findOrFail(Auth::id());
        $this->validate($request, [
            'password' => 'required|confirmed'
        ]);
        try {
            $row->password = Hash::make($request['password']);
            flash()->success(trans('admin.Password updated successfull'));
            return redirect('/admin/' . $this->module . '');
        } catch (\Exception $e) {
            flash()->error(trans('admin.failed to save'));
        }
    }
}
