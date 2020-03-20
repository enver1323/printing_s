<?php


namespace App\Domain\_core\Manual;

use Illuminate\Http\UploadedFile;

/**
 * Trait ManageManuals
 * @package App\Domain\_core\Manual\Traits
 *
 * @property Manual $ManualObject
 * @property Manual $Manual
 * @property string $ManualDirectoryPath
 * @mixin \Eloquent
 */
trait HasManual
{
    public $ManualObject = null;

    public static function bootManagesManual()
    {
        self::deleting(function ($entity){
            $entity->deleteManual();
        });
    }

    /**
     * @param string $name
     * @return Manual
     */
    public function getManualAttribute(string $name = null): ?Manual
    {
        if ($name === null)
            return null;

        if ($this->ManualObject === null)
            $this->setManualObject($name);

        return $this->ManualObject;
    }

    /**
     * @param UploadedFile|string $image
     */
    public function setManualAttribute($image): void
    {
        if ($this->ManualObject === null)
            $this->setManualObject();

        if ($image instanceof UploadedFile)
            $this->ManualObject = ManualService::createFromUploadedFile($this->ManualObject, $image);

        if(is_string($image))
            $this->ManualObject = ManualService::createFromUrl($this->ManualObject, $image);

        $this->attributes['manual'] = $this->ManualObject->getName();
    }

    /**
     * @param string|null $name
     */
    protected function setManualObject(string $name = null): void
    {
        $this->ManualObject = new Manual($this->getManualPath($name));
    }

    /**
     * @throws \Throwable
     */
    public function deleteManual(): void
    {
        if(isset($this->Manual))
            ManualService::delete($this->ManualObject);

        $this->attributes['manual'] = null;
        $this->saveOrFail();
    }

    /**
     * @param UploadedFile|string $manual
     * @throws \Throwable
     */
    public function updateManual($manual): void
    {
        $this->deleteManual();
        $this->setManualAttribute($manual);
        $this->saveOrFail();
    }

    /**
     * @param string|null $name
     * @return string
     */
    private function getManualPath(string $name = null): string
    {
        return sprintf('%s/%s/%s', $this->getManualDirectoryPath(), $this->getKey(), $name);
    }

    /**
     * @return string
     */
    protected abstract function getManualDirectoryPath(): string;
}
