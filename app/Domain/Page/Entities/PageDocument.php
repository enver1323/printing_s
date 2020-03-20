<?php


namespace App\Domain\Page\Entities;


use App\Domain\_core\Entity;
use App\Domain\_core\Manual\HasManual;
use App\Domain\_core\Photo\HasPhoto;
use App\Domain\_core\Photo\Photo;
use App\Domain\Translation\Traits\Translatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class pageImage
 * @package App\Domain\page\Entities
 *
 * @property integer $id
 * @property integer $page_id
 * @property string $name
 * @property Photo $photo
 *
 * Relations:
 * @property Page $page
 */
class PageDocument extends Entity
{
    use HasManual;

    protected $table = 'pages_documents';

    /**
     * @return BelongsTo
     */
    public function page(): BelongsTo
    {
        return $this->belongsTo(page::class, 'page_id', 'id');
    }

    /**
     * @inheritDoc
     */
    protected function getManualDirectoryPath(): string
    {
        return 'pages';
    }
}
