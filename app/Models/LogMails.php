<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class LogMails extends Model
{
    use HasFactory;

    protected $table = 'log_mails';

    protected $appends = ['username', 'timestamp', 'times'];

    protected $fillable = [
        'account_id',
        'target',
        'subject',
        'log_response',
    ];

    public function user()
    {
        return $this->belongsTo(Accounts::class, 'account_id', 'id');
    }

    public function getUsernameAttribute()
    {
        if ($this->account_id) {
            return Accounts::find($this->account_id)->username;
        }

        return 'Guest';
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
