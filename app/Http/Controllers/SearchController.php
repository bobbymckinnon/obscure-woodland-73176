<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\ProductCollection;
use App\Tools\SearchApi\SearchApiInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SearchController extends Controller
{
    /**
     * @var SearchApiInterface
     */
    private $searchApi;

    /**
     * @param SearchApiInterface $searchApi
     */
    public function __construct(SearchApiInterface $searchApi)
    {
        $this->searchApi = $searchApi;
    }

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $collection = collect();
        if (!array_key_exists('keywords', $request->all())) {
            return $collection->push(['keywords required']);
        }

        $collection = ProductCollection::make($this->searchApi->getData($request->all()));

        return $collection;
    }
}
