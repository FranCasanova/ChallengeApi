<?php

namespace Tests\Feature;

use App\Repositories\Transmissions\TransmissionRepository;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Services\Transmissions\TransmissionService;
use App\Services\Transmissions\TransmissionServiceInterface;

class MessageTest extends TestCase
{
    use RefreshDatabase;

    //Test de mensajes
    // mensaje simple
    // mensaje con desfazaje
    // Una cadena que no coincide(error)

    protected $transmissionService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->transmissionService = new TransmissionService(New TransmissionRepository);
    }

    public function testSimpleMessageWithNoDelay(){
        $messages = [
            ["este", "", "", "mensaje", ""],
            ["", "es", "", "", "secreto"],
            ["este", "", "un", "", ""]
        ];
        $message = $this->transmissionService->getMessage($messages);
        
        $this->assertEquals('este es un mensaje secreto', $message);
    }

    public function testMessageWithDelay(){
        $messages = [
            ['', '', 'es', '', 'mensaje'],
            ['este', '', 'un', 'mensaje'],
            ['', 'este', 'es', 'un', 'mensaje']
        ];
        $message = $this->transmissionService->getMessage($messages);
        
        $this->assertEquals('este es un mensaje', $message);
    }

    public function testFailingMessageWithDiferentLengths(){
        $messages = [
            ['', '', 'es', '', 'mensaje'],
            ['', '', 'este', '', 'un', 'otro', 'mensaje', 'distinto'],
            ['', 'este', 'es', 'un', 'mensaje']
        ];
        $response = $this->transmissionService->getMessage($messages);

        $this->assertIsString($response['error']);
        $this->assertEquals(404, $response['code']);
    }

}
