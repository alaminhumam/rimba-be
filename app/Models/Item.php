<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    use Traits\HasUuidPrimaryKey;

    protected $fillable = [
        'name',
        'unit_id',
        'price',
        'stock',
        'image'
    ];

    protected $with = [
        'unit'
    ];

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}
