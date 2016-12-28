<?php


use Illuminate\Foundation\Testing\DatabaseTransactions;

class InitCubeTest extends TestCase
{
    use DatabaseTransactions;


    public function test_init_cube()
    {
        $tests_case = factory(\App\Models\TestCase::class)->create([
            'tests_number' => 2
        ]);
        $this->visit(route('test_cases.show',$tests_case))
            ->see('Cube initialization');
    }
}
