<?php

declare(strict_types=1);

namespace App\Entity;

use DateTime;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Exception;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Represents database Resource entity
 *
 * @ORM\Entity(repositoryClass="App\Repository\ResourceRepository")
 * @ORM\EntityListeners({"App\EventListener\ResourceNameSlugger"})
 * @ORM\HasLifecycleCallbacks()
 */
class Resource
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Serializer\Exclude()
     */
    private ?int $id;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(min=3, max=50)
     * @ORM\Column(type="string", length=50)
     * @Serializer\Type("string")
     */
    private ?string $name = null;

    /**
     * @Assert\Length(min=1, max=80)
     * @Assert\Regex(pattern="/^[a-zA-Z0-9_-]+$/")
     * @ORM\Column(type="string", length=80, unique=true)
     * @Serializer\Type("string")
     */
    private ?string $slug = null;

    /**
     * @Assert\NotBlank()
     * @Assert\Json()
     * @ORM\Column(type="text", nullable=true)
     * @Serializer\Type("string")
     */
    private ?string $content = null;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Serializer\Type("string")
     */
    private ?string $description = null;

    /**
     * @ORM\Column(type="datetime")
     * @Serializer\Type("datetime")
     */
    private ?DateTimeInterface $createdAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): self
    {
        $this->content = $content;
        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getCreatedAt(): ?DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * Sets automatically date while persisting
     * @ORM\PrePersist()
     *
     * @return void
     * @throws Exception
     */
    public function setCreatedAt(): void
    {
        $this->createdAt = new DateTime();
    }
}
