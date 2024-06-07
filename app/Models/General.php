<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class General extends Model
{
    use HasFactory;

    protected $table = 'ms_general';

    protected $primaryKey = 'key_id';

    protected $keyType = 'string';

    public $timestamps = false;

    protected $fillable = [
        'key_id',
        'value',
    ];
}
