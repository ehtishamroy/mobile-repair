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
        Schema::create('repair_pricings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('repair_service_id')->constrained()->onDelete('cascade');
            $table->foreignId('repair_device_type_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('repair_issue_id')->nullable()->constrained()->onDelete('cascade');
            $table->decimal('price', 10, 2);
            $table->boolean('is_inspection_fee')->default(false); // For "I don't know the issue" option
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            // Unique constraint: one price per service + device + issue combination
            $table->unique(['repair_service_id', 'repair_device_type_id', 'repair_issue_id'], 'unique_pricing');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('repair_pricings');
    }
};
