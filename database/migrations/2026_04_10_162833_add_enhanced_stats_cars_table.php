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
        Schema::table('cars', function (Blueprint $table) {
            $table->integer('mileage')->nullable()->after('image');
            $table->string('color')->nullable()->after('mileage');
            $table->integer('horsepower')->nullable()->after('color');
            $table->string('transmission')->nullable()->after('horsepower');
            $table->string('fuel_type')->nullable()->after('transmission');
            $table->string('condition')->nullable()->after('fuel_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->dropColumn(['mileage', 'color', 'horsepower', 'transmission', 'fuel_type', 'condition']);
        });
    }
};
