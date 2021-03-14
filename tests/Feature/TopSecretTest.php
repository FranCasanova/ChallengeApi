<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TopSecretTest extends TestCase
{
    use RefreshDatabase;
    
    public function testCorrectStructureAndStatus()
    {
        $response = $this->post('/api/topsecret', [
            "satellites" => [
                    [
                        'name' => "kenobi",
                        'distance' =>  100.0,
                        'message' =>  ["este", "", "", "mensaje", ""]
                    ],
                    [
                        'name' => "skywalker",
                        'distance' =>  115.5,
                        'message' =>  ["", "es", "", "", "secreto"]
                    ],
                    [
                        'name' => "sato",
                        'distance' =>  142.7,
                        'message' =>  ["este", "", "un", "", ""]
                    ]
                ]
        ]);

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'position' => [
                'x',
                'y'
            ],
            'message' => []
        ]);
    }
}
