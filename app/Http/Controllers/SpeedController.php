<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class SpeedController extends Controller
{
    /**
     * Get the internet speed from the server.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSpeed()
    {
        // Replace this with your code to fetch the actual internet speed from the server
        // For demonstration purposes, we use random data
        $internetSpeed = rand(5, 100); // Random number between 5 and 100 (Mbps)

        return response()->json(['internet_speed' => $internetSpeed]);
    }
}
