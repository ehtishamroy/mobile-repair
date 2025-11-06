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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->enum('type', ['percentage', 'fixed'])->default('percentage'); // percentage or fixed amount
            $table->decimal('value', 10, 2); // discount value (percentage or fixed amount)
            $table->decimal('minimum_purchase', 10, 2)->nullable(); // minimum purchase amount
            $table->decimal('maximum_discount', 10, 2)->nullable(); // maximum discount for percentage type
            $table->integer('usage_limit')->nullable(); // total usage limit (null = unlimited)
            $table->integer('usage_limit_per_user')->nullable()->default(1); // per user usage limit
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('applicable_to', ['all', 'categories', 'products'])->default('all');
            $table->json('category_ids')->nullable(); // applicable category IDs if applicable_to is 'categories'
            $table->json('product_ids')->nullable(); // applicable product IDs if applicable_to is 'products'
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
