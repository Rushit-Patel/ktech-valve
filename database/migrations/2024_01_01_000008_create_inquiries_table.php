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
        Schema::create('inquiries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->nullable()->constrained('products')->onDelete('set null');
            $table->string('inquiry_type')->default('general'); // general, product, quote
            $table->string('name');
            $table->string('email');
            $table->string('phone', 20)->nullable();
            $table->string('company')->nullable();
            $table->string('subject');
            $table->text('message');
            $table->json('additional_data')->nullable(); // For custom form fields
            $table->enum('status', ['new', 'contacted', 'quoted', 'closed'])->default('new');
            $table->text('admin_notes')->nullable();
            $table->timestamp('contacted_at')->nullable();
            $table->timestamps();
            
            $table->index(['status', 'created_at']);
            $table->index('product_id');
            $table->index('email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inquiries');
    }
};