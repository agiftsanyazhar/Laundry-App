<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Shop;

class ShopController extends Controller
{
    function readAll()
    {
        $shops = Shop::get();

        return response()->json([
            'data' => $shops,
        ], 200);
    }

    function readRecommendationLimit()
    {
        $shops = Shop::orderBy('created_at', 'DESC')
            ->limit(5)
            ->get();

        if (count($shops) > 0) {
            return response()->json([
                'data' => $shops,
            ], 200);
        } else {
            return response()->json([
                'message' => 'Not Found',
                'data' => $shops,
            ], 404);
        }
    }

    function searchByCity($name)
    {
        $shops = Shop::whereLike('city', '%' . $name . '%')
            ->orderBy('name')
            ->get();

        if (count($shops) > 0) {
            return response()->json([
                'data' => $shops,
            ], 200);
        } else {
            return response()->json([
                'message' => 'Not Found',
                'data' => $shops,
            ], 404);
        }
    }
}
