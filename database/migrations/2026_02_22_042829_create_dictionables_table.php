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
        Schema::create('dictionables', function (Blueprint $table) {
            $table->id();
            // Связь с основной таблицей справочника
            // constrained() автоматически поймет, что таблица называется dictionaries
            $table->foreignId('dictionary_id')->constrained()->onDelete('cascade');

            // Создает колонки dictionable_id и dictionable_type
            // Сюда будут записываться ID локации и класс 'App\Models\Location'
            $table->morphs('dictionable');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dictionables');
    }
};
