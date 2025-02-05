<?php

namespace Infrastructure\Repositories;

use Domain\Vehicles\DTOs\Vehicle;
use Domain\Vehicles\Interfaces\VehicleRepositoryInterface;
use Infrastructure\Database;

class PostgresVehicleRepository implements VehicleRepositoryInterface
{
    protected Database $database;
    public function __construct()
    {
        $this->database =  Database::getInstance();
    }

    /**
     * @return array<Vehicle>
     */
    public function getLastPositionOfVehicles(): array
    {
        $query = 'SELECT DISTINCT ON (vehicle_id) * FROM vehicles WHERE created_at >= NOW() - INTERVAL \'1 minutes\' ORDER BY vehicle_id, created_at DESC';
        $statement = $this->database->getPDO()->prepare($query);
        $statement->execute();
        $array = $statement->fetchAll(\PDO::FETCH_ASSOC);

        return array_map(function ($item): \Domain\Vehicles\DTOs\Vehicle {
            return new Vehicle(
                $item['id'],
                $item['vehicle_id'],
                (float)$item['lat'],
                (float)$item['lon'],
                $item['checksum'] ?? null
            );
        }, $array);
    }

    /**
     * @return array<Vehicle>
     */
    public function getAll(): array
    {
        $query = 'SELECT * FROM vehicles';
        $statement = $this->database->getPDO()->prepare($query);
        $statement->execute();
        $array = $statement->fetchAll(\PDO::FETCH_ASSOC);

        return array_map(function ($item): \Domain\Vehicles\DTOs\Vehicle {
            return new Vehicle(
                $item['id'],
                $item['vehicle_id'],
                (float)$item['lat'],
                (float)$item['lon'],
                $item['checksum'] ?? null
            );
        }, $array);
    }

    public function insert(Vehicle $vehicleDTO): void
    {
        $checksum = $vehicleDTO->getChecksum();
        $vehicle_id = $vehicleDTO->vehicleId;
        $lat = $vehicleDTO->lat;
        $lon = $vehicleDTO->lon;
        $query = 'INSERT INTO vehicles (vehicle_id, lat, lon, checksum) VALUES (:vehicle_id, :lat, :lon, :checksum)';
        $statement = $this->database->getPDO()->prepare($query);
        $statement->bindParam(':vehicle_id', $vehicle_id, \PDO::PARAM_INT);
        $statement->bindParam(':lat', $lat);
        $statement->bindParam(':lon', $lon);
        $statement->bindParam(':checksum', $checksum);
        $statement->execute();
    }

    public function truncate(): void
    {
        $query = 'TRUNCATE TABLE vehicles';
        $statement = $this->database->getPDO()->prepare($query);
        $statement->execute();
    }

    public function insertBulk(array $vehicles): void
    {
        $query = 'INSERT INTO vehicles (vehicle_id, lat, lon, checksum) VALUES ';
        $values = [];
        $params = [];

        if ($vehicles == null) {
            return;
        }

        foreach ($vehicles as $index => $vehicle) {
            $checksum = $vehicle->getChecksum();
            $values[] = "(:vehicle_id{$index}, :lat{$index}, :lon{$index}, :checksum{$index})";
            $params[":vehicle_id{$index}"] = $vehicle->vehicleId;
            $params[":lat{$index}"] = $vehicle->lat;
            $params[":lon{$index}"] = $vehicle->lon;
            $params[":checksum{$index}"] = $checksum;
        }

        $query .= implode(', ', $values);
        $statement = $this->database->getPDO()->prepare($query);

        foreach ($params as $key => $value) {
            $statement->bindValue($key, $value);
        }

        $statement->execute();
    }

    public function removeOlderThanDate(string $date): void
    {
        $query = 'DELETE FROM vehicles WHERE created_at < :date';
        $statement = $this->database->getPDO()->prepare($query);
        $statement->bindParam(':date', $date);
        $statement->execute();
    }
}
