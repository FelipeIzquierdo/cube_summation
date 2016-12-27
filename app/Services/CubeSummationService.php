<?php

namespace App\Services;
use App\Models\Cube;
use App\Models\CubeQuery;
use App\Models\TestCase;

/**
 * Created by PhpStorm.
 * User: Felipe Iz
 * Date: 27/12/2016
 * Time: 9:06 AM
 */
class CubeSummationService
{
    /**
     * @param $dataCubes
     * @param TestCase $test_case
     */
    public function saveCubes($dataCubes, TestCase $test_case)
    {
        $cubes = [];
        foreach ($dataCubes as $item){
            $cubes[] = new Cube($item);
        }
        $test_case->cubes()->saveMany($cubes);
    }

    /**
     * @param $dataCubes
     */
    public function saveQueries($dataCubes)
    {
        foreach ($dataCubes as $key => $cubes){
            $cubeQuery = [];
            $cube =  Cube::find($key);
            $cube->initCoordinates();
            foreach ($cubes as $item){
                if ($item['type'] == 'QUERY'){
                    list($x1, $y1, $z1, $x2, $y2, $z2) = explode(" ", $item['values']);
                    $result = $cube->cubeQuery($x1, $y1, $z1, $x2, $y2, $z2);
                    $cubeQuery[] = new CubeQuery([
                        'type'  => $item['type'],
                        'x1'    => $x1,
                        'y1'    => $y1,
                        'z1'    => $z1,
                        'x2'    => $x2,
                        'y2'    => $y2,
                        'z2'    => $z2,
                        'result' => $result
                    ]);
                } else {
                    list($x, $y, $z, $w) = explode(" ", $item['values']);
                    $cube->updateBlockValue($x, $y, $z, $w);
                    $cubeQuery[] = new CubeQuery([
                        'type'  => $item['type'],
                        'x1'    => $x,
                        'y1'    => $y,
                        'z1'    => $z,
                        'w'     => $w
                    ]);
                }
            }
            $cube->cubeQueries()->saveMany($cubeQuery);
        }

    }

}