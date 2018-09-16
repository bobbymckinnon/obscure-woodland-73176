<?php

declare(strict_types=1);

namespace App\Providers;

use App\Tools\SearchApi\Ebay\EbayProductData;
use App\Tools\SearchApi\Ebay\EbaySearchApi;
use App\Tools\SearchApi\ProductDataInterface;
use App\Tools\SearchApi\SearchApiInterface;
use Illuminate\Support\ServiceProvider;

class ToolsServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(SearchApiInterface::class, EbaySearchApi::class);
        $this->app->bind(ProductDataInterface::class, EbayProductData::class);
    }
}
