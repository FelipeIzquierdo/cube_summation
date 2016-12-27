<?php

namespace App\Http\Controllers;

use App\Http\Requests\Cube\CreateRequest;
use App\Http\Requests\Cube\QueriesRequest;
use App\Models\Cube;
use App\Models\CubeQuery;
use App\Models\TestCase;
use App\Services\CubeSummationService;
use Illuminate\Http\Request;
use Validator;

class CubeSummationController extends Controller
{

    protected $prefixView = 'app.cubes.';

    protected $service;

    /**
     * CubeSummationController constructor.
     * @param $service
     */
    public function __construct(CubeSummationService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return view($this->prefixView.'index');
    }

    public function showTest(TestCase $test_case)
    {
        return view($this->prefixView.'index')->with([
            'test_case' => $test_case
        ]);
    }

    public function createTestCase(Request $request, TestCase $testCase)
    {
        $this->validate($request, [
            'tests_number' => 'required|integer|between:1,50'
        ]);
        $testCase->saveTest($request->all());
        return redirect()->route('test_cases.show', $testCase->id);
    }

    public function createCube(CreateRequest $request, TestCase $test_case)
    {
        $this->service->saveCubes($request->get('cube'), $test_case);
        return redirect()->route('test_cases.show', $test_case->id);
    }

    public function queriesCubes(QueriesRequest $request, TestCase $test_case)
    {
        $validator =  Validator::make($request->all(), [ ]);
        $errorsCubes = $this->service->validateCubeQueries($test_case, $request->get('cube'), $validator);
        if ($errorsCubes){
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
        $this->service->saveQueries($request->get('cube'));
        dd($request->all());
    }
}
