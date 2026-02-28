<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CategoryLocation;
use App\Models\CategoryLocationType;
use App\Models\LocationTypeSynonym;
use Illuminate\Support\Str;

class CategoryLocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Рестораны',
                'slug' => 'restaurants',
                'description' => 'Лучшие места для изысканного ужина',
                // Иконка: рюмка и вилка
                'svg_icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8h1a4 4 0 0 1 0 8h-1"></path><path d="M2 8h10v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V8z"></path><line x1="6" y1="1" x2="6" y2="8"></line><line x1="10" y1="1" x2="10" y2="8"></line></svg>',
                'types' => [
                    [
                        'name' => 'Классический ресторан',
                        'synonyms' => ['ресторан', 'rest', 'dining', 'заведение', 'ресторанный зал']
                    ],
                    [
                        'name' => 'Кафе и бистро',
                        'synonyms' => ['кафе', 'кофейня', 'coffee shop', 'coffee', 'bistro']
                    ]
                ]
            ],
            [
                'name' => 'Базы отдыха',
                'slug' => 'baza-otdyha',
                'description' => 'Уютные места на природе',
                // Иконка: дерево и гора
                'svg_icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 10a4 4 0 0 0 -8 0v7a2 2 0 0 1 -2 2h12a2 2 0 0 1 -2 -2v-7z"></path><path d="M10 17v2"></path><path d="M14 17v2"></path><path d="M3 17v2a2 2 0 0 0 2 2h2a2 2 0 0 0 2 -2v-2"></path><path d="M17 17v2a2 2 0 0 0 2 2h2a2 2 0 0 0 2 -2v-2"></path></svg>',
                'types' => [
                    [
                        'name' => 'Турбаза',
                        'synonyms' => ['база отдыха', 'кемпинг', 'глэмпинг', 'отдых на природе']
                    ],
                    [
                        'name' => 'Загородный отель',
                        'synonyms' => ['отель', 'гостиница', 'спа отель', 'resort']
                    ]
                ]
            ],
            [
                'name' => 'Йога студии',
                'slug' => 'yoga-studii',
                'description' => 'Пространства для практик и медитаций',
                // Иконка: человек в позе лотоса
                'svg_icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 4m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path><path d="M5 21a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2"></path><path d="M19 21a2 2 0 0 1 -2 -2v-4a2 2 0 0 1 2 -2"></path><path d="M10 16a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2"></path><path d="M14 16a2 2 0 0 1 2 -2v-4a2 2 0 0 1 2 -2"></path></svg>',
                'types' => [
                    [
                        'name' => 'Центр йоги',
                        'synonyms' => ['йога', 'yoga', 'медитация', 'практики', 'асаны']
                    ],
                    [
                        'name' => 'Студия пилатеса',
                        'synonyms' => ['пилатес', 'растяжка', 'stretching', 'гибкость']
                    ]
                ]
            ],
            [
                'name' => 'Бары',
                'slug' => 'bars',
                'description' => 'Коктейли и ночная жизнь',
                // Иконка: бокал
                'svg_icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M8 21h8"></path><path d="M12 17v4"></path><path d="M16 11c0 2.21 -1.79 4 -4 4s-4 -1.79 -4 -4s-4 -3 -4 -5h12c0 2.21 -1.79 3 -4 3z"></path></svg>',
                'types' => [
                    [
                        'name' => 'Коктейльный бар',
                        'synonyms' => ['бар', 'коктейль', 'cocktail bar', 'лобби бар']
                    ],
                    [
                        'name' => 'Паб',
                        'synonyms' => ['паб', 'пивной бар', 'ирландский паб', 'английский паб', 'крафт']
                    ]
                ]
            ],
            [
                'name' => 'Стадионы',
                'slug' => 'stadions',
                'description' => 'Спортивные площадки и арены',
                // Иконка: мяч
                'svg_icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"></circle><line x1="3.6" y1="15" x2="20.4" y2="15"></line><line x1="3.6" y1="9" x2="20.4" y2="9"></line><path d="M9 3v18"></path><path d="M15 3v18"></path></svg>',
                'types' => [
                    [
                        'name' => 'Футбольное поле',
                        'synonyms' => ['стадион', 'футбол', 'арена', 'спортплощадка']
                    ],
                    [
                        'name' => 'Теннисный корт',
                        'synonyms' => ['теннис', 'корт', 'большой теннис']
                    ]
                ]
            ],
            [
                'name' => 'Конференц-залы',
                'slug' => 'konferents-zaly',
                'description' => 'Деловые встречи и мероприятия',
                // Иконка: презентация
                'svg_icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 3v4a1 1 0 0 0 1 1h4"></path><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"></path><path d="M9 13v-1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v1a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z"></path><path d="M12 14v3"></path></svg>',
                'types' => [
                    [
                        'name' => 'Бизнес-пространство',
                        'synonyms' => ['конференц-зал', 'митинг рум', 'meeting room', 'зал для презентаций']
                    ],
                    [
                        'name' => 'Коворкинг',
                        'synonyms' => ['коворкинг', 'рабочее место', 'coworking', 'офис на час']
                    ]
                ]
            ],
        ];

        foreach ($data as $categoryData) {
            // Создаем основную категорию
            $category = CategoryLocation::updateOrCreate(
                ['slug' => $categoryData['slug']],
                [
                    'name' => $categoryData['name'],
                    'description' => $categoryData['description'],
                    'svg_icon' => $categoryData['svg_icon']
                ]
            );

            // Создаем типы для этой категории
            foreach ($categoryData['types'] as $typeData) {
                $type = CategoryLocationType::updateOrCreate(
                    [
                        'category_location_id' => $category->id,
                        'slug' => Str::slug($typeData['name'])
                    ],
                    ['name' => $typeData['name']]
                );

                // Создаем синонимы для каждого типа
                foreach ($typeData['synonyms'] as $synonymText) {
                    LocationTypeSynonym::updateOrCreate([
                        'category_location_type_id' => $type->id,
                        'synonym' => mb_strtolower($synonymText)
                    ]);
                }
            }
        }
    }
}
