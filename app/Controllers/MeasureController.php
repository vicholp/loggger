<?php

namespace App\Controllers;

use App\Database\DB;
use App\Database\Migration;
use App\Services\UserService as User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @OA\Schema(
 *      type="object",
 *      schema="measure",
 *      @OA\Property(
 *          property="data",
 *          type="float",
 *          description="measure value"
 *      ),
 *      @OA\Property(
 *          property="sensor_id",
 *          type="object",
 *          ref="#/components/schemas/sensor"
 *      ),
 * )
 */
class MeasureController extends Controller
{
    /**
     *  @OA\Get(
     *      path="/api/measure",
     *      tags={"measures"},
     *      summary="Get all measures",
     *      @OA\Response(response="200", description="Array of measures")
     *  )
     */
    public function index(Request $request): Response
    {
        $measures = DB::select('SELECT * FROM measures');

        return $this->json($measures);
    }

    /**
     *  @OA\Get(
     *      path="/api/measure/{measureId}",
     *      tags={"measures"},
     *      summary="Get measure by id",
     *      @OA\Parameter(
     *          name="measureId",
     *          in="path",
     *          required=true,
     *          description="Measure ID",
     *          @OA\Schema(type="integer")),
     *      @OA\Response(response="200", description="Measure")
     *  )
     */
    public function show(Request $request, int $measureId): Response
    {
        $measure = DB::select('SELECT * FROM measures WHERE id = ?', [$measureId])[0];

        return $this->json($measure);
    }
}
