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
        return $this->transmissionService->getTopSecret();
    }

    public function store_split(StoreSatelliteSplitRequest $request, $satellite_name){
        $this->transmissionService->store_split($request->satellite);
        return $this->transmissionService->getTopSecret();
    }
}
