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
            //'profile_img' => 'image|mimes:jpeg,png,jpg|required',
            'mobile' => 'required',
            'email' => 'required|email|unique:admins,email',
            "password" => "required|confirmed",
        ];
    }

    public function getIndex(Request $request) {
        authorize('view-'.$this->module);
        $rows = $this->model->latest();
        $rows = $rows->get();
        return view('admin.' . $this->module . '.index', ['rows' => $rows, 'module' => $this->module]);
    }

    public function getView($id) {
        authorize('view-'.$this->module);
        $row = $this->model->findOrFail($id);
        return view('admin.' . $this->module . '.view', ['row' => $row, 'module' => $this->module]);
    }

    public function getCreate() {
        authorize('view-'.$this->module);
        $row = $this->model;
        $roles = \App\Models\Role::all()->pluck('name','id');
        return view('admin.' . $this->module . '.create', ['row' => $row, 'module' => $this->module, 'roles' => $roles]);
    }

    public function postCreate(Request $request) {
        authorize('view-'.$this->module);
        $this->validate($request, $this->rules);
        if ($row = $this->model->create($request->all())) {
          $row->admin_id = Adminauth::user()->id;
          $row->super_admin=1;
          $field = 'profile_img';
          if ($request->hasFile($field) && $request->file($field)->isValid()) {
              $uploadPath = 'uploads/admin_images/';
              $image = $request->file($field);
              $fileName = str_random(10) . time() . '.' . $image->getClientOriginalExtension();
              $request->file($field)->move($uploadPath, $fileName);
              $filePath = $uploadPath . $fileName;
              $row->$field = $fileName;
          }
          $row->save();

            //////////////////////////////////////send confirm email
            // $configs = Session::get('configs');
            // try {
            //     Mail::send('emails.admins.confirm', ['row' => $row, 'configs' => $configs], function ($mail) use ($row, $configs) {
            //         $mail->to($row->email, $row->name)->subject(trans("admin.Welcome to") . ' ' . env('SITE_TITLE'));
            //     });
            // } catch (Exception $e) {
            //     // echo 'Caught exception: ', $e->getMessage(), "\n";
            // }
            //////////////////////////////////////////
            flash()->success(trans('admin.Add successfull'));
            return redirect(App::getLocale().'/admin/' . $this->module . '');
        }
        flash()->error(trans('admin.failed to save'));
    }

    public function getEdit($id) {
        authorize('view-'.$this->module);
        $row = $this->model->findOrFail($id);
        $roles = \App\Models\Role::all()->pluck('name','id');
        return view('admin.' . $this->module . '.edit', ['row' => $row, 'module' => $this->module, 'roles' => $roles]);
    }

    public function postEdit($id, Request $request) {
        authorize('view-'.$this->module);
        $row = $this->model->findOrFail($id);
        $this->rules['email'] = $this->rules['email'] . "," . $row->id;
        $this->rules['password'] = "";
        if($request->input('password')){
          $this->rules['password'] = "confirmed";
        }
        $this->rules['profile_img'] = "image|mimes:jpeg,png,jpg";
        $this->validate($request, $this->rules);
        if ($row->update($request->except(['password']))) {
            if (trim($request->input('password'))) {
                $row->password = trim($request->input('password'));
                $row->save();
            }
            $field = 'profile_img';
            if ($request->hasFile($field) && $request->file($field)->isValid()) {
                $uploadPath = 'uploads/admin_images/';
                $image = $request->file($field);
                $fileName = str_random(10) . time() . '.' . $image->getClientOriginalExtension();
                $request->file($field)->move($uploadPath, $fileName);
                $filePath = $uploadPath . $fileName;
                $row->$field = $fileName;
            }
            $row->save();
            flash()->success(trans('admin.Edit successfull'));
            return redirect(App::getLocale().'/admin/' . $this->module . '/edit/' . $row->id);
        }
        flash()->error(trans('admin.failed to save'));
    }

    public function getDelete($id) {
        authorize('view-'.$this->module);
        $row = $this->model->findOrFail($id);
        $row->delete();
        flash()->success(trans('admin.Delete successfull'));
        return back();
    }
    public function getPublish($value, $id) {
        authorize('view-'.$this->module);
        $row = $this->model->findOrFail($id);
        if ($value == 0) {
            $row->published = 0;
            $published = trans('admin.Unpublished');
        } else {
            $row->published = 1;
            $published = trans('admin.Published');
        }
        $row->save();
        flash()->success($published . " " . trans('admin.Successfull'));
        return back();
    }

    public function getChangePassword() {
        $row = $this->model->findOrFail(Adminauth::user()->id);
        return view('admin.' . $this->module . '.change-password', ['row' => $row, 'module' => $this->module]);
    }

    public function postChangePassword(Request $request) {
        $row = $this->model->findOrFail(Adminauth::user()->id);
        $rules['password'] = 'required|confirmed|min:4';
        $this->validate($request, $rules);
        if (!Hash::check(trim($request->input('old_password')), $row->password)) {
            flash()->error(trans('admin.Check your old password'));
            return back()->withInput();
        }
        if (trim($request->input('password'))) {
            $row->password = trim($request->input('password'));
            $row->save();
        }
        flash()->success(trans('admin.Password has been changed'));
        return redirect(App::getLocale().'/admin/' . $this->module . '/change-password');
    }

    public function getEditAccount() {
        $row = $this->model->findOrFail(Adminauth::user()->id);
        return view('admin.' . $this->module . '.edit-account', ['row' => $row, 'module' => $this->module]);
    }

    public function postEditAccount(Request $request) {
        $row = $this->model->findOrFail(Adminauth::user()->id);
        $rules['name'] = "required";
        $rules['email'] = 'required|email|unique:admins,email' . "," . $row->id;
        $this->validate($request, $rules);
        if ($row->update($request->except(['profile_img','password', 'published']))) {
			      $field = 'profile_img';
            if ($request->hasFile($field) && $request->file($field)->isValid()) {
                $uploadPath = 'uploads/admin_images/';
                $image = $request->file($field);
                $fileName = str_random(10) . time() . '.' . $image->getClientOriginalExtension();
                $request->file($field)->move($uploadPath, $fileName);
                $filePath = $uploadPath . $fileName;
                $row->$field = $fileName;
				        $row->save();
            }
		 	  Session::put('admin_user', $row);

            flash()->success(trans('admin.Edit successfull'));
            return redirect(App::getLocale().'/admin/' . $this->module . '/edit-account');
        }
        flash()->error(trans('admin.failed to save'));
    }

}
