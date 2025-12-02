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
        Schema::create('repair_quality_tiers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('repair_issue_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('repair_device_type_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('name'); // e.g., "Standard Screen", "OEM Screen", "Premium Screen"
            $table->decimal('price_modifier', 10, 2)->default(0); // Additional cost on top of base price
            $table->text('description')->nullable();
            $table->boolean('is_default')->default(false);
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('repair_quality_tiers');
    }
};
