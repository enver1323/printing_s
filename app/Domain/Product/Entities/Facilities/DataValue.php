<?php


namespace App\Domain\Product\Entities\Facilities;


use App\Domain\_core\Entity;
use App\Domain\Product\Entities\Product;
use App\Domain\Product\Entities\ProductOption;
use App\Domain\Translation\Traits\Translatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * Class DataValue
 * @package App\Domain\Product\Entities\Facilities
 *
 * @property integer $data_key
 * @property string $type
 * @property integer $owner_id
 * @property string $value
 *
 * Relations:
 * @property Product|ProductOption $owner
 * @property DataKey $dataKey
 */
class DataValue extends Entity
{
    use Translatable;

    protected $table = 'data_values';

    /**
     * @return MorphTo
     */
    public function owner(): MorphTo
    {
        return $this->morphTo('owner');
    }

    /**
     * @return BelongsTo
     */
    public function dataKey(): BelongsTo
    {
        return $this->belongsTo(DataKey::class, 'data_key', 'id');
    }

    /**
     * @return array
     */
    protected function getTranslatable(): array
    {
        return ['value'];
    }
}
