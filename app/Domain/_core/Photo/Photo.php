<?php


namespace App\Domain\_core\Photo;



use Illuminate\Support\Facades\File;

/**
 * Class Photo
 * @package App\Domain\_core\Photo
 *
 * @property string $path
 * @property string $rootDirectory
 * @property string $fileName
 * @property array $sizes
 */
class Photo
{
    protected $rootDirectory;
    protected $path;
    protected $fileName;
    public $sizes;

    public function __construct(string $path, array $sizes)
    {
        $this->parsePath($path);
        $this->sizes = $sizes;
    }

    /**
     * @param string|null $size
     * @return string
     */
    public function getUrl(string $size = null): ?string
    {
        return asset(sprintf("storage/%s/%s", $this->getFullPath(), $this->getName($size)));
    }

    /**
     * @param string|null $size
     * @return string|null
     */
    public function getStoragePathName(string $size = null): ?string
    {
        return sprintf("%s/%s", $this->getStoragePath(), $this->getName($size));
    }

    /**
     * @return string
     */
    public function getStoragePath(): string
    {
        return storage_path(sprintf('app/public/%s', $this->getFullPath()));
    }

    /**
     * @param string|null $size
     * @return string
     */
    public function getName(string $size = null): ?string
    {
        return isset($size) ? sprintf("%s_%s", $size, $this->fileName) : $this->fileName;
    }

    /**
     * @return string|null
     */
    public function getFullPath(): ?string
    {
        return sprintf("%s/%s", $this->rootDirectory, $this->path);
    }

    /**
     * @param string $path
     */
    private function parsePath(string $path): void
    {
        $path = collect(explode('/', $path));

        $this->rootDirectory = $path->first();
        $path = $path->slice(1);

        $this->fileName = $path->last() && substr_count($path->last(), '.') ? $path->last() : null;

        $this->path = $path->implode('/');
        $this->path = $this->fileName ? str_replace($this->fileName, '', $this->path) : $this->path;
        $this->path = substr($this->path, -1) === '/' ? substr($this->path, 0, -1) : $this->path;
    }

    /**
     * @param string $fileName
     * @param string $extension
     */
    public function setFileName(string $fileName = null, string $extension = null): void
    {
        $this->fileName = $extension ? "$fileName.$extension" : $fileName;
    }

    public function createDirectory(): void
    {
        $directory = $this->getStoragePath();
        if (!is_dir($directory) && !File::isDirectory($directory))
            mkdir($directory, 0777, true);
    }

    public function deleteDirectory(): void
    {
        $directory = $this->getStoragePath();
        if (is_dir($directory) && File::isDirectory($directory))
            File::deleteDirectory($directory);
    }

    /**
     * @param string $filePath
     */
    public function deleteFile(string $filePath): void
    {
        if(file_exists($filePath) && File::isFile($filePath))
            File::delete($filePath);
    }
}
