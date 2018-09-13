<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SearchController extends Controller
{
    /**
     * @param  Request  $request
     * @return Response
     */
    public function index(Request  $request)
    {
        return view('welcome', []);
    }
}