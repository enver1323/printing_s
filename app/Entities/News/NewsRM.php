<?php


namespace App\Entities\News;


use App\Entities\CustomReadModel;
use App\Entities\Users\User;
use App\Entities\Translations\Entries\TranslationEntry;
use Illuminate\Support\Collection;

/**
 * Class NewsRM
 * @package App\Entities\News
 *
 * @property integer $id
 * @property integer $name
 * @property integer $description
 * @property integer $created_by
 * @property integer $created_at
 * @property integer $views
 *
 * Relations:
 * @property TranslationEntry $nameEntry
 * @property TranslationEntry $descEntry
 * @property User $user
 */
class NewsRM extends News implements CustomReadModel
{
    protected $table = 'news';

    protected $fillable = [];

    public function __get($key)
    {
        if($key === 'name')
            return $this->getTranslatedNameEntry();

        if($key === 'description')
            return $this->getTranslatedDescEntry();

        return parent::__get($key);
    }

    public function getById($id): self
    {
        return $this->findOrFail($id);
    }

    public function getAll(): ?Collection
    {
        return $this->all();
    }

    public function getPaginated(int $itemsPerPage)
    {
        return $this->paginate($itemsPerPage);
    }

    public function getTranslatedNameEntry(string $lang = null)
    {
        return $this->getEntry('name', $lang);
    }

    public function getTranslatedDescEntry(string $lang = null)
    {
        return $this->getEntry('description', $lang);
    }
}
