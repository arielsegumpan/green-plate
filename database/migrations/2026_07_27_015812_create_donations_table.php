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
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('organization_id')->constrained('organizations')->cascadeOnDelete();
            $table->string('reference_no')->unique();
            $table->timestamp('available_from');
            $table->timestamp('expires_at');
            $table->json('pickup_location')->nullable();
            $table->enum('status', [
                'pending',
                'matched',
                'assigned',
                'picked_up',
                'delivered',
                'expired',
                'cancelled'
            ]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};
