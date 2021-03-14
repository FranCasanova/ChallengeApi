<?php

namespace Tests\Feature;

use App\Models\Transmission;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TopSecretSplitTest extends TestCase
{
    use RefreshDatabase;

    public function testCorrectStructureAndStatus()
    {

        $t1 = Transmission::factory()->create();
        $t1->update(['satellite_name' => 'skywalker']);

        $t2 = Transmission::factory()->create();
        $t2->update(['satellite_name' => 'sato']);
        
        $response = $this->post('/api/topsecret_split/kenobi', [
            'distance' =>  100.0,
            'message' =>  ["este", "", "", "mensaje"]
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
