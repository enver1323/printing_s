<?php

namespace App\Domain\Translation\Entities;

use App\Domain\_core\Entity;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Language
 * @package App\Domain\Translation
 * @property string $code
 * @property string $name
 * @mixin \Eloquent
 */
class Language extends Entity
{
    protected $fillable = ['code', 'name'];

    protected $table = 'languages';

    public $timestamps = false;

    public $incrementing = false;

    protected $primaryKey = 'code';

}
