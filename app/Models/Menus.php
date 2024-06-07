<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menus extends Model
{
    use HasFactory;

    protected $table = 'ms_menus';

    public function parentMenu()
    {
        return $this->belongsTo(ParentMenus::class, 'parent_menu_id', 'id');
    }

    public function privileges()
    {
        return $this->hasMany(Privileges::class, 'menu_id', 'id');
    }
}
