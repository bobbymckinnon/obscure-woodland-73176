<?php

declare(strict_types=1);

namespace App\Providers;

use App\Tools\Ebay\EbaySearchApi;
use App\Tools\SearchApiInterface;
use Illuminate\Support\ServiceProvider;

class ToolsServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(SearchApiInterface::class, EbaySearchApi::class);
    }
}
