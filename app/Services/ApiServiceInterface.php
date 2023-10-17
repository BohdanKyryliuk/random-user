<?php

namespace App\Services;

use Illuminate\Support\Collection;

interface ApiServiceInterface
{
    public function getData(): array;

    public function getItem();

    public function sortItems(Collection $collection): Collection;
}
