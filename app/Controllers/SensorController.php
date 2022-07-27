<?php

namespace App\Controllers;

use App\Database\DB;
use App\Database\Migration;
use App\Services\UserService as User;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @OA\Schema(
 *      type="object",
 *      schema="sensor",
 *      @OA\Property(
 *          property="name",
 *          type="string",
 *          description="Sensor name"
 *      ),
 *      @OA\Property(
 *          property="description",
 *          type="string",
 *          description="Sensor description"
 *      ),
 *      @OA\Property(
 *          property="type",
 *          type="string",
 *          description="Sensor type",
 *          required={"true"},
 *          example="length"
 *      ),
 *      @OA\Property(
 *          property="unit",
 *          type="string",
 *          description="Sensor unit",
 *          required={"true"},
 *          example="m"
 *      ),
 * )
 */
class SensorController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/sensor",
     *     tags={"sensor"},
     *     summary="Get all sensors",
     *     @OA\Response(response="200", description="All sensors")
     * )
     */
    public function index(Request $request): Response
    {
        $sensors = DB::select('SELECT * FROM sensors');

        return $this->json($sensors);
    }

    /**
     *  @OA\Post(
     *      path="/api/sensor",
     *      tags={"sensor"},
     *      summary="Store sensor",
     *      @OA\RequestBody(
     *          description="JSON object for sensor",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(ref="#/components/schemas/sensor"),
     *
     *          )
     *      ),
     *      @OA\Response(response="200", description="OK")
     *  )
     */
    public function store(Request $request): Response
    {
        $data = $request->toArray();

        $name = $data['name'];
        $description = $data['description'];
        $unit = $data['unit'];
        $type = $data['type'];

        DB::insert('INSERT INTO sensors (name, description, unit, type) VALUES (?, ?, ?, ?)', [
            $name,
            $description,
            $unit,
            $type
        ]);

        return $this->ok();
    }

    /**
     *  @OA\Get(
     *      path="/api/sensor/{sensorId}",
     *      tags={"sensor"},
     *      summary="Get sensor",
     *      @OA\Parameter(
     *          name="sensorId",
     *          in="path",
     *          required=true,
     *          description="Sensor ID",
     *          @OA\Schema(type="integer")),
     *      @OA\Response(response="200", description="Sensor")
     *  )
     */
    public function show(Request $request, int $sensorId): Response
    {
        $sensor = DB::select('SELECT * FROM sensors WHERE id = ?', [$sensorId])[0];

        return $this->json($sensor);
    }
}
