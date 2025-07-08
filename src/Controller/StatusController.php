<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

/**
 * StatusController
 */
class StatusController extends AbstractController
{
    /**
     * Method healthcheck
     *
     * @return JsonResponse
     */
    #[Route('/healthcheck', name: 'healthcheck', methods: ['GET'])]
    public function healthcheck(): JsonResponse
    {
        return new JsonResponse(
            [
                'app' => true
            ]
        );
    }
}
