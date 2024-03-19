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
            $table->bigInteger('Volunteer_id');
            // $table->foreign('Volunteer_id')->references('id')->on('volunteers');
            $table->bigInteger('Beneficiarie_id');
            // $table->foreign('Beneficiarie_id')->references('id')->on('beneficiaries');
            $table->bigInteger('Program_id');
            // $table->foreign('Program_id')->references('id')->on('programs');
            $table->bigInteger('Course_id');
            // $table->foreign('Course_id')->references('id')->on('courses');
            $table->bigInteger('Maintenance_id');
            // $table->foreign('Maintenance_id')->references('id')->on('maintenances');
            $table->time('Started_at')->nullable();
            $table->time('Ended_at')->nullable();
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
