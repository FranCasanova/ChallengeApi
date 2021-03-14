<?php

namespace App\Repositories\Transmissions;


interface TransmissionRepositoryInterface
{
    public function store($satellites);
    public function store_split($satellite);
    public function getLastTransmissions();
    public function getSatellites();
}