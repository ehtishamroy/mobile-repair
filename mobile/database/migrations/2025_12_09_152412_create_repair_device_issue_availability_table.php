<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('repair_device_issue_availability', function (Blueprint $table) {
            $table->id();
            $table->foreignId('repair_device_type_id')->constrained()->onDelete('cascade');
            $table->foreignId('repair_issue_id')->constrained()->onDelete('cascade');
            $table->boolean('is_available')->default(true);
            $table->boolean('requires_quality_tier')->default(false);
            $table->decimal('base_price', 10, 2)->nullable();
            $table->timestamps();

            // Ensure unique combinations
            $table->unique(['repair_device_type_id', 'repair_issue_id'], 'device_issue_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('repair_device_issue_availability');
    }
};
