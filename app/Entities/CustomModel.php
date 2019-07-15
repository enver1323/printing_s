<?php


namespace App\Entities;


use App\Entities\Translations\Entries\TranslationEntry;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

abstract class CustomModel extends Model
{
    public $timestamps = false;

    protected $guarded = [];

    public function getLang(string $language = null)
    {
        return (isset($language)) ? $language : App::getLocale();
    }

    protected function translationEntries(string $column)
    {
        return $this->hasMany(
            TranslationEntry::class,
            'translation_id',
            $column);
    }

    public function getEntry(string $column, string $lang = null): ?string
    {
        return $this->translationEntries($column)->where('language_code', '=', $lang)->first()->entry;
    }
}
