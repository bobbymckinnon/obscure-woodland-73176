<?php

declare(strict_types=1);

namespace App\Tools\SearchApi\Ebay;

use App\Tools\SearchApi\ProductDataInterface;
use App\Tools\SearchApi\SearchApiInterface;
use Illuminate\Support\Collection;

class EbaySearchApi implements SearchApiInterface
{
    const API_ENDPOINT = 'http://svcs.sandbox.ebay.com/services/search/FindingService/v1';

    public function __construct(ProductDataInterface $productData)
    {
        $this->productData = $productData;
    }

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

        return $this->productData->processData($items, $params);
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
            . '&outputSelector(0)=SellerInfo&outputSelector(1)=PictureURLSuperSize&outputSelector(2)=GalleryInfo',
            self::API_ENDPOINT
        );
    }

    /**
     * @param array $params
     *
     * @return string
     */
    public function buildQuery(array $params): string
    {
        $prCount = -1;
        $query = [
            'keywords' => $params['keywords'],
            'sortOrder' => 'BestMatch',
        ];

        if (\array_key_exists('keywords', $params)) {
            $query['keywords'] = $params['keywords'];
        }
        if (\array_key_exists('price_min', $params)) {
            ++$prCount;
            $query['itemFilter.name(' . (string) $prCount . ')'] = 'MinPrice';
            $query['itemFilter.value(' . (string) $prCount . ')'] = $params['price_min'];
        }
        if (\array_key_exists('price_max', $params)) {
            ++$prCount;
            $query['itemFilter.name'][$prCount] = 'MaxPrice';
            $query['itemFilter.value'][$prCount] = $params['price_max'];
        }
        if (\array_key_exists('sorting', $params)) {
            $query['sortOrder'] = 'CurrentPriceHighest';
        }

        return '&' . http_build_query($query, '&');
    }
}
