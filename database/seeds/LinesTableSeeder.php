<?php


use App\Domain\Line\Entities\Line;
use Illuminate\Database\Seeder;

class LinesTableSeeder extends Seeder
{
    public function run()
    {
        Line::firstOrCreate(['name->en' => 'Office']);
        Line::firstOrCreate(['name->en' => 'Semi-Professional']);
        Line::firstOrCreate(['name->en' => 'Professional']);
        Line::firstOrCreate(['name->en' => 'Consumables']);
    }
}
