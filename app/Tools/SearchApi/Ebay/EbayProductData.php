<?php

declare(strict_types=1);

namespace App\Tools\SearchApi\Ebay;

use App\Http\Resources\ProductResource;
use App\Tools\SearchApi\ProductDataInterface;
use Illuminate\Support\Collection;

class EbayProductData implements ProductDataInterface
{
    const DATA_SUCCESS = 'Success';

    /**
     * @param $items
     * @param array $params
     *
     * @return Collection
     */
    public function processData($items, array $params): Collection
    {
        $collection = collect();

        if (self::DATA_SUCCESS !== $items->findItemsByKeywordsResponse[0]->ack[0]) {
            return $collection;
        }

        $itemResponse = $items->findItemsByKeywordsResponse[0]->searchResult[0];
        if (isset($itemResponse->item)) {
            foreach ($itemResponse->item as $item) {
                $product = ProductResource::make($item);
                $collection->push($product);
            }
        }

        $collection = $collection->sortBy(function ($item) {
            return (float) $item->resource->sellingStatus[0]->currentPrice[0]->__value__;
        });

        if (\array_key_exists('sorting', $params) && 'by_price_asc' === $params['sorting']) {
            $collection = $this->sortData($collection);
        }

        return $collection;
    }

    /**
     * @param Collection $collection
     *
     * @return Collection
     */
    public function sortData(Collection $collection): Collection
    {
        return $collection->sortBy(function ($item) {
            return (float) $item->resource->sellingStatus[0]->currentPrice[0]->__value__;
        });
    }
}
