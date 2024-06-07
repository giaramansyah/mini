<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $table = 'ms_products';

    protected $appends = [];

    protected $fillable = [
        'id',
        'category_id',
        'name',
        'weight',
        'price',
        'stock',
        'sale',
        'created_by',
        'updated_by',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format(config('global.dateformat.view'));
    }

    public function setWeightAttribute($value)
    {
        $this->attributes['weight'] = preg_replace("/[^0-9.]/", "", $value);
    }

    public function setPriceAttribute($value)
    {
        $this->attributes['price'] = preg_replace("/[^0-9.]/", "", $value);
    }

    public function setStockAttribute($value)
    {
        $this->attributes['stock'] = preg_replace("/[^0-9.]/", "", $value);
    }

    public function setSaleAttribute($value)
    {
        $this->attributes['sale'] = preg_replace("/[^0-9.]/", "", $value);
    }

    public function getWeightAttribute()
    {
        return number_format($this->attributes['weight'], 0, null, ',');
    }

    public function getPriceAttribute()
    {
        return number_format($this->attributes['price'], 0, null, ',');
    }

    public function getStockAttribute()
    {
        return number_format($this->attributes['stock'], 0, null, ',');
    }

    public function getSaleAttribute()
    {
        return number_format($this->attributes['sale'], 0, null, ',');
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
