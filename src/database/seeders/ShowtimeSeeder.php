<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Showtime;

class ShowtimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Showtime::factory()->count(10)->create();

    }
}
