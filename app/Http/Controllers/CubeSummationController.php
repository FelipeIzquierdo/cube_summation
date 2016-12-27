<?php

namespace App\Http\Controllers;

use App\Http\Requests\Cube\CreateRequest;
use App\Http\Requests\Cube\QueriesRequest;
use App\Models\Cube;
use App\Models\CubeQuery;
use App\Models\TestCase;
use Illuminate\Http\Request;

class CubeSummationController extends Controller
{
    protected $testcases;

    protected $prefixView = 'app.cubes.';

    public function index()
    {
        return view($this->prefixView.'index');
    }


    public function createTestCase(Request $request, TestCase $testCase)
    {
        $this->validate($request, [
            'tests_number' => 'required|integer|between:1,50'
        ]);
        $testCase->saveTest($request->all());
        return redirect()->route('test_cases.show', $testCase->id);
    }

    public function showTest(TestCase $test_case)
    {
        return view($this->prefixView.'index')->with([
            'test_case' => $test_case
        ]);
    }

    public function createCube(CreateRequest $request, TestCase $test_case)
    {
        $cubes = [];
        foreach ($request->get('cube') as $item){
            $cubes[] = new Cube($item);
        }
        $test_case->cubes()->saveMany($cubes);
        return redirect()->route('test_cases.show', $test_case->id);
    }

    public function queriesCubes(QueriesRequest $request, TestCase $test_case)
    {
        foreach ($request->get('cube') as $key => $cubes){
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
        dd($request->all());
    }
}
