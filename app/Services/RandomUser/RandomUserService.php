<?php

namespace App\Services\RandomUser;

use App\Exceptions\RandomUserException;
use App\Http\Entities\User;
use App\Services\AbstractBaseApiService;
use App\Services\ApiServiceInterface;
use App\Services\RandomUser\API\RandomUserApiClient;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Collection;

class RandomUserService extends AbstractBaseApiService implements ApiServiceInterface
{
    public function __construct(private readonly RandomUserApiClient $client)
    {
    }

    /**
     * @return \App\Http\Entities\User
     * @throws \App\Exceptions\RandomUserException
     */
    public function getItem(): User
    {
        try {
            $response = $this->client->getRandomUser();

            $data = $response['results'][0] ?? [];
            if (empty($data)) {
                throw new RandomUserException('There is no data in response.');
            }

            $name = $data['name'];

            $user = new User();
            $user
                ->setTitle($name['title'])
                ->setFirstName($name['first'])
                ->setLastName($name['last'])
                ->setPhone($data['phone'])
                ->setEmail($data['email'])
                ->setCountry($data['location']['country']);

            return $user;
        } catch (ConnectionException $exception) {
            throw new RandomUserException('Could not connect to Random User API.', 500, $exception);
        }
    }

    public function sortItems(Collection $collection): Collection
    {
        return $collection
            ->sortByDesc([
                fn (User $a, User $b) => $b->getLastName() <=> $a->getLastName(),
            ])
            ->map(fn (User $user) => $user->toArray());
    }
}
