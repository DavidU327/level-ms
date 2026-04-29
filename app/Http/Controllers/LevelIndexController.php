<?php

namespace App\Http\Controllers;

use App\Models\Level;
use Illuminate\Http\JsonResponse;

class LevelIndexController extends Controller
{
    public function index(): JsonResponse
    {
        $levels = Level::all();
        return response()->json([
            'levels' => $levels,
            'code' => 200,
        ], 200);
    }
}
