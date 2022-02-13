<?php

namespace App\DataProvider;

use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Entity\Planificator;
use App\Service\PlanificatorCallerService;
use JsonException;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

final class PlanificatorDataProvider implements ContextAwareCollectionDataProviderInterface, RestrictedDataProviderInterface {

    // https://api-platform.com/docs/core/data-providers/#custom-collection-data-provider

    private PlanificatorCallerService $service;

    public function __construct(PlanificatorCallerService $service)
    {
        $this->service = $service;
    }

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws ClientExceptionInterface
     * @throws JsonException
     */
    public function getCollection(string $resourceClass, string $operationName = null, array $context = [])
    {

//         Context
//      {
//              "filters": {
//              "page": "1",
          //    "status": 18
//      },
//      "groups": [
//              "read:StoredVideo"
//          ],
//      "operation_type": "collection",
//      "collection_operation_name": "get",
//      "resource_class": "App\\Entity\\StoredVideo",
//      "iri_only": false,
//      "input": null,
//      "output": null,
//      "request_uri": "/api/stored_videos?page=1",
//      "uri": "http://localhost:8888/api/stored_videos?page=1"
//    }
       return $this->service->findAllPlannings();
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return Planificator::class === $resourceClass;
    }
}