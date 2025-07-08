<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

/**
 * WebhooksController
 */
class WebhooksController extends AbstractController
{
    /**
     * Method healthcheck
     *
     * @return Response
     */
    #[Route(path: '/webhook', name: 'webhook', methods: ['POST'])]
    public function __invoke(): Response
    {
        return new Response(status: Response::HTTP_NO_CONTENT);
    }
}
