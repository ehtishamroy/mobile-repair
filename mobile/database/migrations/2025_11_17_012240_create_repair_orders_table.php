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
        Schema::create('repair_orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique();
            $table->foreignId('repair_service_id')->constrained()->onDelete('cascade');
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_phone');
            $table->foreignId('repair_device_type_id')->nullable()->constrained()->onDelete('set null');
            $table->string('device_model')->nullable(); // Custom device model if not in list
            $table->text('selected_issues')->nullable(); // JSON array of issue IDs
            $table->text('issue_description')->nullable();
            $table->enum('payment_method', ['stripe', 'paypal'])->nullable();
            $table->string('payment_intent_id')->nullable(); // Stripe payment intent
            $table->string('paypal_order_id')->nullable(); // PayPal order ID
            $table->enum('status', ['pending', 'paid', 'in_progress', 'completed', 'cancelled'])->default('pending');
            $table->decimal('subtotal', 10, 2)->default(0);
            $table->decimal('inspection_fee', 10, 2)->default(0);
            $table->decimal('total', 10, 2)->default(0);
            $table->text('address')->nullable(); // Shipping address for mail-in
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('repair_orders');
    }
};
