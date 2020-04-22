<?php declare(strict_types=1);

namespace App\Service\File\Strategy;

interface FileDetailsInterface
{
    public function getFilePath(): string;
}
