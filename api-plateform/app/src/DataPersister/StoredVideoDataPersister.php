<?php

namespace App\DataPersister;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\Entity\StoredVideo;
use App\Service\StoredVideoCallerService;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

final class StoredVideoDataPersister implements ContextAwareDataPersisterInterface
{

    private StoredVideoCallerService $service;

    public function __construct(StoredVideoCallerService $service)
    {
        $this->service = $service;
    }

    public function supports($data, array $context = []): bool
    {
        return $data instanceof StoredVideo;
    }

    /**
     * @throws TransportExceptionInterface
     * @throws JsonException
     */
    public function persist($data, array $context = [])
    {
        // call your persistence layer to save $data
        $this->service->createStoredVideo($data);
        return $data;
    }

    public function remove($data, array $context = [])
    {
        // call your persistence layer to delete $data
    }
}