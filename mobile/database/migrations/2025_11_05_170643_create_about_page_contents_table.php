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
        Schema::create('about_page_contents', function (Blueprint $table) {
            $table->id();
            
            // Hero Section
            $table->text('hero_title')->nullable();
            $table->text('hero_description')->nullable();
            
            // Who We Are Section
            $table->string('who_we_are_badge')->nullable();
            $table->text('who_we_are_title')->nullable();
            $table->text('who_we_are_description')->nullable();
            $table->string('who_we_are_stat_number')->nullable();
            $table->string('who_we_are_stat_label')->nullable();
            $table->string('who_we_are_warranty_title')->nullable();
            $table->text('who_we_are_warranty_description')->nullable();
            
            // Feature Card Section
            $table->text('feature_title')->nullable();
            $table->json('feature_items')->nullable();
            
            // Customer Satisfaction Section
            $table->string('customer_satisfaction_badge')->nullable();
            $table->text('customer_satisfaction_title')->nullable();
            $table->json('customer_satisfaction_items')->nullable(); // Array of objects with title, description
            
            // Quality Repairs Section
            $table->string('quality_repairs_badge')->nullable();
            $table->text('quality_repairs_title')->nullable();
            $table->json('quality_repairs_stats')->nullable();
            
            // Why Choose Us Section
            $table->string('why_choose_us_badge')->nullable();
            $table->string('why_choose_us_title')->nullable();
            $table->json('why_choose_us_items')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_page_contents');
    }
};
