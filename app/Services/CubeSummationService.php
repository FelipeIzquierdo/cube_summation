<?php

namespace App\Services;
use App\Models\Cube;
use App\Models\CubeQuery;
use App\Models\TestCase;
use Validator;

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

    public function validateCubeQueries(TestCase $testCase, $dataCubes, $validator)
    {
        $errors = false;
        foreach ($dataCubes as $key => $cubes){
            $cube =  Cube::find($key);
            foreach ($cubes as $key2 => $item){
                if ($item['type'] == 'QUERY'){
                    if(count(explode(" ", $item['values'])) == '6'){
                        list($x1, $y1, $z1, $x2, $y2, $z2) = explode(" ", $item['values']);

                        if($x1 < 1 || $x1 > $x2 || $x2 > $cube->last_coordinate ){
                            $errors = true;
                            $validator->getMessageBag()->add('cube.'.$key.'.'.$key2.'.values', 'The values ​​must comply with the following condition 1 <= x1 <= x2 <= N');
                        }
                        if($y1 < 1 || $y1 > $y2 || $y2 > $cube->last_coordinate ){
                            $errors = true;
                            $validator->getMessageBag()->add('cube.'.$key.'.'.$key2.'.values', 'The values ​​must comply with the following condition 1 <= y1 <= y2 <= N');
                        }
                        if($z1 < 1 || $z1 > $z2 || $z2 > $cube->last_coordinate ){
                            $errors = true;
                            $validator->getMessageBag()->add('cube.'.$key.'.'.$key2.'.values', 'The values ​​must comply with the following condition 1 <= y1 <= y2 <= N');
                        }

                    } else {
                        $errors = true;
                        $validator->getMessageBag()->add('cube.'.$key.'.'.$key2.'.values', 'The format required is x1 y1 z1 x2 y2 z2');
                    }

                } else {
                    if(count(explode(" ", $item['values'])) == '4'){
                        list($x, $y, $z, $w) = explode(" ", $item['values']);
                        if($x < 1 || $x >  $cube->last_coordinate ){
                            $errors = true;
                            $validator->getMessageBag()->add('cube.'.$key.'.'.$key2.'.values', 'The values ​​must comply with the following condition  1 <= x <= N');
                        }
                        if($y < 1 || $y >  $cube->last_coordinate ){
                            $errors = true;
                            $validator->getMessageBag()->add('cube.'.$key.'.'.$key2.'.values', 'The values ​​must comply with the following condition  1 <= y <= N');
                        }
                        if($z < 1 || $z >  $cube->last_coordinate ){
                            $errors = true;
                            $validator->getMessageBag()->add('cube.'.$key.'.'.$key2.'.values', 'The values ​​must comply with the following condition  1 <= z <= N');
                        }
                        if($w < -1000000000 || $w >  1000000000 ){
                            $errors = true;
                            $validator->getMessageBag()->add('cube.'.$key.'.'.$key2.'.values', 'The values ​​must comply with the following condition  -10^9 <= W <= 10^9');
                        }

                    } else {
                        $errors = true;
                        $validator->getMessageBag()->add('cube.'.$key.'.'.$key2.'.values', 'The format required is  x y z w');
                    }
                }
            }
        }
        return $errors;
    }

}