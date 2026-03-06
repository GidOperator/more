<?php

namespace Database\Seeders;

use App\Models\ServicePartner;
use App\Models\CategoryPartner;
use App\Models\User;
use App\Models\Image;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ServicePartnerSeeder extends Seeder
{
    public function run(): void
    {
        $category = CategoryPartner::first() ?? CategoryPartner::create(['name' => 'General', 'slug' => 'general']);
        $user = User::first() ?? User::create(['name' => 'Admin', 'email' => 'admin@example.com', 'password' => bcrypt('password')]);

        // Получаем список файлов
        $files = Storage::disk('public')->files('services');

        for ($i = 1; $i <= 30; $i++) {
            $name = "Услуга номер {$i}";
            $service = ServicePartner::create([
                'name'                => $name,
                'slug'                => Str::slug($name) . '-' . $i,
                'description'         => "Описание услуги {$i}...",
                'min_people'          => rand(1, 5),
                'max_people'          => rand(6, 20),
                'price'               => rand(1000, 50000),
                'is_price_from'       => (bool)rand(0, 1),
                'partner_id'          => $user->id,
                'category_partner_id' => $category->id,
            ]);

            // Привязываем 1-2 случайные картинки к услуге
            if (!empty($files)) {
                $randomFiles = array_rand(array_flip($files), rand(1, 2));
                $selectedFiles = is_array($randomFiles) ? $randomFiles : [$randomFiles];

                foreach ($selectedFiles as $index => $filePath) {
                    $service->images()->create([
                        'path' => $filePath,
                        'sort' => $index,
                        'alt'  => 'Фото услуги ' . $name,
                    ]);
                }
            }
        }
    }
}
