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

        Schema::create('training', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('Coach_id');
            $table->foreign('Coach_id')->references('id')->on('users');
            $table->unsignedBigInteger('Workshop_id');
            $table->foreign('Workshop_id')->references('id')->on('workshops');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('training');
    }
};
