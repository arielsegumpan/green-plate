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
        Schema::create('donation_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('organization_id')->constrained('organizations')->cascadeOnDelete();
            $table->foreignId('donation_id')->constrained('donations')->cascadeOnDelete();
            $table->foreignId('food_category_id')->constrained('food_categories')->cascadeOnDelete();
            $table->string('food_name');
            $table->json('food_imgs')->nullable();
            $table->text('food_desc')->nullable();
            $table->decimal('quantity', 10, 2);
            $table->enum('unit', [
                'kg',
                'pcs',
                'box',
                'tray'
            ]);
            $table->float('temperature_required')->nullable();
            $table->string('estimated_meals')->nullable();
            $table->timestamp('prepared_at');
            $table->timestamp('expires_at');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donation_items');
    }
};
