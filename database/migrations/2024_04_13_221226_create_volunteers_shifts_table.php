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

        Schema::create('volunteers_shifts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('Volunteer_id');
            $table->foreign('Volunteer_id')->references('id')->on('users');
            $table->unsignedBigInteger('Coach_id');
            $table->foreign('Coach_id')->references('id')->on('users');
            $table->unsignedBigInteger('Shift_id');
            $table->foreign('Shift_id')->references('id')->on('shifts');
            $table->date('Date');
            $table->tinyInteger('Semester');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('volunteers_shifts');
    }
};
