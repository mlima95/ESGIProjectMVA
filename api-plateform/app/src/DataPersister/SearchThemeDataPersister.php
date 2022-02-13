<?php

namespace App\DataPersister;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\Entity\SearchTheme;
use App\Service\SearchVideoCallerService;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

final class SearchThemeDataPersister implements ContextAwareDataPersisterInterface
{

    private SearchVideoCallerService $service;

    public function __construct(SearchVideoCallerService $service)
    {
        $this->service = $service;
    }

    public function supports($data, array $context = []): bool
    {
        return $data instanceof SearchTheme;
    }

    /**
     * @throws TransportExceptionInterface
     * @throws JsonException
     */
    public function persist($data, array $context = [])
    {
        $data2 = [
            'keyword' => $data->getKeyword(),
            'statusId' => $data->getStatusId(),
        ];
        // call your persistence layer to save $data
        $result = $this->service->createSearchVideo($data2);

        $newSearchTheme = new SearchTheme();
        $newSearchTheme->setId($result['id']);
        $newSearchTheme->setKeyword($data->getKeyword());
        $newSearchTheme->setStatusId($data->getStatusId());

        return $newSearchTheme;
    }

    public function remove($data, array $context = [])
    {
        // call your persistence layer to delete $data
    }
}