<?php

namespace App\Services;

use Illuminate\Support\Collection;

abstract class AbstractBaseApiService
{

    /**
     * @throws \App\Exceptions\ApiException
     */
    public function getData(): array
    {
        $collection = new Collection();
        for ($i = 0; $i < 10; $i++) {
            $collection->push($this->getItem());
        }

        return $this
            ->sortItems($collection)
            ->toArray();
    }
}
