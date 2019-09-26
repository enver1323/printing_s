<?php


namespace App\Domain\Product\Entities\Facilities;


use App\Domain\_core\Entity;
use App\Domain\Category\Entities\Category;
use App\Domain\Translation\Traits\Translatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class DataKey
 * @package App\Domain\Product\Entities\Facilities
 *
 * @property integer $id
 * @property string $name
 * @property boolean $is_required
 * @property integer $category_id
 * @property string $input
 * @property string $type
 *
 * Relations:
 * @property DataValue $dataValues
 */
class DataKey extends Entity
{
    use Translatable;

    protected $table = 'data_keys';

    /**
     * @return HasMany
     */
    public function dataValues(): HasMany
    {
        return $this->hasMany(DataValue::class, 'data_key', 'id');
    }

    /**
     * @return array
     */
    protected function getTranslatable(): array
    {
        return ['name'];
    }
}
