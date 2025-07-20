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
         Schema::table('products', function (Blueprint $table) {
            $table->string('slug')->nullable()->change();
            $table->text('description')->nullable()->change();
            $table->text('summary')->nullable()->change();
            $table->string('photo')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         Schema::table('products', function (Blueprint $table) {
            $table->string('slug')->nullable(false)->change();
            $table->text('description')->nullable(false)->change();
            $table->text('summary')->nullable(false)->change();
            $table->string('photo')->nullable(false)->change();
        });
    }
};
