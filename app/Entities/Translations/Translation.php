<?php


namespace App\Entites\Translations;


use App\Entites\CustomModel;
use App\Entites\Languages\Language;
use App\Entites\Translations\Entries\TranslationEntry;
use Illuminate\Support\Collection;

/**
 * Class TranslationModel
 * @package App\Entites\Translations
 *
 * @property integer $id
 * @property string $key
 *
 * Relations:
 * @property Collection $languages
 * @property Collection $entries
 * @property Collection $groups
 */
class Translation extends CustomModel
{
    protected $table = 'translations';

    public function getEntry(string $lang) : string
    {
        return $this->entries()->where('language_code', '=', $lang)->first()->entry;
    }

    public function languages()
    {
        return $this->belongsToMany(Language::class,
            'translations_entries',
            'translation_id',
            'language_code'
        );
    }

    public function entries()
    {
        return $this->hasMany(
            TranslationEntry::class,
            'translation_id',
            'id');
    }
}
