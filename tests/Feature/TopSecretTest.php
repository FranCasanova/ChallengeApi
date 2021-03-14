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
        $this->withoutExceptionHandling();
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
            'message'
        ]);
    }

    public function test302MissingDistances()
    {
        $response = $this->post('/api/topsecret', [
            "satellites" => [
                    [
                        'name' => "kenobi",
                        'message' =>  ["este", "", "", "mensaje", ""]
                    ],
                    [
                        'name' => "skywalker",
                        'message' =>  ["", "es", "", "", "secreto"]
                    ],
                    [
                        'name' => "sato",
                        'message' =>  ["este", "", "un", "", ""]
                    ]
                ]
        ]);

        $response->assertStatus(302);

    }

    public function test302InvalidNames()
    {
        $response = $this->post('/api/topsecret', [
            "satellites" => [
                    [
                        'name' => "Maul",
                        'distance' =>  100.0,
                        'message' =>  ["este", "", "", "mensaje", ""]
                    ],
                    [
                        'name' => "Sidious",
                        'distance' =>  115.5,
                        'message' =>  ["", "es", "", "", "secreto"]
                    ],
                    [
                        'name' => "ventress",
                        'distance' =>  142.7,
                        'message' =>  ["este", "", "un", "", ""]
                    ]
                ]
        ]);

        $response->assertStatus(302);

    }
}
