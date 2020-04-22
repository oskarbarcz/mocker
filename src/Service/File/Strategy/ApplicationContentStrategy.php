<?php declare(strict_types=1);

namespace App\Service\File\Strategy;

/**
 * Manipulator strategy for building application content file
 */
class ApplicationContentStrategy implements FileDetailsInterface
{
    private const FILE_NAME = 'MockerSettings.json';
    private string $filePath;

    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;
    }

    public function getFilePath(): string
    {
        return $this->filePath.DIRECTORY_SEPARATOR.self::FILE_NAME;
    }
}
