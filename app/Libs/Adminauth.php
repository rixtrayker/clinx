<?php

namespace App\Libs;

use App\Models\Admin;
use Session;
use Hash;
use Config;

class Adminauth {

    public static function attempt($credentials, $remember = 0) {
        if (Session::get('admin_user')) return true;
        $admin = new Admin();
        extract($credentials);
        $row = $admin->where('email', "=", $email)->wherePublished(1)->first();
        if ($row) {
            if (Hash::check($password, $row->password)) {
                Session::put('admin_user', $row);
                Session::put('admin_permissions',
                    $row->roles->pluck('slug', 'id')->toArray());
                return $row;
            }
            else return false;
        }
        else return false;
    }

    public static function user() {
        $key = Config::get('application.key');
        if (Session::has('admin_user')) {
            $user = Session::get('admin_user');
            return $user;
        }
        else return false;
    }

    public static function id() {
        if (Session::has('admin_user')) {
            $user = Session::get('admin_user');
            return @$user->id;
        }
    }

    public static function guest() {
        if (!Session::has('admin_user')) return true;
        else return false;
    }

    public static function logout() {
        Session::forget('admin_user');
        return true;
    }

    public static function permissions() {
        if (Session::has('admin_permissions')) {
            $permissions = Session::get('admin_permissions');
            return $permissions;
        }
    }
}