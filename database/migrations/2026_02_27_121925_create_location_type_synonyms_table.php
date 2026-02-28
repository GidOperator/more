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
        Schema::create('location_type_synonyms', function (Blueprint $table) {
            $table->id();

            $table->string('synonym')->index();

            $table->foreignId('category_location_type_id')->constrained('category_location_types');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('location_type_synonyms');
    }
};
