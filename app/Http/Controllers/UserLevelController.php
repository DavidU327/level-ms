<?php

namespace App\Http\Controllers;

use App\Models\UserLevel;
use Illuminate\Http\Request;

class UserLevelController extends Controller
{
    public function index()
    {
        return response()->json(UserLevel::all());
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
