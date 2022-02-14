<?php

namespace App\DataProvider;

use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Entity\SearchTheme;
use App\Service\SearchVideoCallerService;
use JsonException;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

final class SearchThemeDataProvider implements ContextAwareCollectionDataProviderInterface, RestrictedDataProviderInterface {

    // https://api-platform.com/docs/core/data-providers/#custom-collection-data-provider

    private SearchVideoCallerService $service;

    public function __construct(SearchVideoCallerService $service)
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
        if(isset($context["filters"]["keyword"])){
            return $this->service->getSearchVideoBykeyword($context["filters"]["keyword"]);
        }else{
            return $this->service->getKeywords();
        }

    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return SearchTheme::class === $resourceClass;
    }
}