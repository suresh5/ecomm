<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       
         DB::statement("ALTER TABLE posts MODIFY COLUMN content_type ENUM('article', 'short', 'video', 'images') NOT NULL DEFAULT 'article'");

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         DB::statement("ALTER TABLE posts MODIFY COLUMN content_type ENUM('post', 'video', 'gallery', 'images') NOT NULL DEFAULT 'post'");

    }
};
