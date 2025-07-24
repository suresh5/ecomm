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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
             $table->string('title');
            $table->string('slug')->unique();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->nullOnDelete();

             $table->text('short_description')->nullable();
            $table->longText('description')->nullable();
            $table->string('tags')->nullable(); // comma-separated tags

            $table->string('thumbnail')->nullable();
            $table->string('cover')->nullable();
            $table->string('detail_image')->nullable();
            $table->string('app_thumbnail')->nullable();

             $table->enum('content_type', ['post', 'video', 'gallery', 'images'])->default('post');
            $table->enum('article_type', ['short', 'detail'])->default('short');

             $table->string('video_url')->nullable();
            $table->string('image_url')->nullable();

             $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();

            $table->unsignedBigInteger('author_id')->nullable();
            $table->foreign('author_id')->references('id')->on('users')->nullOnDelete();
            $table->string('source')->nullable();

             $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
            $table->enum('visibility', ['public', 'private', 'subscriber_only'])->default('public');
            $table->timestamp('published_at')->nullable();
            $table->timestamp('expired_at')->nullable();

              $table->unsignedBigInteger('views')->default(0);
            $table->unsignedBigInteger('likes')->default(0);
            $table->unsignedBigInteger('shares')->default(0);

             $table->string('canonical_url')->nullable();
            $table->string('external_link')->nullable();
            $table->string('reading_time')->nullable();
            $table->string('layout_type')->nullable();

              $table->boolean('is_featured')->default(false);
            $table->boolean('trending')->default(false);

            $table->timestamps();



        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
