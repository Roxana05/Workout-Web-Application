<?php

/** @noinspection PhpUnused */
/** @noinspection PhpPropertyOnlyWrittenInspection */

namespace App\Entity;

use DateTime;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

#[Gedmo\SoftDeleteable(fieldName: 'deletedAt', timeAware: false, hardDelete: false)]
#[ORM\Table(name: 'user_event')]
#[ORM\Entity(repositoryClass: 'App\Repository\UserEventRepository')]
class UserEvent
{
    public const TYPE_OTHER = 7;

    #[ORM\Column(name: 'id', type: Types::INTEGER, nullable: false)]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'SEQUENCE')]
    #[ORM\SequenceGenerator(sequenceName: 'user_event_id_seq', allocationSize: 1, initialValue: 1)]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: 'App\Entity\User')]
    #[ORM\JoinColumn(name: 'user_id', referencedColumnName: 'id')]
    private ?User $user = null;

    #[ORM\ManyToOne(targetEntity: 'App\Entity\Event')]
    #[ORM\JoinColumn(name: 'exercise_id', referencedColumnName: 'id')]
    private ?Event $event = null;

    #[ORM\Column(name: 'exercise_date', type: TYPES::DATETIME_MUTABLE, nullable: false)]
    private ?DateTime $exerciseDate = null;

    #[Gedmo\Timestampable(on: 'create')]
    #[ORM\Column(name: 'created_at', type: TYPES::DATETIME_MUTABLE, nullable: false)]
    private ?DateTime $createdAt = null;

    #[ORM\Column(name: 'deleted_at', type: TYPES::DATETIME_MUTABLE, nullable: true)]
    private ?DateTime $deletedAt = null;

    #[ORM\Column(name: 'weight', type: TYPES::INTEGER, nullable: true)]
    private ?int $weight = null;

    #[ORM\Column(name: 'reps', type: TYPES::INTEGER, nullable: true)]
    private ?int $reps = null;

    #[ORM\Column(name: 'duration', type: TYPES::INTEGER, nullable: true)]
    private ?int $duration = null;

    #[ORM\Column(name: 'completed', type: TYPES::BOOLEAN, nullable: false)]
    private ?bool $completed = false;

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
     * @return User|null
     */
    public function getUser(): ?User
    {
        return $this->user;
    }

    /**
     * @param User|null $user
     */
    public function setUser(?User $user): void
    {
        $this->user = $user;
    }

    /**
     * @return Event|null
     */
    public function getEvent(): ?Event
    {
        return $this->event;
    }

    /**
     * @param Event|null $event
     */
    public function setEvent(?Event $event): void
    {
        $this->event = $event;
    }

    /**
     * @return DateTime|null
     */
    public function getExerciseDate(): ?DateTime
    {
        return $this->exerciseDate;
    }

    /**
     * @param DateTime|null $exerciseDate
     */
    public function setExerciseDate(?DateTime $exerciseDate): void
    {
        $this->exerciseDate = $exerciseDate;
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

    /**
     * @return int|null
     */
    public function getWeight(): ?int
    {
        return $this->weight;
    }

    /**
     * @param int|null $weight
     */
    public function setWeight(?int $weight): void
    {
        $this->weight = $weight;
    }

    /**
     * @return int|null
     */
    public function getReps(): ?int
    {
        return $this->reps;
    }

    /**
     * @param int|null $reps
     */
    public function setReps(?int $reps): void
    {
        $this->reps = $reps;
    }

    /**
     * @return int|null
     */
    public function getDuration(): ?int
    {
        return $this->duration;
    }

    /**
     * @param int|null $duration
     */
    public function setDuration(?int $duration): void
    {
        $this->duration = $duration;
    }

    /**
     * @return bool|null
     */
    public function getCompleted(): ?bool
    {
        return $this->completed;
    }

    /**
     * @param bool|null $completed
     */
    public function setCompleted(?bool $completed): void
    {
        $this->completed = $completed;
    }
}
