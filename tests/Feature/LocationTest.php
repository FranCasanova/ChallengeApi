<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Services\Transmissions\TransmissionService;
use App\Repositories\Transmissions\TransmissionRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class LocationTest extends TestCase
{
    use RefreshDatabase;
    protected $transmissionService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->transmissionService = new TransmissionService(New TransmissionRepository);
    }

    public function testSimpleMessageWithNoDelay(){
        $distances = [
            669.04,
            200.0,
            401.08
        ];
        $position = $this->transmissionService->getLocation($distances);
        
        $this->assertEqualsWithDelta(100, $position["x"], 3);
        $this->assertEqualsWithDelta(100, $position["y"], 3);
    }

    public function testAbortingWith404OnError(){
        
        $this->expectException(NotFoundHttpException::class);

        //pasamos solo 2 distancias para que haya una exception
        $distances = [
            1, 
            1, 
        ];

        $response = $this->transmissionService->getLocation($distances);
    }
}
