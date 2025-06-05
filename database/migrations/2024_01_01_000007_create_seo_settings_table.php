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
        Schema::create('seo_settings', function (Blueprint $table) {
            $table->id();
            $table->string('page_type', 100); // homepage, product, category, page, etc.
            $table->string('page_identifier',100)->nullable(); // slug or ID for specific pages
            $table->string('meta_title',100)->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->string('og_title',100)->nullable();
            $table->text('og_description')->nullable();
            $table->string('og_image',100)->nullable();
            $table->json('schema_markup')->nullable();
            $table->string('canonical_url',100)->nullable();
            $table->string('robots_meta', 100)->default('index,follow');
            $table->timestamps();
            
            $table->unique(['page_type', 'page_identifier']);
            $table->index('page_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seo_settings');
    }
};