<?php

declare(strict_types=1);

namespace App\Tools\SearchApi;

use Illuminate\Support\Collection;

interface ProductDataInterface
{
    /**
     * @param $items
     * @param array $params
     *
     * @return Collection
     */
    public function processData($items, array $params): Collection;

    /**
     * @param Collection $collection
     *
     * @return Collection
     */
    public function sortData(Collection $collection): Collection;
}
