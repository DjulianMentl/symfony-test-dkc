<?php

namespace App\Service;

use Psr\Cache\InvalidArgumentException;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\Cache\ItemInterface;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class WeatherService
{
    private string $apiKey;
    private CacheService $cacheService;

    public function __construct(string $apiKey, CacheService $cacheService)
    {
        $this->apiKey = $apiKey;
        $this->cacheService = $cacheService;
    }

    /**
     * @throws InvalidArgumentException
     */
    public function getWeatherFromCache(string $city)
    {
        return $this->cacheService->get('weather_' . $city, function (ItemInterface $item) use ($city) {
            $item->expiresAfter(CacheService::CACHE_EXPIRATION_TIME);

            return $this->getWeatherByCity($city);
        });
    }

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function getWeatherByCity(string $city): array
    {
        $apiUrl = "https://api.openweathermap.org/data/2.5/weather?q=$city,RU&appid=$this->apiKey&lang=ru&units=metric";

        $client = HttpClient::create();
        $response = $client->request('GET', $apiUrl);

        $statusCode = $response->getStatusCode();
        if ($statusCode === 200) {
            $content = $response->getContent();
            $data = json_decode($content, true);


            return [
                'temperature' => $data['main']['temp'],
                'description' => $data['weather'][0]['description'],
            ];
        }

        return [];
    }
}