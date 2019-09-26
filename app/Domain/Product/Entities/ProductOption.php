<?php


namespace App\Domain\Product\Entities;


use App\Domain\_core\Entity;
use App\Domain\Product\Entities\Facilities\DataValue;
use App\Domain\Product\Entities\Facilities\HasFacilities;
use App\Domain\Translation\Traits\Translatable;
use App\Domain\User\Entities\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Collection;

/**
 * Class ProductOption
 * @package App\Domain\Product\Entities
 *
 * @property integer $id
 * @property integer $product_id
 * @property string $name
 * @property string $description
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property integer $created_by
 *
 * Relations:
 * @property Product $product
 * @property User $author
 * @property DataValue[]|Collection $dataValues
 */
class ProductOption extends Entity implements HasFacilities
{
    use Translatable;

    protected $table = 'product_options';
    public $timestamps = true;
    protected $dateFormat = 'U';

    /**
     * @return array
     */
    protected function getTranslatable(): array
    {
        return ['name', 'description'];
    }

    /**
     * @return BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    /**
     * @return MorphMany
     */
    public function dataValues(): MorphMany
    {
        return $this->morphMany(DataValue::class, 'owner');
    }
}
