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
        Schema::create('service_partners', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description');

            $table->integer('min_people')->default(1);
            $table->integer('max_people')->nullable();

            $table->decimal('price', 15, 2)->default(0);
            $table->boolean('is_price_from')->default(false);

            $table->foreignId('partner_id')->constrained();
            $table->foreignId('category_partner_id')->constrained();
            $table->foreignId('location_partners_id')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_partners');
    }
};
