<?php

use App\Tools\SearchApi;
use Illuminate\Support\Facades\Facade;

class SearchApiFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return SearchApi::class;
    }
}
