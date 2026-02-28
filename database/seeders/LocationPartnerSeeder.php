<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Partner;
use App\Models\LocationPartner;
use App\Models\City;
use App\Models\CategoryLocationType;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Storage;

class LocationPartnerSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('ru_RU');
        $partners = Partner::all();
        $cities = City::all();
        $types = CategoryLocationType::all();
        $subCategories = SubCategory::all();

        if ($partners->isEmpty() || $types->isEmpty()) {
            $this->command->warn('Сначала запустите UsersSeeder и CategoryLocationSeeder!');
            return;
        }

        // --- ЛОГИКА РАБОТЫ С ФОТОГРАФИЯМИ ---
        // Указываем путь к папке с картинками внутри storage
        $photoDirectory = 'location'; // Папка должна быть в storage/app/public/location

        // Получаем список файлов (у вас картинки в storage/app/public/location)
        $files = Storage::disk('public')->files($photoDirectory);

        if (empty($files)) {
            $this->command->warn("Папка storage/app/public/{$photoDirectory} пуста или не существует!");
            return;
        }
        // ------------------------------------

        foreach ($partners as $partner) {
            // Создаем 2 локации для каждого партнера
            for ($i = 0; $i < 2; $i++) {

                $name = $faker->company . ' - ' . $faker->word;

                $location = LocationPartner::create([
                    'partner_id' => $partner->id,
                    'city_id' => $cities->random()->id,
                    'category_location_type_id' => $types->random()->id,
                    'name' => $name,
                    'slug' => Str::slug($name) . '-' . uniqid(),
                    'address' => $faker->address,
                    'phone' => $faker->phoneNumber,
                    'description' => $faker->paragraph,
                ]);

                // --- ПРИВЯЗКА РЕАЛЬНЫХ ФОТО ---
                // Берем 3 случайных файла из списка файлов
                $randomPhotos = collect($files)->random(3);

                foreach ($randomPhotos as $index => $filePath) {
                    $location->images()->create([
                        // Записываем путь в базу (напр. 'location/photo.jpg')
                        'path' => $filePath,
                        'sort' => $index,
                        'alt' => 'Фото ' . $name,
                    ]);
                }
                // -----------------------------

                // Привязываем события
                $randomSubCategories = $subCategories->random(rand(2, 4))->pluck('id');
                $location->suitable_event_types()->attach($randomSubCategories);
            }
        }

        $this->command->info('✅ Локации созданы с реальными фото из папки storage!');
    }
}
