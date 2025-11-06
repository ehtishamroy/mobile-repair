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
        Schema::create('homepage_contents', function (Blueprint $table) {
            $table->id();
            
            // Hero Section
            $table->string('hero_badge')->nullable();
            $table->text('hero_title')->nullable();
            $table->text('hero_description')->nullable();
            $table->string('hero_button_text')->nullable();
            
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
            $table->json('feature_items')->nullable(); // Array of feature items
            
            // What We Offer Section
            $table->string('what_we_offer_badge')->nullable();
            $table->text('what_we_offer_title')->nullable();
            $table->text('what_we_offer_description')->nullable();
            $table->string('what_we_offer_button_text')->nullable();
            $table->json('services')->nullable(); // Array of service objects with title and description
            
            // Hot Selling Section
            $table->string('hot_selling_badge')->nullable();
            $table->string('hot_selling_title')->nullable();
            
            // Quality Repairs Section
            $table->string('quality_repairs_badge')->nullable();
            $table->text('quality_repairs_title')->nullable();
            $table->json('quality_repairs_stats')->nullable(); // Array of stat objects
            
            // Why Choose Us Section
            $table->string('why_choose_us_badge')->nullable();
            $table->string('why_choose_us_title')->nullable();
            $table->json('why_choose_us_items')->nullable(); // Array of feature items
            
            // Accessories Section
            $table->string('accessories_badge')->nullable();
            $table->string('accessories_title')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('homepage_contents');
    }
};
