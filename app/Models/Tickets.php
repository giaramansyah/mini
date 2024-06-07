<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Tickets extends Model
{
    use HasFactory;

    protected $table = 'ts_tickets';

    protected $appends = [];

    protected $fillable = [
        'ticket_code',
        'ticket_date',
        'customer_id',
        'subject',
        'product_id',
        'issue',
        'created_by',
        'updated_by',
    ];

    public function detail()
    {
        return $this->hasMany(TicketsDetail::class, 'ticket_id', 'id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format(config('global.dateformat.view'));
    }

    public function getTicketDateAttribute()
    {
        if ($this->attributes['ticket_date']) {
            $carbon = Carbon::createFromFormat(config('global.dateformat.datetime'), $this->attributes['ticket_date']);
            return $carbon->format(config('global.dateformat.view'));
        }

        return '-';
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
