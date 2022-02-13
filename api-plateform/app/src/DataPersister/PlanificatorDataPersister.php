<?php

namespace App\DataPersister;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\Entity\Planificator;
use App\Service\PlanificatorCallerService;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

final class PlanificatorDataPersister implements ContextAwareDataPersisterInterface
{

    private PlanificatorCallerService $service;

    public function __construct(PlanificatorCallerService $service)
    {
        $this->service = $service;
    }

    public function supports($data, array $context = []): bool
    {
        return $data instanceof Planificator;
    }

    /**
     * @throws TransportExceptionInterface
     * @throws JsonException
     * @throws \JsonException
     */
    public function persist($data, array $context = [])
    {
        // call your persistence layer to save $data
            return $this->service->createPlanning($data);
    }

    public function remove($data, array $context = [])
    {
        // call your persistence layer to delete $data
    }
}