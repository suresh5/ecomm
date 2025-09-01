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
         // Update 'posts' table
        Schema::table('posts', function (Blueprint $table) {
            DB::statement("ALTER TABLE posts CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
        });

        // Update 'categories' table
        Schema::table('categories', function (Blueprint $table) {
            DB::statement("ALTER TABLE categories CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         // Optional: revert to utf8 if needed
        Schema::table('posts', function (Blueprint $table) {
            DB::statement("ALTER TABLE posts CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci");
        });

        Schema::table('categories', function (Blueprint $table) {
            DB::statement("ALTER TABLE categories CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci");
        });
    }
};
