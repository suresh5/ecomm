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
        Schema::table('posts', function (Blueprint $table) {
             Schema::table('posts', function (Blueprint $table) {
            if (Schema::hasColumn('posts', 'detail_image')) {
                $table->dropColumn('detail_image');
            }
            if (Schema::hasColumn('posts', 'video_url')) {
                $table->dropColumn('video_url');
            }
            if (Schema::hasColumn('posts', 'image_url')) {
                $table->dropColumn('image_url');
            }
        });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         Schema::table('posts', function (Blueprint $table) {
            $table->string('detail_image')->nullable();
            $table->string('video_url')->nullable();
            $table->string('image_url')->nullable();
        });
    }
};
