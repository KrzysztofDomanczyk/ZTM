<?php

namespace Infrastructure\Shared\Responses;

use Domain\Vehicles\DTOs\VehicleDTO;
use Infrastructure\Shared\AbstractApiResponse;

class GetZTMVehiclesPositionsResponse extends AbstractApiResponse
{
    /**
     * @return VehicleDTO[]
     */
    #[\Override]
    public function getResponse(): array
    {
        return array_map(function (array $item): \Domain\Vehicles\DTOs\VehicleDTO {
            return new VehicleDTO(
                null,
                $item['vehicleId'],
                (float)$item['lat'],
                (float)$item['lon'],
            );
        }, $this->responseData['vehicles'] ?? []);
    }
}
