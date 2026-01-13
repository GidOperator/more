<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $languages = [
            [
                'name' => 'Русский',
                'code' => 'ru',
            ],
            [
                'name' => 'English',
                'code' => 'en',
            ],
            [
                'name' => 'Қазақ тілі',
                'code' => 'kk',
            ],
            [
                'name' => 'Oʻzbek tili',
                'code' => 'uz',
            ],
            [
                'name' => 'Deutsch',
                'code' => 'de',
            ],
            [
                'name' => 'Français',
                'code' => 'fr',
            ],
            [
                'name' => '中文',
                'code' => 'zh',
            ],
        ];

        foreach ($languages as $language) {
            // updateOrCreate поможет не дублировать записи при повторном запуске сидера
            Language::updateOrCreate(
                ['code' => $language['code']], // поиск по коду
                ['name' => $language['name']]  // что обновить/создать
            );
        }
    }
}
