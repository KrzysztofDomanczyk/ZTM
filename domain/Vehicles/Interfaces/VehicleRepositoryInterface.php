<?php

namespace Domain\Vehicles\Interfaces;

use Domain\Vehicles\DTOs\Vehicle;

interface VehicleRepositoryInterface
{
    public function getLastPositionOfVehicles(): array;
    public function getAll(): array;
    public function insert(Vehicle $vehicleDTO): void;
    public function truncate(): void;
    public function insertBulk(array $vehicles): void;
    public function removeOlderThanDate(string $date): void;
}
