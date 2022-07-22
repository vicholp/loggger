<?php

namespace App\Routers;

use App\Controllers\MainController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGenerator;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

class Router
{
    private RouteCollection $routes;

    public function __construct()
    {
        $this->routes = new RouteCollection();

        $this->register();
    }

    private function register(): void
    {
        $this->routes->addCollection((new WebRouter())->routes());
    }

    public function route(): Response
    {
        $request = Request::createFromGlobals();

        $context = new RequestContext();
        $context->fromRequest($request);

        $matcher = new UrlMatcher($this->routes, $context);
        $parameters = $matcher->match($request->getPathInfo());

        return (new $parameters['_controller']())->{$parameters['_action']}($request);
    }
}
