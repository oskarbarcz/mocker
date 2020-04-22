<?php declare(strict_types=1);

namespace App\Service\File;

use App\Service\File\Strategy\FileDetailsInterface;
use Symfony\Component\Filesystem\Filesystem;

/**
 * Builds FileManipulator
 */
class ManipulatorBuilder
{
    public static function fromStrategy(FileDetailsInterface $strategy): FileManipulator
    {
        $manipulator = new FileManipulator();
        $manipulator->setFilesystem(new Filesystem());
        $manipulator->setStrategy($strategy);

        return $manipulator;
    }
}
