<?php

namespace Infrastructure\Shared\Requests;

use Infrastructure\Shared\AbstractApiRequest;

class GetZTMVehiclesPositionsRequest extends AbstractApiRequest
{
    public function method(): string
    {
        return 'GET';
    }

    public function headers(): array
    {
        return [];
    }

    public function path(): string
    {
        return 'https://ckan2.multimediagdansk.pl/gpsPositions?v=2';
    }

    public function body(): array
    {
        return [];
    }
}
