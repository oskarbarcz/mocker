<?php declare(strict_types=1);

namespace App\Service;

use RuntimeException;

class JsonFileLoader
{
    private const FILE_EXT = '.json';
    private string $folderPath;

    public function __construct(string $folderPath)
    {
        $this->folderPath = $folderPath;
    }

    /**
     * Returns JSON file content
     *
     * @param string $filename
     * @return string
     */
    public function load(string $filename): string
    {
        $path = $this->makeFilePath($filename);

        if (!file_exists($path)) {
            dd($path);
            throw new RuntimeException('File not found.');
        }

        return file_get_contents($path);
    }

    private function makeFilePath(string $filename): string
    {
        return __DIR__ . '/../../' . $this->folderPath . $filename . self::FILE_EXT;
    }
}
