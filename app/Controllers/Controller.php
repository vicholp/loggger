<?php

namespace App\Controllers;

use App\Database\DB;
use App\Views\View;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class Controller
{
    protected static function json(array $data): JsonResponse
    {
        return new JsonResponse($data);
    }

    protected static function ok(): Response
    {
        return new Response('OK', 200);
    }
}
