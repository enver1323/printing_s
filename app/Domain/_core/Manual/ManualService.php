<?php


namespace App\Domain\_core\Manual;


use App\Domain\_core\Service;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Constraint;
use Intervention\Image\Facades\Image;
use Intervention\Image\Image as InterventionImage;
use Intervention\Image\ImageManager;

class ManualService extends Service
{
    /**
     * @param Manual $manual
     * @param UploadedFile $file
     * @return Manual|null
     */
    public static function createFromUploadedFile(Manual $manual, UploadedFile $file): ?Manual
    {
        $manual->setFileName(Str::uuid()->toString(), $file->getClientOriginalExtension());
        $manual->createDirectory();

        $file->move($manual->getStoragePath(), $manual->getName());
        return $manual;
    }
    /**
     * @param Manual $manual
     */
    public static function delete(Manual $manual): void
    {
        $manual->deleteFile($manual->getStoragePathName());

        if (is_dir($manual->getStoragePath()) && !count(File::allFiles($manual->getStoragePath())))
            $manual->deleteDirectory();
    }
}
