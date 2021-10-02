<?php

namespace App\Models;

use App\Models\Traits\HasUuidPrimaryKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;
    use HasUuidPrimaryKey;

    protected $fillable = [
        'amount',
        'type',
        'is_active'
    ];

    public function customers()
    {
        return $this->belongsToMany(Customer::class, 'discount_customer');
    }
}
