<?php

namespace App\Http\Resources;

class CustomerResource extends Resource
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
            'name' => $this->name,
            'address' => $this->address,
            'contact' => $this->contact,
            'email' => $this->email,
            'image' => $this->image,
            $this->mergeWhen($this->discounts()->count() > 0, [
                'discounts' => new DiscountCollection($this->discounts)
            ])
        ];
    }
}
