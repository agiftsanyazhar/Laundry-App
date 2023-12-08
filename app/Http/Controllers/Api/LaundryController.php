<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Laundry;
use Illuminate\Http\Request;

class LaundryController extends Controller
{
    function readAll()
    {
        $laundries = Laundry::with('user', 'shop')->get();

        return response()->json([
            'data' => $laundries,
        ], 200);
    }

    function whereUserId($id)
    {
        $laundries = Laundry::where('user_id', $id)
            ->with('shop', 'user')
            ->orderBy('created_at', 'desc')
            ->get();

        if ($laundries) {
            return response()->json([
                'data' => $laundries,
            ], 201);
        } else {
            return response()->json([
                'message' => 'Not found',
                'data' => $laundries,
            ], 404);
        }
    }

    function claim(Request $request)
    {
        $laundries = Laundry::where([
            ['id', $request->id],
            ['claim_code', $request->claim_code],
        ])->firstOrFail();

        if (!$laundries) {
            return response()->json([
                'message' => 'Not Found',
                'data' => $laundries,
            ], 404);
        }

        if ($laundries->user_id != 0) {
            return response()->json([
                'message' => 'Laundry has been claimed',
            ], 400);
        }

        $laundries->user_id = $request->user_id;
        $updated = $laundries->save();

        if ($updated) {
            return response()->json([
                'data' => $updated,
            ], 201);
        } else {
            return response()->json([
                'message' => 'Failed to update',
            ], 500);
        }
    }
}
