<?php

namespace App\Controllers\API;

use Domain\Vehicles\DTOs\Vehicle;
use Domain\Vehicles\Services\VehiclesPositionsService;

class VehicleController
{
    public function index(): void
    {
        $service = new VehiclesPositionsService();

        $vehicles = $service->refreshData()->getLastVehiclesPositions();

        $vehicles =  array_map(function (Vehicle $item): array {
            return $item->toArray();
        }, $vehicles);

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($vehicles);
        exit;
    }
}
