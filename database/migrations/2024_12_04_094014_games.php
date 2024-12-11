<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('is_private')->default(false);
            $table->integer('max_players');
            $table->dateTime('event_time', precision: 0);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();

            // Allow manually writing address and boardgame
            $table->string('address')->nullable(); 
            $table->string('boardgame_name')->nullable();

            // Allow choosing from Places and Boardgame models
            $table->unsignedBigInteger('place_id')->nullable();
            $table->unsignedBigInteger('boardgame_id')->nullable();
        }
    );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
