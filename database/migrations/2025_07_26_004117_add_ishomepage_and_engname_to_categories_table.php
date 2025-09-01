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
            $table->boolean('ishomepage')->default(0)->after('photo'); // or after any column you prefer
            $table->string('engname')->nullable()->after('title');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
       Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn('ishomepage');
            $table->dropColumn('engname');
        });
    }
};
