<?php

namespace Infrastructure\Shared\Responses;

use Domain\Vehicles\DTOs\Vehicle;
use Infrastructure\Shared\AbstractApiResponse;

class GetZTMVehiclesPositionsResponse extends AbstractApiResponse
{
    /**
     * @return Vehicle[]
     */
    #[\Override]
    public function getResponse(): array
    {
        return array_map(function (array $item): \Domain\Vehicles\DTOs\Vehicle {
            return new Vehicle(
                null,
                $item['vehicleId'],
                (float)$item['lat'],
                (float)$item['lon'],
            );
        }, $this->responseData['vehicles'] ?? []);
    }
}
