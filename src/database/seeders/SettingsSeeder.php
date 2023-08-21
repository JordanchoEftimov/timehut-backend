<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (Setting::settings as $setting) {
            Setting::query()->firstOrCreate([
                'key' => $setting['key'],
                'description' => $setting['description'],
                'value' => $setting['value'],
            ]);
        }
    }
}
