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
        Schema::create('location_subcategory_event', function (Blueprint $table) {
            $table->id();

            // Ссылка на локацию партнера
            $table->foreignId('location_partner_id')
                ->constrained('location_partners')
                ->onDelete('cascade');

            // Ссылка на подкатегорию события (из вашего сидера)
            $table->foreignId('sub_category_id')
                ->constrained('sub_categories')
                ->onDelete('cascade');

            $table->timestamps();

            $table->unique(['location_partner_id', 'sub_category_id'], 'loc_sub_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('location_subcategory_event');
    }
};
