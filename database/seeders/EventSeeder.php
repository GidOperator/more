<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event;
use App\Models\Image;
use App\Models\SubCategory;
use App\Models\Organizer;
use App\Models\City;
use App\Models\CategoryPartner;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        $images = Storage::disk('public')->files('event');

        if (empty($images)) {
            $this->command->error('❌ Нет изображений в storage/app/public/event');
            return;
        }

        $organizerIds = Organizer::pluck('id');
        $cityIds = City::pluck('id');
        $partnerCategoryIds = CategoryPartner::pluck('id');

        if ($organizerIds->isEmpty() || $cityIds->isEmpty()) {
            $this->command->error('❌ Проверьте наличие Организаторов и Городов в базе');
            return;
        }

        $subCategories = SubCategory::all();

        foreach ($subCategories as $subCategory) {
            for ($i = 1; $i <= 3; $i++) {
                $name = $subCategory->name . ' — событие ' . $i;

                $hasDiscount = rand(0, 1);
                $discountType = $hasDiscount ? collect(['percent', 'amount'])->random() : null;
                $discountValue = $hasDiscount ? ($discountType === 'percent' ? rand(5, 50) : rand(100, 1000)) : null;

                $event = Event::create([
                    'name' => $name,
                    'description' => 'Описание события: ' . $name,
                    'slug' => Str::slug($name) . '-' . uniqid(),
                    'city_id' => $cityIds->random(),
                    'address' => 'ул. Примерная, ' . rand(1, 100),
                    'date_start' => now()->addDays(rand(1, 10)),
                    'date_end' => now()->addDays(rand(11, 20)),
                    'time_start' => '18:00',
                    'time_end' => '22:00',
                    'price' => rand(500, 12000),
                    'price_from' => (bool)rand(0, 1),
                    'has_discount' => $hasDiscount,
                    'discount_type' => $discountType,
                    'discount_value' => $discountValue,
                    'max_participants' => rand(10, 50),
                    'category_id' => $subCategory->category_id,
                    'sub_category_id' => $subCategory->id,
                    'organizer_id' => $organizerIds->random(),
                ]);

                // --- ИСПРАВЛЕННЫЙ БЛОК ПРИВЯЗКИ ИЗОБРАЖЕНИЙ ---
                collect($images)->random(rand(1, 4))->each(function ($path, $index) use ($event) {
                    // Используем связь morphMany. Laravel сам заполнит:
                    // imageable_id = $event->id
                    // imageable_type = App\Models\Event
                    $event->images()->create([
                        'path' => $path,
                        'alt' => $event->name,
                        'title' => $event->name,
                        'sort' => $index,
                    ]);
                });
                // ----------------------------------------------

                if ($partnerCategoryIds->isNotEmpty()) {
                    $event->partnerCategories()->attach(
                        $partnerCategoryIds->random(rand(1, 3))
                    );
                }
            }
        }

        $this->command->info('✅ Events + Images (Polymorphic) + Partners успешно созданы!');
    }
}
