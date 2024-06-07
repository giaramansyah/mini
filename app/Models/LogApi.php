<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class LogApi extends Model
{
    use HasFactory;

    protected $table = 'log_api';

    protected $appends = ['privilege', 'timestamp', 'times'];

    protected $fillable = [
        'privilege_id',
        'description',
        'ip_address',
        'log_request',
        'log_response',
    ];

    public function getPrivilegeAttribute()
    {
        if ($this->privilege_id) {
            if (in_array($this->privilege_id, config('global.privilege.id'))) {
                $staticCode = array_combine(config('global.privilege.id'), config('global.privilege.code'));
                return $staticCode[$this->privilege_id];
            } else {
                $privilege = Privileges::find($this->privilege_id);
                if ($privilege) {
                    return $privilege->code;
                }
            }
        }

        return null;
    }

    public function getTimestampAttribute()
    {
        $date = Carbon::createFromFormat(config('global.dateformat.datetime'), $this->attributes['created_at']);
        return $date->format(config('global.dateformat.view'));
    }

    public function getTimesAttribute()
    {
        $date = Carbon::createFromFormat(config('global.dateformat.datetime'), $this->attributes['created_at']);
        return $date->format(config('global.dateformat.time'));
    }
}
