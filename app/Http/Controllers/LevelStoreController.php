<?php

namespace App\Http\Controllers;

use App\Models\Level;
use App\Http\Requests\LevelStoreRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class LevelStoreController extends Controller
{
    public function create(LevelStoreRequest $request): JsonResponse
    {
    $validated = $request->validated();

        DB::beginTransaction();
        try {
            $level = Level::create($validated);
            $level->refresh();
            DB::commit();

            $data = [
                'message' => 'Nivel creado correctamente',
                'level' => $level,
                'code' => 201,
            ];

            return response()->json($data, 201);
        } catch (\Exception $exception) {
            DB::rollBack();

            return response()->json([
                'message' => $exception->getMessage(),
                'code' => 400,
            ], 400);
        }
    }
}
