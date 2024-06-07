<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Privileges extends Model
{
    use HasFactory;

    protected $table = 'ms_privileges';

    public $timestamps = false;

    protected $appends = ['menu', 'module_desc'];

    protected $fillable = [
        'code',
        'menu_id',
        'modules',
        'desc',
    ];

    public function menu()
    {
        return $this->belongsTo(Menus::class, 'menu_id', 'id');
    }

    public function privilegeGroup()
    {
        return $this->belongsToMany(PrivilegeGroups::class, 'map_privileges', 'privilege_id', 'privilege_group_id');
    }

    public function getMenuAttribute()
    {
        if ($this->id) {
            return self::find($this->id)->menu()->first()->toArray();
        }

        return [];
    }

    public function getModuleDescAttribute()
    {
        if ($this->modules) {
            $modulesArr = array_combine(config('global.modules.code'), config('global.modules.desc'));
            return __($modulesArr[$this->modules]);
        }

        return null;
    }
}
