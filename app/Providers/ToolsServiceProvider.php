<?php

namespace App\Providers;

use App\Tools\SearchApi;
use Illuminate\Support\ServiceProvider;
use App\Tools\SomeExampleClass;

class ToolsServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(SearchApi::class, function () {
            return new SomeExampleClass;
        });
    }
}