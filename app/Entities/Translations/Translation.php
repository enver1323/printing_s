<?php


namespace App\Entities\Translations;


use App\Entities\CustomModel;
use App\Entities\Languages\Language;
use App\Entities\Translations\Entries\TranslationEntry;
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

    protected $guarded = [];

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
