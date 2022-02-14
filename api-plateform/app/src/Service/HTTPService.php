<?php

namespace App\Service;

use JsonException;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class HTTPService
{


    private HttpClientInterface $httpClient;

    //https://symfony.com/doc/current/http_client.html
    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws ClientExceptionInterface
     * @throws JsonException
     */
    public function get(string $url, mixed $data = null)
    {

        $urlParamed = $url;
        if (!is_null($data)) {
            $urlParamed = $this->paramURL($url, $data);
        }


        $response = $this->httpClient->request('GET', $urlParamed, [
            'headers' => [
                'Accept' => 'application/json'
            ]
        ]);

        $responseJson = $response->getContent();
        return json_decode($responseJson, true, 512, JSON_THROW_ON_ERROR);
    }


    /**
     * @throws JsonException
     * @throws TransportExceptionInterface
     */
    public function postOperation(string $url, mixed $data)
    {
        $requestJson = json_encode($data, JSON_THROW_ON_ERROR);
        $response = $this->httpClient->request('POST', $url, [
            'headers' => [
                'Content-Type: application/json',
                'Accept: application/json',
            ],
            'body' => $requestJson,
        ]);

        if (201 !== $response->getStatusCode()) {
            throw new Exception('Error');
        }


        $responseJson = $response->getContent();

        return json_decode($responseJson, true, 512, JSON_THROW_ON_ERROR);
    }

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
     * @throws JsonException
     */
    public function patchItem(string $url, string $id, mixed $data)
    {

        $requestJson = json_encode($data, JSON_THROW_ON_ERROR);

        $response = $this->httpClient->request('PATCH', $url . '/' . $id, [
            'headers' => [
                'Content-Type: application/json',
                'Accept: application/json',
            ],
            'body' => $requestJson,
        ]);

        if (204 !== $response->getStatusCode()) {
            throw new Exception('Error');
        }

        $responseJson = json_encode(['status' => $response->getStatusCode()]);

        return json_decode($responseJson, true, 512, JSON_THROW_ON_ERROR);

    }

    private function paramURL(string $url, mixed $data): string
    {
        $urlParamed = $url . '?';
        foreach ($data as $key => $value) {
            $urlParamed .= $key . '=' . $value . '&';
        }
        return $urlParamed;
    }


}