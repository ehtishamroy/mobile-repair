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
        Schema::create('global_features', function (Blueprint $table) {
            $table->id();
            $table->string('icon'); // Bootstrap Icons class (e.g., bi-award, bi-truck)
            $table->string('title'); // Feature title (e.g., "Free 1 Year Warranty")
            $table->integer('order')->default(0); // Display order
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('global_features');
    }
};

