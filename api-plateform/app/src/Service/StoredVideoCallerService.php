<?php

namespace App\Service;

use App\Entity\StoredVideo;
use App\Shared\Utils\CONSTANT;
use JsonException;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class StoredVideoCallerService {

    private HTTPService $httpService;

    private string $url;

    public function __construct(HTTPService $httpService)
    {
        $this->httpService = $httpService;
        $this->url = getenv(CONSTANT::MS_YT_DOWNLOADER_BASE_URL) ;
    }

    /**
     * @param StoredVideo[]
     * @return mixed
     * @throws JsonException
     * @throws TransportExceptionInterface
     */
    public function createStoredVideo(array $stoVids): mixed
    {
        return $this->httpService->postOperation($this->url . getenv(CONSTANT::MS_YT_DOWNLOADER_URI_STORED_VIDEOS_QUEUE), $stoVids);
    }

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws ClientExceptionInterface
     * @throws JsonException
     */
    public function getStoredVideByStatus($status) {
        return $this->httpService->get($this->url . getenv(CONSTANT::MS_YT_DOWNLOADER_URI_STORED_VIDEOS_STATUS), [
            'status' => $status
        ]);
    }

}