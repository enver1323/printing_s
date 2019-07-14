<?php


namespace App\Entites\Languages;


use App\Entites\CustomReadModel;

class LanguageRM extends Language implements CustomReadModel
{
    protected $table = 'languages';

    public function getById($id)
    {
        // TODO: Implement getById() method.
    }

    public function getAll()
    {
        // TODO: Implement getAll() method.
    }

    public function getPaginated(int $itemsPerPage)
    {
        // TODO: Implement getPaginated() method.
    }
}
