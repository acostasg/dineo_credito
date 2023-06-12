<?php

namespace App\Admin\Domain\Shared\Model;

use BornFree\TacticianDomainEvent\Recorder\ContainsRecordedEvents;

abstract class AggregateRoot implements ContainsRecordedEvents
{
    private array $recordedEvents = [];

    protected \DateTimeImmutable $createdAt;
    protected \DateTimeImmutable $updatedAt;
    protected ?\DateTimeImmutable $deletedAt;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->updatedAt = new \DateTimeImmutable();
        $this->deletedAt = null;
    }


    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): \DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function getDeletedAt(): ?\DateTimeImmutable
    {
        return $this->deletedAt;
    }

    public function releaseEvents(): array
    {
        $events =  $this->recordedEvents;

        $this->eraseEvents();

        return $events;
    }

    public function eraseEvents()
    {
        $this->recordedEvents = [];
    }

    public function record(object $event)
    {
        $this->recordedEvents[] = $event;
    }
}