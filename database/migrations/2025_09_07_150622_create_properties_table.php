<?php

use App\Enums\PropertyStatus;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();

            $table->foreignId('company_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('owner_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('property_type_id')->constrained()->cascadeOnDelete();

            $table->string('title');
            $table->string('slug')->unique();

            // enums stored as strings (index them)
            $table->string('purpose');  // sale|rent
            $table->string('status')->default(PropertyStatus::DRAFT->value);

            // pricing
            $table->unsignedBigInteger('price')->nullable();      // sale price
            $table->unsignedBigInteger('rent_price')->nullable(); // monthly rent
            $table->string('currency', 3)->default('USD');

            // address / location
            $table->string('country')->nullable();
            $table->string('city')->nullable()->index();
            $table->string('address')->nullable();

            // Optional geospatial (MySQL 8+)
            // $table->point('location')->nullable()->spatialIndex();

            // If you prefer non-spatial initially:
            $table->decimal('lat', 10, 7)->nullable();
            $table->decimal('lng', 10, 7)->nullable();
            $table->index(['lat','lng']);

            // details
            $table->unsignedSmallInteger('bedrooms')->nullable()->index();
            $table->unsignedSmallInteger('bathrooms')->nullable()->index();
            $table->unsignedInteger('area_sq_m')->nullable()->index();
            $table->boolean('furnished')->default(false)->index();
            $table->json('attributes')->nullable(); // flexible key-values (e.g., floor, year_built)

            $table->timestamps();
            $table->softDeletes();

            $table->index(['purpose','status','property_type_id']);
            $table->index(['price','rent_price']);
            $table->index(['company_id','owner_id']);
            $table->index('title');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
