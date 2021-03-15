<?php

namespace App\Repositories\Transmissions;

use App\Models\Satellite;
use App\Models\Transmission;


class TransmissionRepository implements TransmissionRepositoryInterface
{
    public function store($satellites) {
        foreach ($satellites as $satellite ) {
            $this->store_split($satellite);
        }
    }

    public function store_split($satellite) {        
            Transmission::create([
                'satellite_name' => $satellite['name'],
                'distance' => $satellite['distance'],
                'message' => $satellite['message']
            ]);
    }

    public function getLastTransmissions(){
        //Toma las ultimas transmisiones de cada satellite 
        return Transmission::orderBy('created_at', 'desc')->get()->unique('satellite_name')->take(3);
    }

    public function getSatellites(){
        return Satellite::orderBy('created_at', 'desc')->get()->unique('name')->take(3);
    }
}