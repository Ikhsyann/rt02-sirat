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
        Schema::create('nomor_darurats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('unit_darurat_id')->constrained('unit_darurats')->cascadeOnDelete();
            $table->string('lokasi');
            $table->string('nomor_telepon');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nomor_darurats');
    }
};
