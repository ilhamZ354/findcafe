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
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cafe_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('name')->nullable(false);
            $table->string('image')->nullable(false);
            $table->enum('type',['makanan','minuman'])->default('makanan');
            $table->string('description')->nullable(false);
            $table->string('harga')->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
