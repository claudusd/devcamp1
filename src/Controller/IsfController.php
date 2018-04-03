<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;

use App\Db;

class IsfController
{
    public function years(): JsonResponse
    {
        return new JsonResponse((new Db)->getYears());
    }

    public function cities(int $year): JsonResponse
    {
        return new JsonResponse((new Db)->getCities($year));
    }
}
