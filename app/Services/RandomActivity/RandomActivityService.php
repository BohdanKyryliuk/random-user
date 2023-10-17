<?php

namespace App\Services\RandomActivity;

use App\Exceptions\RandomActivityException;
use App\Http\Entities\Activity;
use App\Services\AbstractBaseApiService;
use App\Services\ApiServiceInterface;
use App\Services\RandomActivity\API\RandomActivitiesApiClient;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Collection;

class RandomActivityService extends AbstractBaseApiService implements ApiServiceInterface
{
    public function __construct(private readonly RandomActivitiesApiClient $client)
    {
    }

    public function getItem()
    {
        try {
            $response = $this->client->getRandomActivity();
            if (empty($response) || isset($response['error'])) {
                throw new RandomActivityException($response['error']);
            }

            $activity = new Activity();
            $activity
                ->setActivity($response['activity'] ?? '')
                ->setType($response['type'] ?? '')
                ->setParticipants($response['participants'] ?? 0)
                ->setPrice($response['price'] ?? 0)
                ->setLink($response['link'] ?? '')
                ->setKey($response['key'] ?? '')
                ->setAccessibility($response['accessibility'] ?? 0);

            return $activity;
        } catch (ConnectionException $exception) {
            throw new RandomActivityException('Could not connect to Random Activity API.', 500, $exception);
        }
    }

    public function sortItems(Collection $collection): Collection
    {
        return $collection
            ->sortBy('type')
            ->map(fn (Activity $activity) => $activity->toArray());
    }
}
