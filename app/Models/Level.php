<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    protected $fillable = [
        'name',
        'max_point',
        'min_point',
    ];

    public function userLevels()
    {
        return $this->hasMany(UserLevel::class, 'level_id', 'id');
    }
}
