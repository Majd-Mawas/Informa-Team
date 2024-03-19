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
        Schema::disableForeignKeyConstraints();

        Schema::create('events_attenders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('Event_id');
            // $table->foreign('Event_id')->references('id')->on('events');
            $table->bigInteger('Attender_id');
            // $table->foreign('Attender_id')->references('id')->on('attenders');
            $table->timestamps();
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events_attenders');
    }
};
