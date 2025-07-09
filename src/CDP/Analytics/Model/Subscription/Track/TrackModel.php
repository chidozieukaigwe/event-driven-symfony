<?php

namespace App\CDP\Analytics\Model\Subscription\Track;

use App\CDP\Analytics\Model\ModelInterface;
use Symfony\Component\Validator\Constraints as Assert;

class TrackModel implements ModelInterface
{

    #[Assert\NotBlank]
    private string $event;

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
    private bool $requiresConsent;

    private ?string $currency;

    private ?bool $inTrial;

    #[Assert\NotBlank]
    private string $productName;

    #[Assert\NotBlank]
    #[Assert\Regex(
        pattern: '/^\d{4}-\d{2}-\d{2}$/',
        message: 'The renewal date must be in the format "yyyy-mm-dd"'
    )]
    private string $renewalDate; // yyyy-mm-dd

    #[Assert\NotBlank]
    #[Assert\Regex(
        pattern: '/^\d{4}-\d{2}-\d{2}$/',
        message: 'The start date must be in the format "yyyy-mm-dd"'
    )]
    private string $startDate; // yyyy-mm-dd

    #[Assert\NotBlank]
    private string $status;

    #[Assert\NotBlank]
    private string $newsletter;

    #[Assert\NotBlank]
    private bool $isPromotion = false;

    #[Assert\NotBlank]
    private string $id;

    #[Assert\NotBlank]
    private string $platform;

    #[Assert\NotBlank]
    private string $type = 'newsletter';


    public function getEvent(): string
    {
        return $this->event;
    }

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

    public function getRequiresConsent(): bool
    {
        return $this->requiresConsent;
    }

    public function getProductName(): string
    {
        return $this->productName;
    }

    public function getRenewalDate(): string
    {
        return $this->renewalDate;
    }

    public function getStartDate(): string
    {
        return $this->startDate;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getNewsletter(): string
    {
        return $this->newsletter;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setEvent(string $event): void
    {
        $this->event = $event;
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

    public function setRequiresConsent(bool $requiresConsent): void
    {
        $this->requiresConsent = $requiresConsent;
    }

    public function setProductName(string $productName): void
    {
        $this->productName = $productName;
    }

    public function setRenewalDate(string $renewalDate): void
    {
        $this->renewalDate = $renewalDate;
    }

    public function setStartDate(string $startDate): void
    {
        $this->startDate = $startDate;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    public function setNewsletter(string $newsletter): void
    {
        $this->newsletter = $newsletter;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function setPlatform(string $platform): void
    {
        $this->platform = $platform;
    }

    public function getPlatform(): string
    {
        return $this->platform;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }


    public function toArray(): array
    {
        return  [
            'type' => self::TRACK_TYPE,
            'event' => $this->event, // event
            'context' => [
                'product' => $this->product, // newsletter.product_id
                'event_date' => $this->eventDate, // timestamp
                'traits' => [
                    'subscription_id' => $this->subscriptionId, // id
                    'email' => $this->email, // user.email
                ],
            ],
            'properties' => [
                'requires_consent' => $this->requiresConsent, // from user.region
                'platform' => $this->platform, // origin
                'currency' => $this->currency, // should be removed
                'in_trial' => $this->inTrial, // should be removed
                'product_name' => $this->productName, // newsletter.newsletter_id
                'renewal_date' => $this->renewalDate, // start date + 1 year if not provided
                'start_date' => $this->startDate, // timestamp
                'status' => $this->status, // set by api
                'type' => $this->type, // set by api
                'is_promotion' => $this->isPromotion, // use default
            ],
            'id' => $this->id // user.client_id
        ];
    }
}
