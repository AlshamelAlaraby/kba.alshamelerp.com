<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductStoreResource extends JsonResource
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
            'max_quantity' => $this->max_quantity,
            'min_quantity' => $this->min_quantity,
            'price' => $this->price,
            'slug' => $this->slug,
            'step' => $this->step,
            'product' => new ProductResource($this->whenLoaded('product'))
        ];
    }
}
