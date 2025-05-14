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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('cafe_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('transaksi_id', 32)->unique();
            $table->double('nominal', 8, 2);
            $table->string('name')->nullable(true);
            $table->string('catatan')->nullable(true);
            $table->timestamp('tgl_booking')->nullable(false);
            $table->enum('status', ['unpaid', 'paid', 'failed'])->default('unpaid');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
