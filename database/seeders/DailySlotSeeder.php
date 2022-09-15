<?php

namespace Database\Seeders;

use App\Models\DailySlot;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DailySlotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DailySlot::truncate();
        DailySlot::create([
            'name' => 'Pagi: 08:00 - 11:00',
            'quota' => 30,
            'is_active' => true,
        ]);
        DailySlot::create([
            'name' => 'Siang: 13:00 - 15:00',
            'quota' => 30,
            'is_active' => true,
        ]);
    }
}
