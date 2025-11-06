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
        Schema::create('join_page_contents', function (Blueprint $table) {
            $table->id();
            
            // Hero Section
            $table->text('hero_title')->nullable();
            $table->text('hero_description')->nullable();
            
            // Our Team Section
            $table->string('our_team_badge')->nullable();
            $table->text('our_team_title')->nullable();
            $table->text('our_team_description')->nullable();
            $table->json('our_team_features')->nullable(); // Array of feature items
            
            // Meet Our Team Section
            $table->string('meet_team_badge')->nullable();
            $table->text('meet_team_title')->nullable();
            $table->json('team_members')->nullable(); // Array of team member objects with name, designation
            
            // Join Us Section
            $table->string('join_us_badge')->nullable();
            $table->text('join_us_title')->nullable();
            $table->text('join_us_description')->nullable();
            $table->string('join_us_button_text')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('join_page_contents');
    }
};
