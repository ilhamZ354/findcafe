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
        Schema::create('cafe_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cafe_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('address')->nullable(false);
            $table->string('image_profile')->nullable(false);
            $table->string('description')->nullable(false);
            $table->json('galleries')->nullable(false);
            $table->string('location')->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cafe_details');
    }
};
