<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'brand' => new BrandResource($this->whenLoaded('brand')),
            'description' => $this->description,
            'img' => $this->img,
            'name' => $this->name,
            'sku' => $this->sku,
        ];
    }
}
