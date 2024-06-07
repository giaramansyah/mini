<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Transactions extends Model
{
    use HasFactory;

    protected $table = 'ts_transactions';

    protected $appends = [];

    protected $fillable = [
        'id',
        'invoice_no',
        'total_weight',
        'shipping_fee',
        'total_price',
        'user_code',
        'user_id',
        'shipping_address',
        'shipping_date',
        'expedition_id',
        'shipping_type',
        'transaction_date',
        'created_by',
        'updated_by',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format(config('global.dateformat.view'));
    }

    public function setTotalWeightAttribute($value)
    {
        $this->attributes['total_weight'] = preg_replace("/[^0-9.]/", "", $value);
    }

    public function setShippingFeeAttribute($value)
    {
        $this->attributes['shipping_fee'] = preg_replace("/[^0-9.]/", "", $value);
    }

    public function setTotalPriceAttribute($value)
    {
        $this->attributes['total_price'] = preg_replace("/[^0-9.]/", "", $value);
    }

    public function getTotalWeightAttribute()
    {
        return number_format($this->attributes['total_weight'], 0, null, ',');
    }

    public function getShippingFeeAttribute()
    {
        return number_format($this->attributes['shipping_fee'], 0, null, ',');
    }

    public function getTotalPriceAttribute()
    {
        return number_format($this->attributes['total_price'], 0, null, ',');
    }

    public function getShippingDateAttribute()
    {
        if ($this->attributes['shipping_date']) {
            $carbon = Carbon::createFromFormat(config('global.dateformat.datetime'), $this->attributes['shipping_date']);
            return $carbon->format(config('global.dateformat.view'));
        }

        return '-';
    }

    public function getTransactionDateAttribute()
    {
        if ($this->attributes['transaction_date']) {
            $carbon = Carbon::createFromFormat(config('global.dateformat.datetime'), $this->attributes['transaction_date']);
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
