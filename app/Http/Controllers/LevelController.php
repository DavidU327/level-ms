<?php

namespace App\Http\Controllers;

use App\Models\Level;
use Illuminate\Http\Request;

class LevelController extends Controller
{
    public function index()
    {
        return response()->json(Level::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'max_point' => 'required|integer',
            'min_point' => 'required|integer',
        ]);

        $level = Level::create($validated);
        return response()->json($level, 201);
    }

    public function show(Level $level)
    {
        return response()->json($level);
    }

    public function update(Request $request, Level $level)
    {
        $level->update($request->all());
        return response()->json($level);
    }

    public function destroy(Level $level)
    {
        $level->delete();
        return response()->json(null, 204);
    }
}
