<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Accounts extends Authenticatable implements JWTSubject
{
    use HasFactory;

    protected $table = 'ms_accounts';

    protected $appends = ['fullname', 'privilege_group'];

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'username',
        'password',
        'hash',
        'is_new',
        'is_active',
        'is_trash',
        'is_login',
        'is_locked',
        'is_author',
        'password_request',
        'last_password_request',
        'expire_password_request',
        'last_login',
        'created_by',
        'updated_by',
        'privilege_group_id',
    ];

    protected $hidden = [
        'password',
        'hash',
        'remember_token',
    ];

    public function privilegeGroup()
    {
        return $this->belongsTo(PrivilegeGroups::class, 'privilege_group_id', 'id');
    }

    public function logs()
    {
        return $this->hasMany(LogAccounts::class, 'account_id', 'id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format(config('global.dateformat.view'));
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function getFullnameAttribute()
    {
        if ($this->first_name) {
            return implode(' ', [$this->first_name, $this->last_name]);
        }

        return null;
    }

    public function getLastLoginAttribute()
    {
        if ($this->attributes['last_login']) {
            $carbon = Carbon::createFromFormat(config('global.dateformat.datetime'), $this->attributes['last_login']);
            return $carbon->format(config('global.dateformat.view'));
        }

        return '-';
    }

    public function getPrivilegeGroupAttribute()
    {
        if ($this->id) {
            return self::find($this->id)->privilegeGroup()->first()->name;
        }

        return null;
    }

    public function getCreatedByAttribute()
    {
        if ($this->attributes['created_by'] == 0) {
            return config('global.accounts')[0];
        } else {
            return self::find($this->attributes['created_by'])->username;
        }
    }

    public function getUpdatedByAttribute()
    {
        if ($this->attributes['updated_by'] == 0) {
            return config('global.accounts')[0];
        } else {
            return self::find($this->attributes['updated_by'])->username;
        }
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
