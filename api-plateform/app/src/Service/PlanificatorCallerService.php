<?php

namespace App\Service;

use App\Entity\Planificator;
use App\Entity\StoredVideo;
use App\Shared\Utils\CONSTANT;
use JsonException;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class PlanificatorCallerService {

    private HTTPService $httpService;

    private string $url;

    public function __construct(HTTPService $httpService)
    {
        $this->httpService = $httpService;
        $this->url = getenv(CONSTANT::MS_PLANIFICATOR_BASE_URL) . getenv(CONSTANT::MS_PLANIFICATOR_URI);
    }

    /**
     * @param Planificator
     * @return mixed
     * @throws JsonException
     * @throws TransportExceptionInterface
     */
    public function createPlanning(Planificator $planning): mixed
    {
        return $this->httpService->postOperation($this->url, $planning);
    }

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws ClientExceptionInterface
     * @throws JsonException
     */
    public function findAllPlannings() {
        return $this->httpService->get($this->url);
    }

}