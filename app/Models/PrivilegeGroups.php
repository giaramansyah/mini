<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrivilegeGroups extends Model
{
    use HasFactory;

    protected $table = 'ms_privilege_groups';

    protected $fillable = [
        'name',
        'description',
        'created_by',
        'updated_by',
    ];

    public function privileges()
    {
        return $this->belongsToMany(Privileges::class, 'map_privileges', 'privilege_group_id', 'privilege_id');
    }

    public function account()
    {
        return $this->hasMany(Accounts::class, 'privilege_group_id', 'id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format(config('global.dateformat.view'));
    }

    public function getCreatedByAttribute()
    {
        if ($this->attributes['created_by'] == 0) {
            return config('global.accounts')[0];
        } else {
            return Accounts::find($this->attributes['created_by'])->username;
        }
    }

    public function getUpdatedByAttribute()
    {
        if ($this->attributes['updated_by'] == 0) {
            return config('global.accounts')[0];
        } else {
            return Accounts::find($this->attributes['updated_by'])->username;
        }
    }
}
