<?php

namespace App\Models;

use App\Models\Traits\HasUuidPrimaryKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscountCustomer extends Model
{
    use HasFactory;

    protected $table = 'discount_customer';

    protected $fillable = [
        'discount_id',
        'customer_id',
    ];
}
