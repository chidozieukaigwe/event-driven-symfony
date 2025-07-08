<?php

declare(strict_types=1);

namespace App\Webhook\Handler;

use App\DTO\Webhook;
use Symfony\Component\DependencyInjection\Attribute\AutowireIterator;

class HandlerDelegator
{
    // Autowires an iterator of services based on a tag name

    /**
     * @param iterable<WebhookHandlerInterface> $handlers
     */
    public function __construct(
        #[AutowireIterator('webhook.handler')] private iterable $handlers
    ) {
    }

    public function delegate(Webhook $webhook): void
    {
        // Loop over handlers
        foreach ($this->handlers as $handler) {
            // Ask if supported (i.e call supports())
            if ($handler->supports($webhook)) {
                // if supported, call handle()
                $handler->handle($webhook);
            }
        }
    }
}
