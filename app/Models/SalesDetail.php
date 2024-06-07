<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesDetail extends Model
{
    use HasFactory;

    protected $table = 'dt_sales';

    protected $appends = [];

    public $timestamps = false;

    protected $fillable = [
        'id',
        'sales_id',
        'product_id',
        'invoice_no',
        'qty',
        'weight',
        'unit_price',
        'discount',
        'price',
    ];

    public function sales()
    {
        return $this->belongsTo(Sales::class, 'sales_id', 'id');
    }

    public function setQtyAttribute($value)
    {
        $this->attributes['qty'] = preg_replace("/[^0-9.]/", "", $value);
    }

    public function setWeightAttribute($value)
    {
        $this->attributes['weight'] = preg_replace("/[^0-9.]/", "", $value);
    }

    public function setUnitPriceAttribute($value)
    {
        $this->attributes['unit_price'] = preg_replace("/[^0-9.]/", "", $value);
    }

    public function setPriceAttribute($value)
    {
        $this->attributes['price'] = preg_replace("/[^0-9.]/", "", $value);
    }

    public function getQtyAttribute()
    {
        return number_format($this->attributes['qty'], 0, null, ',');
    }

    public function getWeightAttribute()
    {
        return number_format($this->attributes['weight'], 0, null, ',');
    }

    public function getUnitPriceAttribute()
    {
        return number_format($this->attributes['unit_price'], 0, null, ',');
    }

    public function getPriceAttribute()
    {
        return number_format($this->attributes['price'], 0, null, ',');
    }
}
