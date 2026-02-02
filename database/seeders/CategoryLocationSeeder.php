<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CategoryLocation;

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
                'description' => 'Описание категории 1',
            ],
            [
                'name' => 'Базы отдыха',
                'slug' => 'baza-otdyha',
                'description' => 'Описание категории 2',
            ],
            [
                'name' => 'Йога студии',
                'slug' => 'yoga-studii',
                'description' => 'Описание категории 3',
            ],
            [
                'name' => 'Бары',
                'slug' => 'bars',
                'description' => 'Описание категории 4',
            ],
            [
                'name' => 'Стадионы',
                'slug' => 'stadions',
                'description' => 'Описание категории 5',
            ],
            [
                'name' => 'Конференц-залы',
                'slug' => 'konferents-zaly',
                'description' => 'Описание категории 6',
            ],
        ];

        foreach ($data as $item) {
            CategoryLocation::updateOrCreate(
                ['name' => $item['name']],
                ['slug' => $item['slug'], 'description' => $item['description']]
            );
        }
    }
}
