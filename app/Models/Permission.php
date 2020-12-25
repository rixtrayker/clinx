<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Kodeine\Acl\Models\Eloquent\Permission as perm;

class Permission extends perm
{
    use HasFactory;
}
