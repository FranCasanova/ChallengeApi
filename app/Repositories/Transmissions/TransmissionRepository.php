<?php

namespace App\Repositories\Transmissions;

use App\Models\Satellite;
use App\Models\Transmission;
use Illuminate\Support\Facades\DB;


class TransmissionRepository implements TransmissionRepositoryInterface
{
    public function store($satellites) {
        foreach ($satellites as $satellite ) {
            Transmission::create([
                'satellite_name' => $satellite['name'],
                'distance' => $satellite['distance'],
                'message' => $satellite['message']
            ]);
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

        return Transmission::where('satellite_name', 'kenobi')//pasar a constantes
                            ->orWhere('satellite_name', 'skywalker')
                            ->orWhere('satellite_name', 'sato')
                            ->take(3)->get()->unique('satellite_name')
                            ->sortByDesc('created_at');
        
    }

    public function getSatellites(){
        return Satellite::take(3)->get()->unique('name')->sortByDesc('created_at');
    }
}