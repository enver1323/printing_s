<?php


namespace App\Entities\Translations\Entries;


use App\Entites\CustomReadModel;
use App\Entites\Translations\Entries\TranslationEntry;

class TranslationEntryRM extends TranslationEntry implements CustomReadModel
{

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
