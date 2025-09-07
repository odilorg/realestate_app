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
        Schema::create('amenities', function (Blueprint $table) {
           $table->foreignId('amenity_id')->constrained()->cascadeOnDelete();
    $table->foreignId('property_id')->constrained()->cascadeOnDelete();
    $table->primary(['amenity_id','property_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('amenities');
    }
};
