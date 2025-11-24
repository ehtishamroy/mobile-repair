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
        Schema::table('repair_device_types', function (Blueprint $table) {
            $table->foreignId('repair_brand_id')->nullable()->after('repair_service_id')->constrained('repair_brands')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('repair_device_types', function (Blueprint $table) {
            $table->dropForeign(['repair_brand_id']);
            $table->dropColumn('repair_brand_id');
        });
    }
};

