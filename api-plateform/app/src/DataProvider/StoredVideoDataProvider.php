<?php

namespace App\DataProvider;

use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Entity\StoredVideo;
use App\Service\StoredVideoCallerService;

final class StoredVideoDataProvider implements ContextAwareCollectionDataProviderInterface, RestrictedDataProviderInterface {

    // https://api-platform.com/docs/core/data-providers/#custom-collection-data-provider

    private StoredVideoCallerService $service;

    public function __construct(StoredVideoCallerService $service)
    {
        $this->service = $service;
    }

    public function getCollection(string $resourceClass, string $operationName = null, array $context = [])
    {

//         Context
//      {
//              "filters": {
//              "page": "1"
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
       return [
           "ressource" => $resourceClass,
           "operationName" => $operationName,
           "context" => $context
       ];
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return StoredVideo::class === $resourceClass;
    }
}