<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\City;
use App\Models\Organizer;
use App\Models\Partner;
use App\Models\Participant;
use App\Models\Language;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Support\Str;
use App\Models\PublicPage;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        // Очищаем события, чтобы избежать кэширования в долгом цикле
        Participant::flushEventListeners();
        Organizer::flushEventListeners();
        Partner::flushEventListeners();

        $faker = Faker::create('ru_RU');

        $roles = Role::all();
        $cities = City::all();
        $languages = Language::all();

        $avatarsDir = storage_path('app/public/people');
        $avatars = glob($avatarsDir . '/*.{jpg,jpeg,png}', GLOB_BRACE);

        for ($i = 1; $i <= 100; $i++) {
            DB::transaction(function () use ($faker, $roles, $cities, $languages, $avatars) {
                $city = $cities->random();
                $avatarPath = $avatars ? $avatars[array_rand($avatars)] : null;
                $avatar = $avatarPath ? 'storage/people/' . basename($avatarPath) : null;

                // 1. Создаем пользователя
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

                // 2. Определяем роли
                $assignedRoles = $roles->random(rand(1, 3))->pluck('id')->toArray();

                // Логика: если выпал Орг(2) или Партнер(3), то Участник(1) должен быть обязательно
                if (in_array(2, $assignedRoles) || in_array(3, $assignedRoles)) {
                    if (!in_array(1, $assignedRoles)) {
                        $assignedRoles[] = 1;
                    }
                }

                $user->roles()->sync($assignedRoles);

                // 3. Создаем профиль УЧАСТНИКА
                if (in_array(1, $assignedRoles)) {
                    $participant = Participant::create([
                        'user_id' => $user->id,
                        'first_name' => $user->name,
                        'last_name' => $user->surname,
                        'bio' => $user->bio,
                        'avatar' => $user->avatar,
                        'telegram' => '@' . $faker->word,
                        'instagram' => '@' . $faker->word,
                        'meta_title' => $faker->sentence(3),
                        'meta_description' => $faker->sentence,
                    ]);

                    // --- ПРЯМОЕ СОЗДАНИЕ ПУБЛИЧНОЙ СТРАНИЦЫ (УЧАСТНИК) ---
                    $name = $participant->first_name . ' ' . $participant->last_name;
                    $baseSlug = Str::slug($name);
                    $slug = $baseSlug;

                    if (PublicPage::where('slug', $slug)->exists()) {
                        $slug = $baseSlug . '-' . $participant->id;
                    }

                    $participant->publicPage()->create([
                        'slug' => $slug,
                        'title' => $name,
                        'is_published' => true,
                    ]);
                    // ----------------------------------------------------

                    if ($languages->isNotEmpty()) {
                        $participant->languages()->attach($languages->random(rand(1, 2))->pluck('id'));
                    }
                }

                // 4. Создаем профиль ОРГАНИЗАТОРА
                if (in_array(2, $assignedRoles)) {
                    $orgName = $faker->company;
                    $organizer = Organizer::create([
                        'user_id' => $user->id,
                        'name' => $orgName,
                        'public_slug' => Str::slug($orgName) . '-' . uniqid(),
                        'description' => $faker->paragraph,
                        'email' => $user->email,
                        'phone' => $user->phone,
                        'logo' => $avatar,
                        'is_active' => true,
                    ]);

                    // --- ПРЯМОЕ СОЗДАНИЕ ПУБЛИЧНОЙ СТРАНИЦЫ (ОРГАНИЗАТОР) ---
                    $baseSlug = Str::slug($orgName);
                    $slug = $baseSlug;

                    if (PublicPage::where('slug', $slug)->exists()) {
                        $slug = $baseSlug . '-' . $organizer->id;
                    }

                    $organizer->publicPage()->create([
                        'slug' => $slug,
                        'title' => $orgName,
                        'is_published' => true,
                    ]);
                    // --------------------------------------------------------

                    if ($languages->isNotEmpty()) {
                        $organizer->languages()->attach($languages->random(rand(1, 2))->pluck('id'));
                    }
                }

                // 5. Создаем профиль ПАРТНЕРА
                if (in_array(3, $assignedRoles)) {
                    $partnerName = $faker->company . ' Partner';
                    $partner = Partner::create([
                        'user_id' => $user->id,
                        'company_name' => $partnerName,
                        'public_slug' => Str::slug($partnerName) . '-' . uniqid(),
                        'description' => $faker->sentence,
                        'is_active' => true,
                    ]);

                    // --- ПРЯМОЕ СОЗДАНИЕ ПУБЛИЧНОЙ СТРАНИЦЫ (ПАРТНЕР) ---
                    $baseSlug = Str::slug($partnerName);
                    $slug = $baseSlug;

                    if (PublicPage::where('slug', $slug)->exists()) {
                        $slug = $baseSlug . '-' . $partner->id;
                    }

                    $partner->publicPage()->create([
                        'slug' => $slug,
                        'title' => $partnerName,
                        'is_published' => true,
                    ]);
                    // ----------------------------------------------------

                    if ($languages->isNotEmpty()) {
                        $partner->languages()->attach($languages->random(rand(1, 2))->pluck('id'));
                    }
                }
            });
        }

        $this->command->info('✅ 100 пользователей, профили и все PublicPage созданы!');
    }
}
