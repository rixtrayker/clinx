<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Permission as perm;

// use Illuminate\Database\Eloquent\Model;
class Permission extends perm
{
    use HasFactory;
}
