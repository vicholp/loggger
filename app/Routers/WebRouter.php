<?php

namespace App\Routers;

use App\Controllers\MainController;
use App\Controllers\SensorController;
use App\Controllers\SensorMeasureController;
use App\Controllers\MeasureController;
use App\Controllers\TempController;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

class WebRouter extends BaseRouter
{
    public function routes(): RouteCollection
    {
        $this->get('/', 'index', MainController::class, 'index');

        $this->get('/api/sensor', 'sensor.index', SensorController::class, 'index');
        $this->post('/api/sensor', 'sensor.store', SensorController::class, 'store');
        $this->get('/api/sensor/{sensorId<\d>}', 'sensor.show', SensorController::class, 'show');

        $this->get('/api/measure', 'measure.index', MeasureController::class, 'index');
        $this->get('/api/measure/{measureId<\d>}', 'measure.show', MeasureController::class, 'show');
        $this->get('/api/sensor/{sensorId<\d>}/measure', 'sensor.measure.index', SensorMeasureController::class, 'index');
        $this->post('/api/sensor/{sensorId<\d>}/measure', 'sensor.measure.store', SensorMeasureController::class, 'store');
        $this->get('/api/sensor/{sensorId<\d>}/measure/last', 'sensor.measure.last', SensorMeasureController::class, 'last');

        $this->get('/docs', 'docs', MainController::class, 'docs');
        $this->get('/openapi', 'openapi', MainController::class, 'openapi');
        return $this->routes;
    }
}
