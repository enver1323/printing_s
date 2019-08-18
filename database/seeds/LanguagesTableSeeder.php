<?php

use App\Domain\Translation\Entities\Language;
use Illuminate\Database\Seeder;

class LanguagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Language::firstOrCreate([
            'code' => 'en',
            'name' => 'English',
        ]);
        Language::firstOrCreate([
            'code' => 'ru',
            'name' => 'Russian',
        ]);
        Language::firstOrCreate([
            'code' => 'uz',
            'name' => "O'zbek",
        ]);
    }
}
