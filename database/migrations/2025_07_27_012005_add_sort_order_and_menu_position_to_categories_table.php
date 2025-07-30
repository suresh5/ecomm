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
          Schema::table('categories', function (Blueprint $table) {
            $table->integer('sort_order')->default(0)->after('slug');
            $table->enum('menu_position', ['main', 'extra'])->default('main')->after('sort_order');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
       Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn(['sort_order', 'menu_position']);
        });
    }
};
