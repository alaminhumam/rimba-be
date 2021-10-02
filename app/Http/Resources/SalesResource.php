<?php

namespace App\Http\Resources;

class SalesResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'transaction_code' => $this->transaction_code,
            'transaction_date' => $this->transaction_date,
            'customer_id' => $this->customer_id,
            'total_qty' => $this->total_qty,
            'total_discount' => $this->total_discount,
            'total_price' => $this->total_price,
            'total_pay' => $this->total_pay,
            'item_sales' => new ItemSalesCollection($this->itemSales),
        ];
    }
}
