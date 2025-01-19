<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scores', function (Blueprint $table) {
            $table->id();
            $table->string('team_a')->default('Team A');
            $table->string('team_b')->default('Team B');
            $table->integer('team_a_score')->default(0); // Score for Team A
            $table->integer('team_b_score')->default(0); // Score for Team B
            $table->enum('status', ['not_started', 'in_progress', 'completed'])->default('not_started'); // Match status
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('scores');
    }
}
