<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\ProductCollection;
use App\Tools\SearchApiInterface;
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
        return ProductCollection::make($this->searchApi->getData($request->all()));
    }
}
