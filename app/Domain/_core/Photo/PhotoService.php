<?php


namespace App\Domain\_core\Photo;


use App\Domain\_core\Service;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Constraint;
use Intervention\Image\Facades\Image;
use Intervention\Image\Image as InterventionImage;
use Intervention\Image\ImageManager;

class PhotoService extends Service
{
    const SUPPORTED_FORMATS = [
        'jpeg', 'jpg', 'png', 'gif', 'tif', 'svg'
    ];

    /**
     * @param Photo $photo
     * @param UploadedFile $file
     * @return Photo|null
     */
    public static function createFromUploadedFile(Photo $photo, UploadedFile $file): ?Photo
    {
        $photo->setFileName(Str::uuid()->toString(), $file->getClientOriginalExtension());
        $photo->createDirectory();

        if (!empty($photo->sizes))
            self::modifyFile($photo, $file);

        $file->move($photo->getStoragePath(), $photo->getName());
        return $photo;
    }

    /**
     * @param Photo $photo
     * @param string $link
     * @return Photo|null
     */
    public static function createFromUrl(Photo $photo, string $link): ?Photo
    {
        $extension = last(explode('.', basename($link)));
        $fileName = sprintf("%s.%s", Str::uuid()->toString(), $extension);

        if (!in_array($extension, self::SUPPORTED_FORMATS)) {
            $photo->setFileName(null);
            return $photo;
        }

        $photo->setFileName($fileName);
        $photo->createDirectory();

        if ($extension === 'svg') {
            File::put($photo->getStoragePathName(), file_get_contents($link));
            return $photo;
        }

        $file = Image::make($link)->save($photo->getStoragePathName());
        if (!empty($photo->sizes))
            self::modifyFile($photo, $file);

        return $photo;
    }

    /**
     * @param Photo $photo
     * @param UploadedFile|InterventionImage $file
     * @return Photo|null
     */
    public static function modifyFile(Photo $photo, $file): ?Photo
    {
        if (!($file instanceof UploadedFile) && !($file instanceof InterventionImage))
            return null;

        $manager = new ImageManager();

        foreach ($photo->sizes as $prefix => $size) {
            $image = $manager->make($file);
            $size = (object)$size;

            $photo->createDirectory();

            foreach ($size->methods as $method => $param) {
                if ($param === -1)
                    $image = $image->$method($size->width, $size->height, function (Constraint $constraint) {
                        $constraint->aspectRatio();
                    });
                else
                    $image = $image->$method($param);
            }

            $image->save($photo->getStoragePathName($prefix));
        }

        return $photo;
    }

    /**
     * @param Photo $photo
     */
    public static function delete(Photo $photo): void
    {
        $photo->deleteFile($photo->getStoragePathName());
        foreach ($photo->sizes as $prefix => $size)
            $photo->deleteFile($photo->getStoragePathName($prefix));

        if (is_dir($photo->getStoragePath()) && !count(File::allFiles($photo->getStoragePath())))
            $photo->deleteDirectory();
    }
}
