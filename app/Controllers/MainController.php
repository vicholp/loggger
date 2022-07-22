<?php

namespace App\Controllers;

use App\Database\DB;
use App\Database\Migration;
use App\Services\UserService as User;
use Symfony\Component\HttpFoundation\Response;

class MainController extends Controller
{
    public function index(): Response
    {
        return $this->json(['message' => 'Hello World!']);
    }
}
