<?php

namespace App\Http\Resources;

class ItemResource extends Resource
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
            'stock' => $this->stock,
            'unit_id' => $this->unit_id,
            'price' => $this->price_id,
            'image' => $this->image,
            'unit' => new UnitResource($this->whenLoaded('unit')),
        ];
    }
}
