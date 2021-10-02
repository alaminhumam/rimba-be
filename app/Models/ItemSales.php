<?php

namespace App\Models;

use App\Models\Traits\HasUuidPrimaryKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemSales extends Model
{
    use HasFactory;
    use HasUuidPrimaryKey;

    protected $fillable = [
        'sales_id',
        'item_id',
        'qty'
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
