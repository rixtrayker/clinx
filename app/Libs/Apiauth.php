<?php

namespace App\Libs;

use App\Models\MobileUser;
use Session;
use Hash;
use Config;

class Apiauth {

    public static function attempt($credentials, $remember = 0) {
        extract($credentials);
        $row = MobileUser::where('mobile', "=", $mobile)->wherePublished(1)->whereConfirmed(1)->first();
        if ($row) {
            if (Hash::check($password, $row->password)) {
                Session::put('admin_user', $row);
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
