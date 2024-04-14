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

        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('Volunteer_id');
            $table->foreign('Volunteer_id')->references('id')->on('users');
            $table->unsignedBigInteger('Beneficiarie_id');
            $table->foreign('Beneficiarie_id')->references('id')->on('users');
            $table->unsignedBigInteger('Program_id');
            $table->foreign('Program_id')->references('id')->on('programs');
            $table->unsignedBigInteger('Maintenance_id');
            $table->foreign('Maintenance_id')->references('id')->on('maintenances');
            $table->unsignedBigInteger('Course_id');
            $table->foreign('Course_id')->references('id')->on('courses');
            $table->timestamp('Started_at');
            $table->timestamp('Ended_at');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
