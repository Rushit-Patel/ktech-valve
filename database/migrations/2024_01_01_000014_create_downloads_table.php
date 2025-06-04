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
        Schema::create('downloads', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('file_name');
            $table->string('file_path');
            $table->string('file_type'); // pdf, doc, xls, etc.
            $table->bigInteger('file_size')->nullable(); // in bytes
            $table->text('description')->nullable();
            $table->string('category')->nullable(); // catalog, certificate, manual, etc.
            $table->foreignId('product_id')->nullable()->constrained('products')->onDelete('cascade');
            $table->integer('download_count')->default(0);
            $table->boolean('is_public')->default(true);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            $table->index(['is_active', 'category']);
            $table->index('product_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('downloads');
    }
};