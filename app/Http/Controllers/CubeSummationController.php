<?php

namespace App\Http\Controllers;

use App\Http\Requests\Cube\CreateRequest;
use App\Models\Cube;
use Illuminate\Http\Request;

class CubeSummationController extends Controller
{
    protected $testcases;

    protected $prefixView = 'app.cubes.';

    public function index()
    {
        return view($this->prefixView.'index');
    }


    public function initTestCases(Request $request)
    {
        $this->validate($request, [
            'testcases' => 'required|integer|between:1,50'
        ]);
        $this->testcases = $request['testcases'];
        return view($this->prefixView.'index')->with(['testcases' => $this->testcases]);
    }

    public function createCube(CreateRequest $request)
    {

        dd($request->all());
    }
}
