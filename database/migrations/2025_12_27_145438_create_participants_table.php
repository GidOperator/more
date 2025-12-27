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
        Schema::create('participants', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete()
                ->unique(); // 1 пользователь = 1 профиль участника

            // Публичные данные
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('public_slug')->unique()->nullable();
            $table->text('bio')->nullable();

            // Аватар
            $table->string('avatar')->nullable();

            // Контакты
            $table->string('telegram')->nullable();
            $table->string('instagram')->nullable();

            // SEO
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('participants');
    }
};
