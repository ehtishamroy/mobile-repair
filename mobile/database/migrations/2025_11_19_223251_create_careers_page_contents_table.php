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
        Schema::create('careers_page_contents', function (Blueprint $table) {
            $table->id();
            // Hero Section
            $table->string('hero_title')->nullable();
            $table->text('hero_description')->nullable();
            
            // Why Join Us Section
            $table->string('why_join_badge')->nullable();
            $table->string('why_join_title')->nullable();
            $table->text('why_join_description')->nullable();
            $table->json('why_join_items')->nullable();
            
            // Open Positions Section
            $table->string('open_positions_badge')->nullable();
            $table->string('open_positions_title')->nullable();
            $table->text('open_positions_description')->nullable();
            $table->json('job_positions')->nullable();
            
            // Benefits Section
            $table->string('benefits_badge')->nullable();
            $table->string('benefits_title')->nullable();
            $table->json('benefits_items')->nullable();
            
            // How to Apply Section
            $table->string('how_to_apply_badge')->nullable();
            $table->string('how_to_apply_title')->nullable();
            $table->text('how_to_apply_description')->nullable();
            $table->json('application_steps')->nullable();
            
            // Contact Section
            $table->string('contact_badge')->nullable();
            $table->string('contact_title')->nullable();
            $table->text('contact_description')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('contact_button_text')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('careers_page_contents');
    }
};
