<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

class CreateTestCaseTest extends TestCase
{

    use DatabaseTransactions;
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function test_create_test_case()
    {
        //Having
        $this->visit('/test_cases')
             ->see('Test Case')
            ->type(2,'tests_number')
            ->press('Submit');

        //When
        $this->seeInDatabase('test_cases', [
            "tests_number" => 2
        ]);

        //Then
        $this->seeInElement('h3', 'Cube initialization');
    }

    public function test_create_test_case_form_validation()
    {

        $this->visit('/test_cases')
            ->see('Test Case')
            ->press('Submit');


        $this->seePageIs('/test_cases')
            ->seeInElement('.help-block', 'The tests number field is required.');
    }
}
