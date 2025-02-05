<?php

namespace Domain\Vehicles\Services;

use Domain\Vehicles\DTOs\Vehicle;
use Domain\Vehicles\Interfaces\VehicleRepositoryInterface;
use Infrastructure\Repositories\PostgresVehicleRepository;
use Infrastructure\Shared\ProceedRequest;
use Infrastructure\Shared\Requests\GetZTMVehiclesPositionsRequest;
use Infrastructure\Shared\Responses\GetZTMVehiclesPositionsResponse;

class VehiclesPositionsService
{
    const string REMOVE_OLDER_THAN_MINUTES = '-10 minutes';

    protected VehicleRepositoryInterface $repository;

    public function __construct(VehicleRepositoryInterface $repository = null)
    {
        $this->repository = $repository ?? new PostgresVehicleRepository();
    }

    public function refreshData(): VehiclesPositionsService
    {
        $this->repository->removeOlderThanDate(date('Y-m-d H:i:s', strtotime(self::REMOVE_OLDER_THAN_MINUTES)));

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
