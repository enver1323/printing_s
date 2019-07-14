<?php


namespace App\Entities\Translations\Entries;


use App\Entites\CustomReadModel;
use App\Entites\Languages\Language;
use App\Entites\Translations\Entries\TranslationEntry;
use App\Entites\Translations\Translation;

/**
 * Class TranslationEntryRM
 * @package App\Entites\Translations\Entries
 *
 * @property integer $id
 * @property integer $translation_id
 * @property string $language_code
 * @property string $entry
 *
 * Relations:
 * @property Translation $translation
 * @property Language $language
 */
class TranslationEntryRM extends TranslationEntry implements CustomReadModel
{
    protected $fillable = [];

    public function getById($id)
    {
        return $this->findOrfail($id);
    }

    public function getAll()
    {
        return $this->all();
    }

    public function getPaginated(int $itemsPerPage)
    {
        return $this->paginate($itemsPerPage);
    }
}
