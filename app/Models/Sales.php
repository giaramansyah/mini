<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Sales extends Model
{
    use HasFactory;

    protected $table = 'ts_sales';

    protected $appends = [];

    protected $fillable = [
        'id',
        'invoice_no',
        'total_weight',
        'shipping_fee',
        'total_price',
        'total_sale',
        'user_code',
        'shipping_addresss',
        'shipping_date',
        'expedition_id',
        'shipping_type',
        'sales_date',
        'created_by',
        'updated_by',
    ];

    public function detail()
    {
        return $this->hasMany(SalesDetail::class, 'sales_id', 'id');
    }

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

    public function setTotalSaleAttribute($value)
    {
        $this->attributes['total_sale'] = preg_replace("/[^0-9.]/", "", $value);
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

    public function getTotalSaleAttribute()
    {
        return number_format($this->attributes['total_sale'], 0, null, ',');
    }

    public function getShippingDateAttribute()
    {
        if ($this->attributes['shipping_date']) {
            $carbon = Carbon::createFromFormat(config('global.dateformat.datetime'), $this->attributes['shipping_date']);
            return $carbon->format(config('global.dateformat.view'));
        }

        return '-';
    }

    public function getSalesDateAttribute()
    {
        if ($this->attributes['sales_date']) {
            $carbon = Carbon::createFromFormat(config('global.dateformat.datetime'), $this->attributes['sales_date']);
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
