<?php


namespace App\Entities\News;


use App\Entities\CustomModel;
use App\Entities\Translations\Entries\TranslationEntry;
use App\Entities\Users\User;

/**
 * Class News
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
class News extends CustomModel
{
    protected $table = 'news';

    public function nameEntries()
    {
        return parent::translationEntries('name');
    }

    public function descEntries()
    {
        return parent::translationEntries('description');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }
}
