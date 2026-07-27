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
        Schema::create('organizations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained('tenants')->cascadeOnDelete();
            $table->foreignId('location_id')->constrained('locations')->cascadeOnDelete();
            $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete();
            $table->string('org_name');
            $table->string('org_logo')->nullable();
            $table->enum('type', [
                'donor',
                'recipient',
                'both'
            ]);
            $table->string('contact_number');
            $table->string('email')->nullable()->unique();
            $table->text('org_desc')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->index(['org_name', 'email']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organizations');
    }
};
