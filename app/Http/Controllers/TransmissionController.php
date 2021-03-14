<?php

namespace App\Http\Controllers;

use App\Models\Transmission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSatellitesRequest;
use App\Http\Requests\StoreSatelliteSplitRequest;
use App\Services\Transmissions\TransmissionServiceInterface;

class TransmissionController extends Controller
{

    protected $transmissionService;

    public function __construct(TransmissionServiceInterface $transmissionService)
    {   
        $this->transmissionService = $transmissionService;
    }

    public function store(StoreSatellitesRequest $request){

        $this->transmissionService->store($request->satellites);

        $distressSignal = $this->transmissionService->getTopSecret();

        if(array_key_exists('code', $distressSignal['position']) && $distressSignal['position']['code'] == 404) 
        return response()->json(['error' => $distressSignal['position']['error']], 404);

        if(array_key_exists('code', $distressSignal['message']) && $distressSignal['message']['code'] == 404) 
        return response()->json(['error' => $$distressSignal['message']['error']], 404);

        return $distressSignal;
    }

    public function get_split(Request $request){

        $distressSignal = $this->transmissionService->getTopSecret();
        
        if(array_key_exists('code', $distressSignal['position']) && $distressSignal['position']['code'] == 404) 
        return response()->json(['error' => $distressSignal['position']['error']], 404);

        if(array_key_exists('code', $distressSignal['message']) && $distressSignal['message']['code'] == 404) 
        return response()->json(['error' => $$distressSignal['message']['error']], 404);

        return $distressSignal;
    }

    public function store_split(StoreSatelliteSplitRequest $request){

        $this->transmissionService->store_split($request->satellite);

        $distressSignal = $this->transmissionService->getTopSecret();
        
        if(array_key_exists('code', $distressSignal['position']) && $distressSignal['position']['code'] == 404) 
        return response()->json(['error' => $distressSignal['position']['error']], 404);

        if(array_key_exists('code', $distressSignal['message']) && $distressSignal['message']['code'] == 404) 
        return response()->json(['error' => $$distressSignal['message']['error']], 404);

        return $distressSignal;
    }
}
