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
        Schema::create('category_location_partner', function (Blueprint $table) {
            $table->id();

            // Связь с локацией
            $table->foreignId('location_partner_id')
                ->constrained('location_partners')
                ->onDelete('cascade');

            // Связь с категорией
            $table->foreignId('category_partner_id')
                ->constrained('category_partners')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category_location_partner');
    }
};
