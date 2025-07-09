<?php

namespace App\CDP\Analytics\Model\Subscription\Identify;

use App\CDP\Analytics\Model\ModelInterface;
use Symfony\Component\Validator\Constraints as Assert;

class IdentifyModel implements ModelInterface
{
    #[Assert\NotBlank]
    private string $product;

    #[Assert\NotBlank]
    #[Assert\Regex(
        pattern: '/^\d{4}-\d{2}-\d{2}$/',
        message: 'The event date must be in the format "yyyy-mm-dd"'
    )]
    private string $eventDate; // yyyy-mm-dd

    #[Assert\NotBlank]
    private string $subscriptionId;

    #[Assert\NotBlank]
    #[Assert\Email]
    private string $email;

    #[Assert\NotBlank]
    private string $id;

    public function getProduct(): string
    {
        return $this->product;
    }

    public function getEventDate(): string
    {
        return $this->eventDate;
    }

    public function getSubscriptionId(): string
    {
        return $this->subscriptionId;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getId(): string
    {
        return $this->id;
    }
    public function setProduct(string $product): void
    {
        $this->product = $product;
    }

    public function setEventDate(string $eventDate): void
    {
        $this->eventDate = $eventDate;
    }

    public function setSubscriptionId(string $subscriptionId): void
    {
        $this->subscriptionId = $subscriptionId;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function toArray(): array
    {
        return  [
            'type' => self::IDENTIFY_TYPE,
            'context' => [
                'product' => $this->product, // newsletter.product_id,
                'event_date' => $this->eventDate // timestamp
            ],
            'traits' => [
                'subscription_id' => $this->subscriptionId, // id,
                'email' => $this->email // user.email
            ],
            'id' => $this->id // user.client_id
        ];
    }
}
