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
        Schema::create('property_media', function (Blueprint $table) {
             $table->id();
            $table->foreignId('property_id')->constrained()->cascadeOnDelete();
            $table->string('disk')->default('public');
            $table->string('path');     // storage relative path
            $table->string('type')->default('image'); // image|video|plan
            $table->unsignedInteger('order')->default(0);
            $table->json('meta')->nullable(); // captions, alt, EXIF, etc.
            $table->timestamps();

            $table->index(['property_id','order']);
            $table->index('type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property_media');
    }
};
