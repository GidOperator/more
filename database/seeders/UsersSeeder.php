<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\City;
use App\Models\Organizer;
use App\Models\Partner;
use App\Models\Participant;
use App\Models\Language; // Добавили языки
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('ru_RU');

        $roles = Role::all();
        $cities = City::all();
        $languages = Language::all(); // Получаем все языки для привязки

        $avatarsDir = storage_path('app/public/people');
        $avatars = glob($avatarsDir . '/*.{jpg,jpeg,png}', GLOB_BRACE);

        for ($i = 1; $i <= 100; $i++) {
            $city = $cities->random();
            $avatarPath = $avatars ? $avatars[array_rand($avatars)] : null;
            $avatar = $avatarPath ? 'storage/people/' . basename($avatarPath) : null;

            $user = User::create([
                'name' => $faker->firstName,
                'surname' => $faker->lastName,
                'bio' => $faker->sentence,
                'email' => $faker->unique()->safeEmail,
                'phone' => $faker->phoneNumber,
                'avatar' => $avatar,
                'password' => Hash::make('password123'),
                'city_id' => $city->id,
            ]);

            // 1. Определяем роли
            $assignedRoles = $roles->random(rand(1, 3))->pluck('id')->toArray();

            // Логика: если выпал Орг(2) или Партнер(3), то Участник(1) должен быть обязательно
            if (in_array(2, $assignedRoles) || in_array(3, $assignedRoles)) {
                if (!in_array(1, $assignedRoles)) {
                    $assignedRoles[] = 1;
                }
            }

            $user->roles()->sync($assignedRoles);

            // 2. Создаем профиль УЧАСТНИКА (если есть роль 1)
            if (in_array(1, $assignedRoles)) {
                $participant = Participant::create([
                    'user_id' => $user->id,
                    //'name' => $user->name . ' ' . $user->surname,
                    // добавьте другие поля если есть в миграции
                ]);

                // Привязываем рандомно 1-2 языка полиморфно
                if ($languages->isNotEmpty()) {
                    $participant->languages()->attach($languages->random(rand(1, 2))->pluck('id'));
                }
            }

            // 3. Создаем профиль ОРГАНИЗАТОРА (если есть роль 2)
            if (in_array(2, $assignedRoles)) {
                $organizer = Organizer::create([
                    'user_id' => $user->id,
                    'name' => $faker->company, // Для орга лучше название компании
                    'public_slug' => Str::slug($faker->company) . '-' . uniqid(),
                    'description' => $faker->paragraph,
                    'email' => $user->email,
                    'phone' => $user->phone,
                    'logo' => $avatar,
                    'is_active' => true,
                ]);

                if ($languages->isNotEmpty()) {
                    $organizer->languages()->attach($languages->random(rand(1, 2))->pluck('id'));
                }
            }

            // 4. Создаем профиль ПАРТНЕРА (если есть роль 3)
            if (in_array(3, $assignedRoles)) {
                $partner = Partner::create([
                    'user_id' => $user->id,
                    'company_name' => $faker->company . ' Partner',
                    'public_slug' => Str::slug($faker->company . '-partner') . '-' . uniqid(),
                    'description' => $faker->sentence,
                    'is_active' => true,
                ]);

                if ($languages->isNotEmpty()) {
                    $partner->languages()->attach($languages->random(rand(1, 2))->pluck('id'));
                }
            }
        }

        $this->command->info('✅ 100 пользователей с профилями и полиморфными языками созданы!');
    }
}
