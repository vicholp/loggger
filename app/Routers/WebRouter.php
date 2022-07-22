<?php

namespace App\Routers;

use App\Controllers\MainController;
use App\Controllers\TempController;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

class WebRouter extends BaseRouter
{
    public function routes(): RouteCollection
    {
        $this->get('/', 'index', MainController::class, 'index');
        $this->get('/temp', 'temps.index', TempController::class, 'index');
        $this->post('/temp', 'temps.store', TempController::class, 'store');
        $this->get('/temp/last', 'temps.last', TempController::class, 'last');

        return $this->routes;
    }
}
