<?php


namespace App\Entities\Brands;


use App\Entities\CustomReadModel;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;

class BrandRM extends Brand implements CustomReadModel
{
    protected $table = 'brands';

    protected $fillable = [];

    public function __get($key)
    {
        if($key === 'name')
            return $this->nameEntries(App::getLocale());

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
}
