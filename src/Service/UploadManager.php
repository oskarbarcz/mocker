<?php

declare(strict_types=1);

namespace App\Service;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class UploadManager
{
    private string $targetPath;

    public function __construct(string $targetPath)
    {
        $this->targetPath = $targetPath;
    }

    public function upload(UploadedFile $file)
    {
        $fileName = 'imported.'.$file->guessExtension();
        $file->move($this->targetPath, $fileName);

        return $fileName;
    }
}
