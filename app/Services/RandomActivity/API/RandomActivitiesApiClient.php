<?php

namespace App\Services\RandomActivity\API;

use Illuminate\Support\Facades\Http;

class RandomActivitiesApiClient
{
    const BASE_API_URL = 'https://www.boredapi.com/api/activity';

    /**
     * @return array|mixed
     */
    public function getRandomActivity(): mixed
    {
        return Http::get(self::BASE_API_URL)->json();
    }
}
