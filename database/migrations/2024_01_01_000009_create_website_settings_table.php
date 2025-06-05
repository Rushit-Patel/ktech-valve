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
        Schema::create('website_settings', function (Blueprint $table) {
            $table->id();
            $table->string('key',100)->unique();
            $table->text('value')->nullable();
            $table->string('type',100)->default('text'); // text, image, json, boolean
            $table->string('group',100)->default('general'); // general, contact, social, seo
            $table->string('label',100);
            $table->text('description')->nullable();
            $table->timestamps();
            
            $table->index(['group', 'key']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('website_settings');
    }
};