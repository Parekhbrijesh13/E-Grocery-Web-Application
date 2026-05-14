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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete();
            $table->string('product_name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('sku')->nullable()->unique();
            $table->string('brand')->nullable();
            $table->decimal('mrp', 10, 2);
            $table->decimal('price', 10, 2);
            $table->decimal('cost_price', 10, 2)->nullable();
            $table->decimal('tax', 5, 2)->default(0);
            $table->unsignedInteger('stock')->default(0);
            $table->unsignedInteger('low_stock_threshold')->default(10);
            $table->decimal('unit_value', 8, 2)->default(1);
            $table->string('unit', 20)->default('pcs');
            $table->string('product_img')->nullable();
            $table->json('images')->nullable();
            $table->string('tags')->nullable();
            $table->enum('status', ['active', 'draft', 'inactive'])->default('active');
            $table->boolean('featured')->default(false);
            $table->boolean('cod')->default(true);
            $table->string('meta_title')->nullable();
            $table->text('meta_desc')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
