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
        Schema::create('service_page_contents', function (Blueprint $table) {
            $table->id();
            
            // Hero Section
            $table->text('hero_title')->nullable();
            $table->text('hero_description')->nullable();
            
            // What We Offer Section
            $table->string('what_we_offer_badge')->nullable();
            $table->text('what_we_offer_title')->nullable();
            $table->text('what_we_offer_description')->nullable();
            $table->string('what_we_offer_button_text')->nullable();
            $table->json('services')->nullable(); // Array of service objects with title and description
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_page_contents');
    }
};
