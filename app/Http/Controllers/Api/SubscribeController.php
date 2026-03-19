<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\SubscribeRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class SubscribeController extends Controller
{
    public function store(SubscribeRequest $request): JsonResponse
    {
        $payload = $request->validated();

        Log::info('Newsletter subscription', $payload);

        return response()->json([
            'message' => 'Subscribed successfully.',
        ], 201);
    }
}

