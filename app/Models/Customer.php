<?php

namespace App\Models;

use App\Models\Traits\HasUuidPrimaryKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    use HasUuidPrimaryKey;

    protected $fillable = [
        'name',
        'address',
        'contact',
        'email',
        'image'
    ];

    public function discounts()
    {
        return $this->belongsToMany(Discount::class, 'discount_customer');
    }

    public function discountActive()
    {
        return $this->discounts()->where('is_active', true)->first();
    }
}
