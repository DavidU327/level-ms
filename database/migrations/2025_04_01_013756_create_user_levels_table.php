<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('user_levels', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('level_id');
            $table->timestamps();

            $table->primary(['user_id', 'level_id']);
            $table->foreign('level_id')->references('id')->on('levels')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_levels');
    }
};
