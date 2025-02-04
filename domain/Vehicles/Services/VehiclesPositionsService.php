<?php

namespace Domain\Vehicles\Services;

use Domain\Vehicles\DTOs\Vehicle;
use Infrastructure\Repositories\PostgresVehicleRepository;
use Infrastructure\Shared\ProceedRequest;
use Infrastructure\Shared\Requests\GetZTMVehiclesPositionsRequest;
use Infrastructure\Shared\Responses\GetZTMVehiclesPositionsResponse;

class VehiclesPositionsService
{
    protected PostgresVehicleRepository $repository;
    public function __construct()
    {
        $this->repository = new PostgresVehicleRepository();
    }

    public function refreshData(): VehiclesPositionsService
    {
        $vehiclesFromApi = $this->getVehiclesFromApi();

        $vehiclesFromDatabase = $this->repository->getAll();

        $repositoryChecksums =  array_map(function ($item) {
            return $item->getChecksum();
        }, $vehiclesFromDatabase);

        $vehicles = array_filter($vehiclesFromApi, function ($item) use ($repositoryChecksums) {
            return !in_array($item->getChecksum(), $repositoryChecksums);
        });

        $this->repository->truncate();

        $this->repository->insertBulk($vehicles);

        return $this;
    }

    /**
     * @return array<Vehicle>
     */
    public function getLastVehiclesPositions(): array
    {
        $vehicles = $this->repository->getLastPositionOfVehicles();

        if (empty($vehicles)) {
            $this->refreshData();
            $vehicles = $this->repository->getLastPositionOfVehicles();
        }

        return $vehicles;
    }

    /**
     * @return array<Vehicle>
     */
    public function getVehiclesFromApi(): array
    {
        /**
         * @var GetZTMVehiclesPositionsResponse $response
         */
        $response = (new ProceedRequest())(new GetZTMVehiclesPositionsRequest());

        return $response->getResponse();
    }
}
