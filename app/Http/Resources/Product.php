<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Product extends JsonResource
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
            /*
            'merchant_id' => $this->merchant_id,
            'merchant_logo_url' => $this->name,
            'item_id' => $this->email,
            'click_out_link' => $this->created_at,
            'main_photo_url' => $this->updated_at,
            'price' => $this->email,
            'price_currency' => $this->created_at,
            'shipping_price' => $this->updated_at,
            'title' => $this->email,
            'valid_until' => $this->created_at,
            'brand' => $this->updated_at,
            */
        ];
    }
}
