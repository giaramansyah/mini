<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class TicketsDetail extends Model
{
    use HasFactory;
    
    protected $table = 'dt_tickets';

    protected $appends = [];

    protected $fillable = [
        'ticket_id',
        'status',
        'user_id',
        'update_date',
    ];

    public function ticket()
    {
        return $this->belongsTo(Tickets::class, 'ticket_id', 'id');
    }

    public function getUpdateDateAttribute()
    {
        if ($this->attributes['update_date']) {
            $carbon = Carbon::createFromFormat(config('global.dateformat.datetime'), $this->attributes['update_date']);
            return $carbon->format(config('global.dateformat.view'));
        }

        return '-';
    }
}
