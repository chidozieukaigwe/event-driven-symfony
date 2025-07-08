<?php

namespace App\Forwarder\Newsletter\Identify;

use App\DTO\Newsletter\NewsletterWebhook;
use App\Forwarder\Newsletter\ForwarderInterface;

class SubscriptionStartForwarder implements ForwarderInterface
{
    private const string SUPPORTED_EVENT = 'newsletter_subscribed';

    public function supports(NewsletterWebhook $newsletterWebhook): bool
    {
        return $newsletterWebhook->getEvent() === self::SUPPORTED_EVENT;
    }

    public function forward(NewsletterWebhook $newsletterWebhook): void
    {
        // Identify the user and send a welcome email
        $user = $newsletterWebhook->getUser();
        $newsletter = $newsletterWebhook->getNewsletter();

        // Implement the email sending logic here
    }
}
