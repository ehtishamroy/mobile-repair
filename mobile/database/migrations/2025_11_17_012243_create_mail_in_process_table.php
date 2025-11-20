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
        Schema::create('mail_in_process', function (Blueprint $table) {
            $table->id();
            $table->string('title')->default('Mail-in service');
            $table->text('description')->nullable();
            $table->string('process_title')->default('What\'s the process?');
            $table->text('process_description')->nullable();
            $table->string('timeline_title')->default('How long will it take?');
            $table->text('timeline_description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mail_in_process');
    }
};
