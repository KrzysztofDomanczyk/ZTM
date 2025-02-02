<?php

namespace Domain\Vehicles\Services;

use Domain\Vehicles\DTOs\VehicleDTO;
use Infrastructure\Repositories\PostgresVehicleRepository;
use Infrastructure\Shared\ProceedRequest;
use Infrastructure\Shared\Requests\GetZTMVehiclesPositionsRequest;
use Infrastructure\Shared\Responses\GetZTMVehiclesPositionsResponse;

class VehicleService
{
    protected PostgresVehicleRepository $repository;
    public function __construct()
    {
        $this->repository = new PostgresVehicleRepository();
    }

    public function refreshData(): VehicleService
    {
        $vehiclesFromApi = $this->getVehiclesFromApi();

        $vehiclesFromDatabase = $this->repository->getAll();

        $repositoryChecksums =  array_map(function ($item) {
            return $item->getChecksum();
        }, $vehiclesFromDatabase);

        $vehicles = array_filter($vehiclesFromApi, function ($item) use ($repositoryChecksums) {
            return !in_array($item->getChecksum(), $repositoryChecksums);
        });

        $this->repository->insertBulk($vehicles);

        return $this;
    }

    public function getLastVehiclesPositions()
    {
        return $this->repository->getLastPositionOfVehicles();
    }

    /**
     * @return VehicleDTO[]
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
