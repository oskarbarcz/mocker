<?php declare(strict_types=1);

namespace App\Exception;

use Exception;
use Throwable;

class FileNotFoundException extends Exception
{
    private string $fileName;

    public function __construct($fileName = '', $code = 0, Throwable $previous = null)
    {
        $this->fileName = $fileName;
        $message = "File \"{$this->fileName}\" not found.";
        parent::__construct(
            $message,
            $code,
            $previous
        );
    }

    public function getFileName(): string
    {
        return $this->fileName;
    }
}
