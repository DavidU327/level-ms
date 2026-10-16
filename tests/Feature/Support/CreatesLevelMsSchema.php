<?php

namespace Tests\Feature\Support;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;

trait CreatesLevelMsSchema
{
    protected function prepareLevelMsSchema(): void
    {
        Config::set('database.default', 'sqlite');
        Config::set('database.connections.sqlite.database', ':memory:');

        Schema::dropAllTables();

        Schema::create('levels', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('min_point');
            $table->integer('max_point');
            $table->timestamps();
        });

        Schema::create('user_levels', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('level_id');
            $table->timestamps();
        });
    }
}

