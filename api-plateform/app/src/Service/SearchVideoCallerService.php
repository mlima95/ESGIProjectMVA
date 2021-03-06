<?php

namespace App\Service;

use App\Entity\SearchTheme;
use App\Shared\Utils\CONSTANT;
use JsonException;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class SearchVideoCallerService {

    private HTTPService $httpService;

    private string $url;

    public function __construct(HTTPService $httpService)
    {
        $this->httpService = $httpService;
        $this->url = getenv(CONSTANT::MS_YT_SEARCH_BASE_URL);
    }

    /**
     * @param []
     * @return mixed
     * @throws JsonException
     * @throws TransportExceptionInterface
     */
    public function createSearchVideo(array $searchTheme): mixed
    {
        //dd($searchTheme);
        return $this->httpService->postOperation($this->url . getenv(CONSTANT::MS_YT_SEARCH_URI_STORED_THEME), $searchTheme);
    }

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws ClientExceptionInterface
     * @throws JsonException
     */
    public function getSearchVideoBykeyword($keyword) {
        return $this->httpService->get($this->url . getenv(CONSTANT::MS_YT_SEARCH_URI_FIND_THEME), [
            'keyword' => $keyword
        ]);
    }

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws ClientExceptionInterface
     * @throws JsonException
     */
    public function getKeywords() {
//        dd($this->url . getenv(CONSTANT::MS_YT_SEARCH_URI_FIND_THEME));
        return $this->httpService->get($this->url . getenv(CONSTANT::MS_YT_SEARCH_URI_KEYWORDS));
    }

}