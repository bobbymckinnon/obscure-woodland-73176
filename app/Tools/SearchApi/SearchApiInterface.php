<?php

declare(strict_types=1);

namespace App\Tools\SearchApi;

use Illuminate\Support\Collection;

interface SearchApiInterface
{
    /**
     * @param array $params
     *
     * @return Collection
     */
    public function getData(array $params): Collection;

    /**
     * @return string
     */
    public function getEndpoint(): string;

    /**
     * @param array $params
     *
     * @return string
     */
    public function buildQuery(array $params): string;
}
