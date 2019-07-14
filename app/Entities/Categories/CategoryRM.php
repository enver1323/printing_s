<?php


namespace App\Entities\Categories;


use App\Entities\CustomReadModel;

class CategoryRM extends Category implements CustomReadModel
{
    protected $table = 'categories';

    protected $fillable = [];

    public function getById($id): self
    {
        return $this->findOrFali($id);
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
