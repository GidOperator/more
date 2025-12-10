<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            [
                'name' => 'Я Участник',
                'description' => 'Вы можете просматривать события, участвовать в обсуждениях и принимать участие как посетитель.',
            ],
            [
                'name' => 'Я Организатор',
                'description' => 'Вы можете как участвовать в событиях, так и создавать свои, а также приглашать к участию Партнёров.',
            ],
            [
                'name' => 'Я Партнёр',
                'description' => 'Вы можете участвовать в событиях как посетитель или партнёр, например, предоставлять свои услуги на мероприятиях Организаторов.',
            ],
        ];

        foreach ($roles as $role) {
            Role::updateOrCreate(
                ['name' => $role['name']],
                ['description' => $role['description']]
            );
        }

        $this->command->info('Роли успешно созданы с описаниями!');
    }
}
