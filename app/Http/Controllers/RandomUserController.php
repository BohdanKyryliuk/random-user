<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiException;
use App\Exceptions\RandomActivityException;
use App\Exceptions\RandomUserException;
use App\Services\RandomActivity\RandomActivityService;
use App\Services\RandomUser\RandomUserService;
use Illuminate\Http\JsonResponse;

class RandomUserController extends Controller
{
    public function user(RandomUserService $randomUserService)
    {
        $randomUser = $randomUserService->getItem();

        return new JsonResponse($randomUser->toArray());
    }

    public function users(RandomUserService $randomUserService, RandomActivityService $randomActivityService)
    {
        try {
            $users = $randomUserService->getData();

            return response()->xml([
                'status' => 'success',
                'user' => $users,
            ]);
        } catch (RandomUserException) {
            try {
                $activity = $randomActivityService->getData();

                return response()->xml([
                    'status' => 'success',
                    'activity' => $activity,
                ]);
            } catch (RandomActivityException $e) {
                return $this->error($e);
            }
        } catch (ApiException $e) {
            return $this->error($e);
        }
    }

    private function error(\Exception $e)
    {
        return response()->xml([
            'status' => 'error',
            'message' => $e->getMessage(),
        ]);
    }
}
