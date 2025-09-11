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
        Schema::table('messages', function (Blueprint $table) {
            $table->boolean('is_from_user')->default(true);
            $table->boolean('needs_human_support')->default(false);
            
            // Rename body to content if it exists
            if (Schema::hasColumn('messages', 'body')) {
                $table->renameColumn('body', 'content');
            } else {
                // Add content column if body doesn't exist
                $table->text('content')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->dropColumn('is_from_user');
            $table->dropColumn('needs_human_support');
            
            // Rename content back to body if it exists
            if (Schema::hasColumn('messages', 'content')) {
                $table->renameColumn('content', 'body');
            }
        });
    }
};