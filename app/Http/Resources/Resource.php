<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Resource extends JsonResource
{
    use ResourceTrait;

    public function __construct($resource = [], $statusCode = 200, $message = null)
    {
        parent::__construct($resource);
        $this->statusCode = $statusCode;
        $this->message = $message ?? __('info.success');
    }
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
