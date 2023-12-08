<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Promo;

class PromoController extends Controller
{
    function readAll()
    {
        $promos = Promo::with('shop')->get();

        return response()->json([
            'data' => $promos,
        ], 200);
    }

    function readLimit()
    {
        $promos = Promo::orderBy('created_at', 'DESC')
            ->limit(5)
            ->with('shop')
            ->get();

        if (count($promos) > 0) {
            return response()->json([
                'data' => $promos,
            ], 200);
        } else {
            return response()->json([
                'message' => 'Not Found',
                'data' => $promos,
            ], 404);
        }
    }
}
