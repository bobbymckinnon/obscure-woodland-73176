<?php

declare(strict_types=1);

namespace App\Tools\SearchApi;

use Illuminate\Support\Collection;

interface SearchApiInterface
{
    public function getData(array $params): Collection;

    public function getEndpoint(): string;

    public function buildQuery(array $params): string;
}
