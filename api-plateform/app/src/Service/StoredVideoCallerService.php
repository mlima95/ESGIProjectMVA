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
        $this->url = getenv(CONSTANT::MS_YT_DOWNLOADER_BASE_URL) . getenv(CONSTANT::MS_YT_DOWNLOADER_URI_STORED_VIDEOS_STATUS);
    }

    /**
     * @throws TransportExceptionInterface
     * @throws JsonException
     */
    public function createStoredVideo(StoredVideo $stoVid){
        return $this->httpService->postOperation($this->url, $stoVid);
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
        return $this->httpService->get($this->url, [
            'status' => $status
        ]);
    }

}