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

        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('workshop_id')->nullable();
            $table->foreign('workshop_id')->references('id')->on('workshops');
            $table->unsignedBigInteger('service_id')->nullable();
            $table->bigInteger('is_volunteer');
            $table->unsignedBigInteger('time_id');
            $table->foreign('time_id')->references('id')->on('time');
            $table->string('description');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
