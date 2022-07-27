<?php

namespace App\Controllers;

use App\Database\DB;
use App\Database\Migration;
use App\Services\UserService as User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SensorMeasureController extends Controller
{
    /**
     *  @OA\Get(
     *      path="/api/sensor/{sensorId}/measure",
     *      tags={"measures"},
     *      summary="Get all measures for sensor",
     *      @OA\Parameter(
     *          name="sensorId",
     *          in="path",
     *          required=true,
     *          description="Sensor ID",
     *          @OA\Schema(type="integer")),
     *      @OA\Response(response="200", description="Array of measures")
     *  )
     */
    public function index(Request $request, int $sensorId): Response
    {
        $measures = DB::select('SELECT * FROM measures WHERE sensor_id = ?', [$sensorId]);

        return $this->json($measures);
    }

    /**
     *  @OA\Get(
     *      path="/api/sensor/{sensorId}/measure/last",
     *      tags={"measures"},
     *      summary="Get last measure for sensor",
     *      @OA\Parameter(name="sensorId", in="path", required=true, description="Sensor ID", @OA\Schema(type="integer")),
     *      @OA\Response(response="200", ref="#/components/schemas/measure")
     *  )
     */
    public function last(Request $request, int $sensorId): Response
    {
        $measure = DB::select('SELECT * FROM measures WHERE sensor_id = ? ORDER BY id DESC LIMIT 1', [$sensorId])[0];

        return $this->json($measure);
    }

    /**
     *  @OA\Post(
     *      path="/api/sensor/{sensorId}/measure",
     *      tags={"measures"},
     *      summary="Store measure for sensor",
     *      @OA\Parameter(
     *          name="sensorId",
     *          in="path",
     *          required=true,
     *          description="Sensor ID",
     *          @OA\Schema(type="integer")),
     *      @OA\RequestBody(
     *          description="Input data format",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(
     *                  type="object",
     *                  @OA\Property(
     *                      property="data",
     *                      type="float",
     *                      description="Sensor name",
     *                      required={"true"}
     *                  )
     *              )
     *          )
     *      ),
     *      @OA\Response(response="200", description="OK")
     *  )
     */
    public function store(Request $request, int $sensorId): Response
    {
        $data = $request->toArray();

        $data = $data['data'];

        DB::insert('INSERT INTO measures (sensor_id, data) VALUES (?, ?)', [$sensorId, $data]);

        return $this->ok();
    }
}
