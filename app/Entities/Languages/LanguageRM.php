<?php


namespace App\Entites\Languages;


use App\Entites\CustomReadModel;
use Illuminate\Support\Collection;

/**
 * Class LanguageRM
 * @package App\Entites\Languages
 *
 * @property string $code
 * @property string $name
 *
 * Relations:
 * @property Collection $translations
 */
class LanguageRM extends Language implements CustomReadModel
{
    protected $table = 'languages';

    protected $fillable = [];

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
