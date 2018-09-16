<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray($request): array
    {
        $result = [
            'provider' => $this->title[0],
            'item_id' => $this->itemId[0],
            'provider' => $this->globalId[0],
            'merchant_id' => $this->sellerInfo[0]->sellerUserName[0],
            'merchant_logo' => '',
            'click_out_link' => $this->viewItemURL[0],
            'price' => $this->sellingStatus[0]->currentPrice[0]->__value__,
            'price_currency' => $this->sellingStatus[0]->currentPrice[0]->{'@currencyId'},
            'title' => $this->title[0],
            'valid_until' => $this->listingInfo[0]->endTime[0],
        ];

        if (isset($this->shippingInfo[0]->shippingServiceCost[0])) {
            $result = array_merge($result, [
                'shipping_price' => $this->shippingInfo[0]->shippingServiceCost[0]->__value__,
            ]);
        }
        if (isset($this->galleryInfoContainer)) {
            $largeImg = array_filter($this->galleryInfoContainer[0]->galleryURL, function ($img) {
                return 'Large' === $img->{'@gallerySize'};
            });

            $result = array_merge($result, [
                'main_photo_url' => $largeImg[0]->{'__value__'},
            ]);
        }

        return $result;
    }
}
