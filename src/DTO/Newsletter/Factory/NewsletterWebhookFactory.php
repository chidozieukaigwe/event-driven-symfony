<?php

declare(strict_types=1);

namespace App\DTO\Newsletter\Factory;

use App\DTO\Newsletter\NewsletterWebhook;
use App\DTO\Webhook;
use Symfony\Component\Serializer\SerializerInterface;
use Throwable;

class NewsletterWebhookFactory
{
    public function __construct(private SerializerInterface $serializer) {}

    public function create(Webhook $webhook): NewsletterWebhook
    {
        try {
            $newsletterWebhook = $this->serializer->deserialize(
                $webhook->getRawPayload(),
                NewsletterWebhook::class,
                'json'
            );

            return $newsletterWebhook;
        } catch (Throwable $throwable) {
            throw new \Exception('Failed to deserialize webhook payload', 0, $throwable); // Replace with your own exception class

            // throw WebhookException if deserialization fails
        }
    }
}
