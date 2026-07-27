<?php

use App\Models\Category;
use App\Models\Organization;
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
        Schema::create('category_organization', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Category::class, 'category_id')->constrained('categories')->cascadeOnDelete();
            $table->foreignIdFor(Organization::class, 'organization_id')->constrained('organizations')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category_organization');
    }
};
