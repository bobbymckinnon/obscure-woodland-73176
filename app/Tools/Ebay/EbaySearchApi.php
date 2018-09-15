<?php

declare(strict_types=1);

namespace App\Tools\Ebay;

use App\Http\Resources\ProductResouce;
use App\Tools\SearchApiInterface;
use Illuminate\Support\Collection;

class EbaySearchApi implements SearchApiInterface
{
    const ENDPOINT = 'http://svcs.sandbox.ebay.com/services/search/FindingService/v1';

    /**
     * @param array $params
     *
     * @return Collection
     */
    public function getData(array $params): Collection
    {
        $collection = collect();

        $client = new \GuzzleHttp\Client();
        $response = $client->get($this->getEndpoint() . $this->buildQuery($params));

        $items = json_decode($response->getBody()->getContents());
        if ('Success' !== $items->findItemsByKeywordsResponse[0]->ack[0]) {
            return $collection;
        }

        $itemResponse = $items->findItemsByKeywordsResponse[0]->searchResult[0];
        if (isset($itemResponse->item)) {
            foreach ($itemResponse->item as $item) {
                $product = ProductResouce::make($item);
                $collection->push($product);
            }
        }

        return $collection;
    }

    /**
     * @return string
     */
    public function getEndpoint(): string
    {
        return sprintf('%s?OPERATION-NAME=findItemsByKeywords'
            . '&SERVICE-VERSION=1.0.0'
            . '&SECURITY-APPNAME=' . getenv('EBAY_API_APPNAME')
            . '&RESPONSE-DATA-FORMAT=JSON'
            . '&REST-PAYLOAD'
            . '&outputSelector(0)=SellerInfo&outputSelector(1)=PictureURLSuperSize&outputSelector(2)=GalleryInfo'
            . '&keywords=auto'
            . '&sortOrder=PricePlusShippingHighest',
            self::ENDPOINT
        );
    }

    /**
     * @param array $params
     *
     * @return string
     */
    public function buildQuery(array $params): string
    {
        $query = [];
        $prCount = -1;

        if (\array_key_exists('keywords', $params)) {
            $query['keywords'] = $params['keywords'];
        }
        if (\array_key_exists('price_min', $params)) {
            ++$prCount;
            $query['itemFilter.name(' . (string) $prCount . ')'] = 'MinPrice';
            $query['itemFilter.value(' . (string) $prCount . ')'] = $params['price_min'];
        }
        if (\array_key_exists('price_max', $params)) {
            $query['itemFilter.name'][$prCount++] = 'MaxPrice';
            $query['itemFilter.value'][$prCount] = $params['price_max'];
        }

        return http_build_query($query, '&');
    }
}
