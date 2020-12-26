<?php

namespace App\Libs;

use App\Libs\Adminauth;
use App\Models\Role;
use App\Models\Group_permission;

class ACL {

    private static $allowed = ["dashboard"];

    static function can($action, $userId = NULL) {
        if (in_array($action, self::$allowed)) {
            return true;
        }
        $user = Adminauth::user();
        if (!$user) return redirect("admin/auth/login");
        if (@$user->super_admin) return true;
        $permissions = Group_permission::where('role_id',$user->role_id)->get()->pluck('permission_id')->toArray();

      $permissions =  \App\Models\Permission::whereIn('id',$permissions)->get()->pluck('slug')->toArray();
        if ($permissions) {
            if (in_array($action, $permissions)) {
                return true;
            }
        }
        return false;
    }

    static function cant($action, $user_id = NULL) {
        return !(self::can($action));
    }
}
?>
