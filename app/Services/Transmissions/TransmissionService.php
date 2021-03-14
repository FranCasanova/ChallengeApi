<?php

namespace App\Services\Transmissions;

use Throwable;
use App\Models\Transmission;
use App\Models\Trilateration;
use Illuminate\Support\Facades\DB;
use App\Repositories\Transmissions\TransmissionRepositoryInterface;


class TransmissionService implements TransmissionServiceInterface
{
    protected $transmissionRepository;

    public function __construct(TransmissionRepositoryInterface $transmissionRepository)
    {   
        $this->transmissionRepository = $transmissionRepository;
    }

    public function store($satellites) {
        $this->transmissionRepository->store($satellites);
    }

    public function store_split($satellite){
        $this->transmissionRepository->store_split($satellite);
    }

    public function getTopSecret(){
        $transmissions = $this->transmissionRepository->getLastTransmissions();
        
        return [
            'position' => $this->getLocation($transmissions->pluck('distance')),
            'message' => $this->getMessage($transmissions->pluck('message'))
        ];
    }

    public function getLocation($distances){
        try {
            $satellites = $this->transmissionRepository->getSatellites();

            $xa = $satellites[0]->position_x;
            $ya = $satellites[0]->position_y;
            $xb = $satellites[1]->position_x;
            $yb = $satellites[1]->position_y;
            $xc = $satellites[2]->position_x;
            $yc = $satellites[2]->position_y;

            $ra = $distances[0];
            $rb = $distances[1];
            $rc = $distances[2];

            $S = (pow($xc, 2.) - pow($xb, 2.) + pow($yc, 2.) - pow($yb, 2.) + pow($rb, 2.) - pow($rc, 2.)) / 2.0;
            $T = (pow($xa, 2.) - pow($xb, 2.) + pow($ya, 2.) - pow($yb, 2.) + pow($rb, 2.) - pow($ra, 2.)) / 2.0;
            $y = (($T * ($xb - $xc)) - ($S * ($xb - $xa))) / ((($ya - $yb) * ($xb - $xc)) - (($yc - $yb) * ($xb - $xa)));
            $x = (($y * ($ya - $yb)) - $T) / ($xb - $xa);

            return [
                'x' => $x,
                'y' => $y
            ];
        }catch (Throwable $e) {
            return response()->json(['error' => 'No se pudo determinar la posición'], 404);
            // /return "No se pudo determinar la posición";
        }
    }

    public function getMessage($messages){
        // La idea general de esta function es ver si algun mensaje llegó con delay 
        //
        $messageLength = 0;
        $messageDecoded = [];

        foreach ($messages as $message) {
            if (count($message) > $messageLength) $messageLength = count($message);
        }
        try {
            $delay = $this->getMessagesDelay($messages, $messageLength);


            for ($i=0; $i < $messageLength; $i++) { 

                if ($i < count($messages[0]) && $i+$delay[0] < $messageLength &&
                    $messages[0][$i+$delay[0]] != null && 
                    $messages[0][$i+$delay[0]] != end($messageDecoded)) {

                    array_push($messageDecoded, $messages[0][$i+$delay[0]]);

                }elseif ($i < count($messages[1]) && $i+$delay[1] < $messageLength &&
                        $messages[1][$i+$delay[1]] != null && 
                        $messages[1][$i+$delay[1]] != end($messageDecoded)) {
                    
                    array_push($messageDecoded, $messages[1][$i+$delay[1]]);

                }elseif ($i < count($messages[2]) && $i+$delay[2] < $messageLength &&
                        $messages[2][$i+$delay[2]] != null && 
                        $messages[2][$i+$delay[2]] != end($messageDecoded)){

                    array_push($messageDecoded, $messages[2][$i+$delay[2]]);

                }
            }
        }catch (Throwable $e) {
            return response()->json(['error' => 'No se pudo determinar el mensaje'], 404);
        }
        return ($messageDecoded);
    }

    public function getMessagesDelay($messages, $messageLength){
        for ($i=1; $i < $messageLength; $i++) { 
            $delay = [0, 0, 0];

            if ($i < count($messages[0]) && $messages[0][$i] != '' &&
                ($messages[0][$i] ==  $messages[1][$i-1] ||
                $messages[0][$i] ==  $messages[2][$i-1])) $delay[0] = +1;

            if ($i < count($messages[1]) && $messages[1][$i] != '' &&
                ($messages[1][$i] ==  $messages[0][$i-1] ||
                $messages[1][$i] ==  $messages[2][$i-1])) $delay[1] = +1;

            if ($i < count($messages[2]) && $messages[2][$i] != '' &&
                ($messages[2][$i] ==  $messages[0][$i-1] ||
                $messages[2][$i] ==  $messages[1][$i-1])) $delay[2] = +1;
        }
        return $delay;
    }
    
}