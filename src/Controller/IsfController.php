<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;

class IsfController
{
    public function years(): JsonResponse
    {
        return new JsonResponse([2018]);
    }

    public function cities(int $year): JsonResponse
    {
        return new JsonResponse([2018]);
    }
}
