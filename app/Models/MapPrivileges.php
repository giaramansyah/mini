<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MapPrivileges extends Model
{
    use HasFactory;

    protected $table = 'map_privileges';

    public $timestamps = false;

    protected $fillable = [
        'privilege_group_id',
        'privilege_id',
    ];
}
