<?php

namespace App\Http\Controllers;

use App\Models\Level;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function levelDashboard()
    {
        $levels = Level::query()
            ->select('id', 'name')
            ->withCount([
                'userLevels as total_users'
            ])
            ->get();

        return response()->json($levels);
    }

}
