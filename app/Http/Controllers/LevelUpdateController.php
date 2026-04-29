<?php

namespace App\Http\Controllers;

use App\Models\Level;
use App\Http\Requests\LevelUpdateRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class LevelUpdateController extends Controller
{
    public function update(LevelUpdateRequest $request, $id): JsonResponse
    {
    $validated = $request->validated();

        DB::beginTransaction();
        try {
            $level = Level::findOrFail($id);
            $level->update($validated);
            $level->refresh();
            DB::commit();

            $data = [
                'message' => 'Nivel actualizado correctamente',
                'level' => $level,
                'code' => 200,
            ];

            return response()->json($data, 200);
        } catch (\Exception $exception) {
            DB::rollBack();

            return response()->json([
                'message' => $exception->getMessage(),
                'code' => 400,
            ], 400);
        }
    }
}
