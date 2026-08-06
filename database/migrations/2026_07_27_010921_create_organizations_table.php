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
            $table->string('org_name')->unique();
            $table->string('org_slug')->unique();
            $table->string('org_email')->nullable()->unique();
            $table->string('org_contact_number')->nullable();
            $table->string('org_logo')->nullable();
            $table->enum('status', [
                'pending',
                'active',
                'inactive'
            ])->default('pending');
            $table->text('org_desc')->nullable();
            $table->json('other_details')->nullable();
            $table->json('org_cat')->nullable();
            $table->string('org_type')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->index(['org_name', 'org_slug', 'org_email']);
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
