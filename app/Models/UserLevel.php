<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserLevel extends Model
{
    protected $primaryKey = null;
    public $incrementing = false;
    public $timestamps = true;
    protected $fillable = ['user_id', 'level_id'];

    public function level()
    {
        return $this->belongsTo(Level::class, 'level_id', 'id');
    }
}
