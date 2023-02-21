<?php

/** @noinspection PhpUnused */
/** @noinspection PhpPropertyOnlyWrittenInspection */

namespace App\Entity;

use DateTime;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

#[Gedmo\SoftDeleteable(fieldName: 'deletedAt', timeAware: false, hardDelete: false)]
#[ORM\Table(name: 'event')]
#[ORM\Entity(repositoryClass: 'App\Repository\EventRepository')]
class Event
{
    public const TYPE_OTHER = 7;

    #[ORM\Column(name: 'id', type: Types::INTEGER, nullable: false)]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'SEQUENCE')]
    #[ORM\SequenceGenerator(sequenceName: 'event_id_seq', allocationSize: 1, initialValue: 20)]
    private ?int $id = null;

    #[ORM\Column(name: 'title', type: TYPES::STRING, length: 255, nullable: false)]
    private string $title = '';

    #[ORM\Column(name: 'image_name', type: TYPES::STRING, length: 255, nullable: true)]
    private ?string $imageName = '';

    #[ORM\Column(name: 'exercise_type', type: TYPES::STRING, length: 255, nullable: true)]
    private ?string $exerciseType = '';

    #[ORM\Column(name: 'exercise_subtype', type: TYPES::STRING, length: 255, nullable: true)]
    private ?string $exerciseSubType = '';

    #[ORM\Column(name: 'description', type: TYPES::STRING, nullable: true)]
    private ?string $description;

    #[Gedmo\Timestampable(on: 'create')]
    #[ORM\Column(name: 'created_at', type: TYPES::DATETIME_MUTABLE, nullable: false)]
    private ?DateTime $createdAt = null;

    #[ORM\Column(name: 'deleted_at', type: TYPES::DATETIME_MUTABLE, nullable: true)]
    private ?DateTime $deletedAt = null;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string|null
     */
    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    /**
     * @param string|null $imageName
     */
    public function setImageName(?string $imageName): void
    {
        $this->imageName = $imageName;
    }

    /**
     * @return string|null
     */
    public function getExerciseType(): ?string
    {
        return $this->exerciseType;
    }

    /**
     * @param string|null $exerciseType
     */
    public function setExerciseType(?string $exerciseType): void
    {
        $this->exerciseType = $exerciseType;
    }

    /**
     * @return string|null
     */
    public function getExerciseSubType(): ?string
    {
        return $this->exerciseSubType;
    }

    /**
     * @param string|null $exerciseSubType
     */
    public function setExerciseSubType(?string $exerciseSubType): void
    {
        $this->exerciseSubType = $exerciseSubType;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return DateTime|null
     */
    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param DateTime|null $createdAt
     */
    public function setCreatedAt(?DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return DateTime|null
     */
    public function getDeletedAt(): ?DateTime
    {
        return $this->deletedAt;
    }

    /**
     * @param DateTime|null $deletedAt
     */
    public function setDeletedAt(?DateTime $deletedAt): void
    {
        $this->deletedAt = $deletedAt;
    }



}
