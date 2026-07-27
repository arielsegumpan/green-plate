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
        Schema::create('sustainability_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('organization_id')->constrained('organizations')->cascadeOnDelete();
            $table->foreignId('delivery_id')->constrained('deliveries')->cascadeOnDelete();
            $table->decimal('food_saved_kg', 10, 2);
            $table->decimal('co2_saved_kg', 10, 2);
            $table->integer('meals_served');
            $table->decimal('fuel_saved_liters', 10, 2);
            $table->decimal('distance_travelled_km', 8, 2);
            $table->decimal('food_waste_diverted_kg', 10, 2);
            $table->decimal('trees_equivalent', 8, 2);
            $table->decimal('carbon_score', 5, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sustainability_logs');
    }
};
