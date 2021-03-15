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

        try {
            return $this->transmissionService->getTopSecret();
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 404);
        }

    }

    public function get_split(){
        try {
            return $this->transmissionService->getTopSecret();
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 404);
        }
        
    }

    public function store_split(StoreSatelliteSplitRequest $request){

        $this->transmissionService->store_split($request->satellite);
        try {
            return $this->transmissionService->getTopSecret();
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 404);
        }
        
    }
}
