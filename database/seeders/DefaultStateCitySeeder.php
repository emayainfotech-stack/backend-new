<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\State;
use Illuminate\Database\Seeder;

class DefaultStateCitySeeder extends Seeder
{
    public function run(): void
    {
        $state = State::query()->firstOrCreate(
            ['name' => 'Rajasthan'],
            ['name' => 'Rajasthan'],
        );

        City::query()->firstOrCreate(
            [
                'state_id' => $state->id,
                'name' => 'Jaipur',
            ],
            [
                'state_id' => $state->id,
                'name' => 'Jaipur',
            ],
        );
    }
}
