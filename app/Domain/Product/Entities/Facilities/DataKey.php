<?php


namespace App\Domain\Product\Entities\Facilities;


use App\Domain\_core\Entity;
use App\Domain\Category\Entities\Category;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
 * @property Category $category
 */
class DataKey extends Entity
{
    protected $table = 'data_keys';

    /**
     * @return BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
