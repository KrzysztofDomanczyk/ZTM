<?php

namespace Domain\Vehicles\Interfaces;

use Domain\Vehicles\DTOs\VehicleDTO;

interface VehicleRepositoryInterface
{
    public function insert(VehicleDTO $vehicleDTO): void;
    public function getAll(): array;
}
