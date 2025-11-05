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
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('sku')->unique();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->foreignId('brand_id')->nullable()->constrained()->onDelete('set null');
            $table->text('description')->nullable();
            $table->text('additional_information')->nullable();
            $table->text('specifications')->nullable();
            $table->string('featured_image')->nullable();
            $table->decimal('price', 10, 2);
            $table->decimal('compare_at_price', 10, 2)->nullable();
            $table->integer('quantity')->default(0);
            $table->enum('availability', ['in_stock', 'out_of_stock', 'pre_order'])->default('in_stock');
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_best_deal')->default(false);
            $table->boolean('is_hot_product')->default(false);
            $table->boolean('has_color_variant')->default(false);
            $table->boolean('is_active')->default(true);
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
