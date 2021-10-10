<?php

declare(strict_types=1);

namespace Oscmarb\Ddd\Domain\DomainEvent;

final class DomainEventSubscriberRegistry
{
    /** @var DomainEventSubscriber[] */
    private array $syncSubscribers = [];
    /** @var DomainEventSubscriber[] */
    private array $asyncSubscribers = [];

    /** @var array<class-string, DomainEventSubscriber[]> */
    private array $indexedSyncSubscribers = [];
    /** @var array<class-string, DomainEventSubscriber[]> */
    private array $indexedAsyncSubscribers = [];

    public function __construct(\Traversable $subscribers)
    {
        /** @var DomainEventSubscriber $subscriber */
        foreach ($subscribers as $subscriber) {
            if ($subscriber->isSynchronous()) {
                $this->addSyncSubscriber($subscriber);
                continue;
            }

            $this->addAsyncSubscriber($subscriber);
        }
    }

    private function addSyncSubscriber(DomainEventSubscriber $subscriber): void
    {
        $this->syncSubscribers[] = $subscriber;
        $this->addSubscriberToIndexedArray($this->indexedSyncSubscribers, $subscriber);
    }

    private function addAsyncSubscriber(DomainEventSubscriber $subscriber): void
    {
        $this->asyncSubscribers[] = $subscriber;
        $this->addSubscriberToIndexedArray($this->indexedAsyncSubscribers, $subscriber);
    }

    private function addSubscriberToIndexedArray(array &$subscribers, DomainEventSubscriber $subscriber): void
    {
        foreach ($subscriber::subscribedTo() as $subscribedTo) {
            if (false === isset($subscribers[$subscribedTo])) {
                $subscribers[$subscribedTo] = [];
            }

            $subscribers[$subscribedTo][] = $subscriber;
        }
    }

    /** @return DomainEventSubscriber[] */
    public function getSyncSubscribers(): array
    {
        return $this->syncSubscribers;
    }

    /** @return DomainEventSubscriber[] */
    public function getAsyncSubscribers(): array
    {
        return $this->asyncSubscribers;
    }

    /**
     * @param DomainEvent $domainEvent
     * @return DomainEventSubscriber[]
     */
    public function getSyncSubscribersByDomainEvent(DomainEvent $domainEvent): array
    {
        return $this->indexedSyncSubscribers[$domainEvent::class] ?? [];
    }

    /**
     * @param DomainEvent $domainEvent
     * @return DomainEventSubscriber[]
     */
    public function getAsyncSubscribersByDomainEvent(DomainEvent $domainEvent): array
    {
        return $this->indexedAsyncSubscribers[$domainEvent::class] ?? [];
    }
}