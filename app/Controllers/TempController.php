<?php

namespace App\Controllers;

use App\Database\DB;
use App\Database\Migration;
use App\Services\UserService as User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TempController extends Controller
{
    public function index(): Response
    {
        $temps = DB::select('SELECT * FROM log_temps');

        return $this->json($temps);
    }

    public function last(): Response
    {
        $l = DB::select('SELECT * FROM log_temps ORDER BY id DESC LIMIT 1;')[0];

        return $this->json($l);
    }

    public function store(Request $request): Response
    {
        $temp = $request->get('temp');

        DB::insert('INSERT INTO log_temps (temp) VALUES (?)', [$temp]);

        return $this->ok();
    }
}
