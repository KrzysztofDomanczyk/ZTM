<?php

namespace Domain\Vehicles\Interfaces;

use Domain\Vehicles\DTOs\Vehicle;

interface VehicleRepositoryInterface
{
    public function insert(Vehicle $vehicleDTO): void;
    public function getAll(): array;
}
