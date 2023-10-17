<?php

namespace App\Services\RandomUser\API;

use Illuminate\Support\Facades\Http;

class RandomUserApiClient
{
    const BASE_API_URL = 'https://randomuser.me/api/';

    /**
     * @return array|mixed
     */
    public function getRandomUser(): mixed
    {
        return Http::get(self::BASE_API_URL)->json();
    }
}
