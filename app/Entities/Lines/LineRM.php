<?php


namespace App\Entities\Lines;


use App\Entities\CustomReadModel;

class LineRM extends Line implements CustomReadModel
{
    protected $table = 'lines';

    public function getById($id)
    {
        return $this->findOrFail($id);
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
