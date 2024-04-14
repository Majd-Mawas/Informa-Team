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

        Schema::create('time', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('shift_id');
            $table->foreign('shift_id')->references('id')->on('shifts');
            $table->enum('time', ["10","10.30","11","11.30","12","12.30","1","1.30"]);
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('time');
    }
};
