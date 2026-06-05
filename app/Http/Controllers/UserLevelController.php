<?php

namespace App\Http\Controllers;

use App\Models\Level;
use App\Models\UserLevel;
use Illuminate\Http\Request;

class UserLevelController extends Controller
{
    public function index()
    {
        return response()->json(UserLevel::all());
    }

    public function storeInit(Request $request)
    {
        $userLevel = new UserLevel();
        $userLevel->user_id = $request->user_id;
        $userLevel->level_id = 1;
        $userLevel->save();

        return response()->json($userLevel, 201);
    }

    public function updateLevelUser(Request $request)
    {
        $level = Level::where('min_point', '<=', $request->points)
            ->where('max_point', '>=', $request->points)
            ->first();

        if (!$level) {
            return response()->json([
                'message' => 'Level not found'
            ], 404);
        }

        $userLevel = UserLevel::where('user_id', $request->user_id)
            ->update([
                'level_id' => $level->id,
            ]);

        return response()->json($userLevel, 201);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|integer',
            'level_id' => 'required|exists:levels,id',
        ]);

        $userLevel = UserLevel::create($validated);
        return response()->json($userLevel, 201);
    }

    public function destroy(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|integer',
            'level_id' => 'required|exists:levels,id',
        ]);

        UserLevel::where($validated)->delete();
        return response()->json(null, 204);
    }
}
