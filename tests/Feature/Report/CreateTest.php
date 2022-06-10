<?php

namespace Tests\Feature\Report;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_report_screen_can_be_rendered()
    {
        $response = $this->get('/report');

        $response->assertStatus(200);
    }

    public function test_new_reports_can_create()
    {
        $response = $this->post('/report', [
            'ref' => '22950372',
            'date_on' => '21-04-2021',
            'number' => '2418471552',
            'reported_by' => 'Yohemi caseres',
            'movil' => '4244353935',
            'type' => 'mix',
            'status' => true,
        ]);

        $response->assertSessionHasErrors();
    }
}
