<?php

namespace App\Controllers;

use App\Database\DB;
use App\Database\Migration;
use App\Services\OpenApiService;
use App\Services\UserService as User;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response;

class MainController extends Controller
{
    public function index(): Response
    {
        return $this->json(['message' => 'Hello World!']);
    }

    public function docs(): Response
    {
        OpenApiService::generate();
        return $this->view('docs');
    }

    public function openapi(): Response
    {
        $response = new Response(OpenApiService::generate());
        $response->headers->set('Content-Type', 'text/plain');

        return $response;
    }
}
