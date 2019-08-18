<?php


namespace App\Domain\_core\Photo;

use Illuminate\Http\UploadedFile;

/**
 * Trait ManagePhotos
 * @package App\Domain\_core\Photo\Traits
 *
 * @property Photo $photoObject
 * @property Photo $photo
 * @property string $photoDirectoryPath
 * @mixin \Eloquent
 */
trait ManagesPhotos
{
    public $photoObject = null;

    public static function bootManagesPhoto()
    {

        self::deleting(function ($entity){
            $entity->deletePhoto();
        });
    }

    /**
     * @param string $name
     * @return Photo
     */
    public function getPhotoAttribute(string $name = null): ?Photo
    {
        if ($name === null)
            return null;

        if ($this->photoObject === null)
            $this->setPhotoObject($name);

        return $this->photoObject;
    }

    /**
     * @param UploadedFile|string $image
     */
    public function setPhotoAttribute($image): void
    {
        if ($this->photoObject === null)
            $this->setPhotoObject();
        if ($image instanceof UploadedFile)
            $this->photoObject = PhotoService::createFromUploadedFile($this->photoObject, $image);

        if(is_string($image))
            $this->photoObject = PhotoService::createFromUrl($this->photoObject, $image);

        $this->attributes['photo'] = $this->photoObject->getName();
    }

    /**
     * @param string|null $name
     */
    protected function setPhotoObject(string $name = null): void
    {
        $this->photoObject = new Photo($this->getPhotoPath($name), $this->getPhotoSizes());
    }

    /**
     * @throws \Throwable
     */
    public function deletePhoto(): void
    {
        if(isset($this->photo))
            PhotoService::delete($this->photoObject);

        $this->attributes['photo'] = null;
        $this->saveOrFail();
    }

    /**
     * @param UploadedFile|string $image
     * @throws \Throwable
     */
    public function updatePhoto($image): void
    {
        $this->deletePhoto();
        $this->setPhotoAttribute($image);
        $this->saveOrFail();
    }

    /**
     * @param string|null $name
     * @return string
     */
    private function getPhotoPath(string $name = null): string
    {
        return sprintf('%s/%s/%s', $this->getPhotoDirectoryPath(), $this->getKey(), $name);
    }

    protected abstract function getPhotoSizes(): array;
    protected abstract function getPhotoDirectoryPath(): string;
}
