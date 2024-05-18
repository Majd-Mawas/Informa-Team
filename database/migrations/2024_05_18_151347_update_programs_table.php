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
        Schema::table('programs', function (Blueprint $table) {
            $table->string('telegram_link')->nullable()->after('Released_at');
            $table->string('youtube_link')->nullable()->after('telegram_link');
            $table->string('size')->nullable()->after('youtube_link');
            $table->string('description')->nullable()->after('size');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('programs', function (Blueprint $table) {
            $table->dropColumn('telegram_link');
            $table->dropColumn('youtube_link');
            $table->dropColumn('size');
            $table->dropColumn('description');
        });
    }
};
