<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Services\Transmissions\TransmissionService;
use App\Repositories\Transmissions\TransmissionRepository;
use App\Services\Transmissions\TransmissionServiceInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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

        $this->expectException(NotFoundHttpException::class);
        
        $messages = [
            ['', '', 'es', '', 'mensaje'],
            ['', '', 'este', '', 'un', 'otro', 'mensaje', 'distinto'],
            ['', 'este', 'es', 'un', 'mensaje']
        ];
        $response = $this->transmissionService->getMessage($messages);

    }

    public function testHardMessageWithDelay(){
        $full_message = 'Los droides separatistas espias han detectado que el general Obi-Wan Kenobi se encuentra en la nave del canciller Palpatine';

        $messages = [
            ['', 'droides', '', 'espias', 'han', '', '', '', 'general', '', 'Kenobi', 'se', '', '', 'la', 'nave', 'del', '', ''],
            ['Los', 'droides', '', '', '', 'detectado', 'que', 'el', '', 'Obi-Wan', 'Kenobi', 'se', 'encuentra', 'en', '', '', '', 'canciller', 'Palpatine'],
            ['', 'Los', 'droides', 'separatistas', 'espias', '', '', 'que', 'el', '', '', 'Kenobi', '', '', 'en', 'la', '', 'del', 'canciller', '', '']
        ];
        $message = $this->transmissionService->getMessage($messages);
        
        $this->assertEquals($full_message, $message);
    }

}
