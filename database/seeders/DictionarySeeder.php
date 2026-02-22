<?php

namespace Database\Seeders;

use App\Models\Dictionary;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DictionarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Только типы локаций (Location Types)
        $types = [
            'Лофт',
            'Фотостудия',
            'Зал для мероприятий',
            'Особняк',
            'Крыша',
            'Веранда',
            'Пентхаус',
            'Творческая мастерская',
            'Ангар',
            'Загородный дом',
            'Офис / Конференц-зал',
            'Ресторан / Кафе'
        ];

        foreach ($types as $index => $label) {
            Dictionary::updateOrCreate(
                [
                    // Уникальный ключ для поиска существующей записи
                    'collection' => 'location_type',
                    'code' => Str::slug($label)
                ],
                [
                    // Что обновляем или создаем
                    'label' => $label,
                    'sort' => ($index + 1) * 10
                ]
            );
        }
    }
}
