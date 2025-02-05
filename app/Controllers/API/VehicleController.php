<?php

namespace App\Controllers\API;

use Domain\Vehicles\DTOs\Vehicle;
use Domain\Vehicles\Services\VehiclesPositionsService;

class VehicleController
{
    public function index(): void
    {
        try {
            $service = new VehiclesPositionsService();

            $vehicles = $service->getLastVehiclesPositions();

            $vehicles =  array_map(function (Vehicle $item): array {
                return $item->toArray();
            }, $vehicles);
        } catch (\Exception $e) {
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode(['error' => $e->getMessage()]);
            exit;
        }

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($vehicles);
        exit;
    }
}
