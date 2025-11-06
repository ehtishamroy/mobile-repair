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
        Schema::create('order_tracking', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->enum('status', ['pending', 'confirmed', 'processing', 'shipped', 'delivered', 'cancelled', 'refunded']);
            $table->string('title'); // e.g., "Order Confirmed", "Out for Delivery"
            $table->text('message')->nullable(); // Detailed message
            $table->string('location')->nullable(); // e.g., "Warehouse", "In Transit", "Delivered"
            $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('set null'); // Admin who updated
            $table->timestamp('tracking_date')->nullable(); // Custom date for tracking (defaults to created_at)
            $table->boolean('is_customer_notified')->default(false); // Whether customer was notified
            $table->timestamps();
            
            $table->index('order_id');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_tracking');
    }
};
