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
        Schema::table('workshops', function (Blueprint $table) {
            $table->dropColumn('Semester');

            $table->string('title')->after('Date')->nullable();
            $table->string('description')->after('title')->nullable();
            $table->string('path')->after('description')->nullable();

            $table->date('ended_at')->after('path')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('workshops', function (Blueprint $table) {
            //
        });
    }
};
