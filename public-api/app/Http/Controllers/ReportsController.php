<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    private $privateApiUrl;

    public function __construct()
    {
        $this->privateApiUrl = env('PRIVATE_API_URL');
    }

    public function mostConsumedNutrient(int $userId)
    {
        $response = Http::get("{$this->privateApiUrl}/users/{$userId}/reports/most-consumed-nutrient");
        return $response->json();
    }

}
