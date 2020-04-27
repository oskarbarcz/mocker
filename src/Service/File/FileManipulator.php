<?php declare(strict_types=1);

namespace App\Service\File;

use App\Service\File\Strategy\FileDetailsInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\File;

/**
 * Class that manages file manipulation
 *
 * This object never should be created directly, use ManipulatorBuilder instead
 */
class FileManipulator
{
    private FileDetailsInterface $strategy;
    private Filesystem $filesystem;

    public function setStrategy(FileDetailsInterface $strategy): void
    {
        $this->strategy = $strategy;
    }

    public function setFilesystem(Filesystem $filesystem): void
    {
        $this->filesystem = $filesystem;
    }

    /**
     * Returns file if exists and null if not
     *
     * @return File|null
     */
    public function get(): ?File
    {
        if ($this->filesystem->exists($this->strategy->getFilePath())) {
            return new File($this->strategy->getFilePath());
        }
        return null;
    }

    public function create(string $content): void
    {
        $this->filesystem->dumpFile($this->strategy->getFilePath(), $content);
    }

    public function delete(): void
    {
        $this->filesystem->remove($this->strategy->getFilePath());
    }
}
