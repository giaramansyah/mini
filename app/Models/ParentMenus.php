<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParentMenus extends Model
{
    use HasFactory;

    protected $table = 'ms_parent_menus';

    public function menus()
    {
        return $this->hasMany(Menus::class, 'parent_menu_id', 'id');
    }
}
