<?php

namespace Tests\Feature\Level;

use App\Http\Middleware\AuthenticateJwt;
use App\Http\Middleware\RoleMiddleware;
use App\Models\Level;
use Illuminate\Support\Facades\DB;
use Tests\Feature\Support\CreatesLevelMsSchema;
use Tests\TestCase;

class LevelManagementTest extends TestCase
{
    use CreatesLevelMsSchema;

    protected function setUp(): void
    {
        parent::setUp();
        $this->prepareLevelMsSchema();
        $this->withoutMiddleware([AuthenticateJwt::class, RoleMiddleware::class]);
    }

    public function test_admin_can_create_level(): void
    {
        $response = $this->postJson('/api/levels', [
            'name' => 'Semilla Verde',
            'min_point' => 0,
            'max_point' => 100,
        ]);

        $response->assertCreated();
        $response->assertJsonPath('message', 'Nivel creado correctamente');
        $response->assertJsonPath('level.name', 'Semilla Verde');

        $this->assertDatabaseHas('levels', [
            'name' => 'Semilla Verde',
            'min_point' => 0,
            'max_point' => 100,
        ]);
    }

    public function test_user_can_view_available_levels_and_current_user_level(): void
    {
        $level1 = Level::create([
            'name' => 'Semilla Verde',
            'min_point' => 0,
            'max_point' => 100,
        ]);

        $level2 = Level::create([
            'name' => 'Guardián del Medio Ambiente',
            'min_point' => 101,
            'max_point' => 300,
        ]);

        DB::table('user_levels')->insert([
            'user_id' => 15,
            'level_id' => $level2->id,
        ]);

        $levelsResponse = $this->getJson('/api/all-levels-user');

        $levelsResponse->assertOk();
        $levelsResponse->assertJsonCount(2, 'levels');
        $levelsResponse->assertJsonPath('levels.0.name', 'Semilla Verde');
        $levelsResponse->assertJsonPath('levels.1.name', 'Guardián del Medio Ambiente');

        $myLevelResponse = $this->getJson('/api/level-me/15');

        $myLevelResponse->assertOk();
        $myLevelResponse->assertJsonPath('user_id', 15);
        $myLevelResponse->assertJsonPath('level_id', $level2->id);
    }
}

