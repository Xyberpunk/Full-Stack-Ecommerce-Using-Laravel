<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\CatalogService;
use Illuminate\Http\JsonResponse;

class CatalogController extends Controller
{
    public function __construct(
        private readonly CatalogService $catalog,
    ) {
    }

    public function index(): JsonResponse
    {
        return response()->json([
            'data' => $this->catalog->all(),
        ]);
    }

    public function featured(): JsonResponse
    {
        return response()->json([
            'data' => $this->catalog->featured(),
        ]);
    }

    public function trending(): JsonResponse
    {
        return response()->json([
            'data' => $this->catalog->trending(),
        ]);
    }

    public function show(string $productId): JsonResponse
    {
        $product = $this->catalog->find($productId);

        if (!$product) {
            return response()->json([
                'message' => 'Product not found.',
            ], 404);
        }

        return response()->json([
            'data' => $product,
        ]);
    }
}

