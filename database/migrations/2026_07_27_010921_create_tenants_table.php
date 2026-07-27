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
        Schema::create('tenants', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->string('email')->nullable()->unique();
            $table->string('phone')->nullable();
            $table->string('domain')->nullable()->unique();
            $table->string('logo')->nullable();
            $table->enum('status', [
                'active',
                'inactive',
                'suspended'
            ])->default('active');
            $table->json('settings')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->index(['name', 'email', 'slug','domain']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenants');
    }
};
