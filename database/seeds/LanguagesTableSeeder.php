0<?php

use App\Domain\Translation\Entities\Language;
use Illuminate\Database\Seeder;

class LanguagesTableSeeder extends Seeder
{
    public function run(): void
    {
//        factory(Language::class, 10)->create();

        if (!Language::where('code', '=', 'ru')->count())
            Language::insert([
                'code' => 'ru',
                'name' => 'Русский'
            ]);

        if (!Language::where('code', '=', 'en')->count())
            Language::insert([
                'code' => 'en',
                'name' => 'English'
            ]);
    }
}
