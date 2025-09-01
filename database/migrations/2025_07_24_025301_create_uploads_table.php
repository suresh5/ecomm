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
        Schema::create('uploads', function (Blueprint $table) {
            $table->id();
            $table->string('filename');
            $table->string('file_type')->nullable(); // image, video, document etc.
             $table->enum('type', [
                'cover_image',
                'web_thumbnail',
                'app_thumbnail',
                'video',
                'shorts'
            ]);
            $table->string('path'); // relative or full URL
            $table->unsignedBigInteger('uploaded_by')->nullable(); // user id
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('uploads');
    }
};
