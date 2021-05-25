<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class UserFoodController extends Controller
{
    private $privateApiUrl;

    public function __construct()
    {
        $this->privateApiUrl = env('PRIVATE_API_URL');
    }

    public function foods(int $userId)
    {
        try {
            $response = Http::get("{$this->privateApiUrl}/users/{$userId}/foods");
        } catch(Exception $e) {
            throw new HttpException(500, $e->getMessage());
        }
        return $response->json();
    }

    public function food(int $userId, int $foodId)
    {
        try {
            $response = Http::get("{$this->privateApiUrl}/users/{$userId}/foods/{$foodId}");
        } catch(Exception $e) {
            throw new HttpException(500, $e->getMessage());
        }
        return $response->json();
    }

    public function deleteFood(int $userId, int $foodId)
    {
        try {
            $response = Http::delete("{$this->privateApiUrl}/users/{$userId}/foods/{$foodId}");
        } catch(Exception $e) {
            throw new HttpException(500, $e->getMessage());
        }
        return $response->json();
    }

    public function addFood(Request $request, int $userId, int $foodId)
    {
        $servingsPerWeek = $request->input('servingsPerWeek');
        
        try {
            $response = Http::put("{$this->privateApiUrl}/users/{$userId}/foods/{$foodId}", [
                'servingsPerWeek' => $servingsPerWeek
            ]);            
        } catch(Exception $e) {
            throw new HttpException(500, $e->getMessage());
        }

        return $response->json();
    }
}
