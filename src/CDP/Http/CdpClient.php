<?php

declare(strict_types=1);

namespace App\CDP\Http;

use App\CDP\Analytics\Model\ModelInterface;
use App\Error\Exception\WebhookException;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class CdpClient
{
    private const string CDP_API_URL = 'https://api.cdp.com/v1';

    public function __construct(
        private HttpClientInterface $httpClient,
        #[Autowire(param: 'cdp.api_key')] private string $apiKey
    ) {}

    /**
     * Method track
     *
     * @param ModelInterface $model
     *
     * @return void
     */
    public function track(ModelInterface $model): void
    {
        $response = $this->httpClient->request(
            'POST',
            self::CDP_API_URL . '/track',
            [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->apiKey,
                    'Content-Type' => 'application/json',
                ],
                'body' => json_encode($model->toArray(), JSON_THROW_ON_ERROR),
            ]
        );
        // Add error handling
        try {
            $response->toArray();
        } catch (\Throwable $exception) {
            throw new WebhookException(
                message: $response->getContent(false),
                previous: $exception
            );
        }
    }

    public function identify(ModelInterface $model): void
    {
        $response = $this->httpClient->request(
            'POST',
            self::CDP_API_URL . '/identify',
            [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->apiKey,
                    'Content-Type' => 'application/json',
                ],
                'body' => json_encode($model->toArray(), JSON_THROW_ON_ERROR),
            ]
        );

        // Add error handling
        try {
            $response->toArray();
        } catch (\Throwable $exception) {
            throw new WebhookException(
                message: $response->getContent(false),
                previous: $exception
            );
        }
    }
}
