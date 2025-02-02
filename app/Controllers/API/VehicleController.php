<?php

namespace App\Controllers\API;

use Domain\Vehicles\DTOs\VehicleDTO;
use Domain\Vehicles\Services\VehicleService;

class VehicleController
{
    public function index(): void
    {
        $service = new VehicleService();

        $vehicles = $service->refreshData()->getLastVehiclesPositions();

        $vehicles =  array_map(function (VehicleDTO $item): array {
            return $item->toArray();
        }, $vehicles);

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($vehicles);
        exit;
    }
}
