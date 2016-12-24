<?php

namespace App\Http\Controllers;

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
            'testcases' => 'required|numeric|min:1|max:50'
        ]);
        $this->testcases = $request['testcases'];

        for ($i = 0; $i < $this->testcases; $i++){
            $n = 4;
            $m = 4;

            $cube = new Cube($n);
            $cube->updateBlockValue(1,1,1,3);
            $cube->updateBlockValue(2,2,2,3);
            $cube->cubeQuery(1,1,1,2,2,2);
        }
        return view($this->prefixView.'index')->with(['testcases' => $this->testcases]);
    }
}
