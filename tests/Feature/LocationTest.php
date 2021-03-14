<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Services\Transmissions\TransmissionService;
use App\Repositories\Transmissions\TransmissionRepository;

class LocationTest extends TestCase
{
    
    protected $transmissionService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->transmissionService = new TransmissionService(New TransmissionRepository);
    }

    public function testSimpleMessageWithNoDelay(){
        $distances = [
            669.042,
            200.0,
            401.086
        ];
        $position = $this->transmissionService->getLocation($distances);
        
        $this->assertEqualsWithDelta(100, $position["x"], 3);
        $this->assertEqualsWithDelta(100, $position["y"], 3);
    }

    public function testAbortingWith404OnError(){
        //pasamos solo 2 distancias para que haya una exception
        $distances = [
            1, 
            1, 
        ];
        $response = $this->transmissionService->getLocation($distances);

        $this->assertIsString($this->parseResponse($response)->error);
        $this->assertEquals(404, $response->getStatusCode());
    }
}