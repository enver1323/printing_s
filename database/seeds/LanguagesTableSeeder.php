0<?php

use App\Domain\Translation\Entities\Language;
use Illuminate\Database\Seeder;

class LanguagesTableSeeder extends Seeder
{
    public function run(): void
    {
//        factory(Language::class, 10)->create();

        Language::firstOrCreate([
            'code' => 'ru',
            'name' => 'Русский'
        ]);
        Language::firstOrCreate([
            'code' => 'en',
            'name' => 'English'
        ]);
    }
}
