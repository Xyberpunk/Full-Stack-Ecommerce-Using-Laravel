<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ContactRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function store(ContactRequest $request): JsonResponse
    {
        $payload = $request->validated();

        Log::info('Contact form submission', $payload);

        return response()->json([
            'message' => 'Thanks! We received your message.',
        ], 201);
    }
}

