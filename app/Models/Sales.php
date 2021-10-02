<?php

namespace App\Models;

use App\Models\Traits\HasUuidPrimaryKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Testing\Fluent\Concerns\Has;

class Sales extends Model
{
    use HasFactory;
    use HasUuidPrimaryKey;

    protected $table = 'sales';

    protected $fillable = [
        'transaction_code',
        'transaction_date',
        'customer_id',
        'total_qty',
        'total_discount',
        'total_price',
        'total_pay'
    ];

    public function itemSales()
    {
        return $this->hasMany(ItemSales::class);
    }
}
