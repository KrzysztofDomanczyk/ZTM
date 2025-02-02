<?php

namespace Domain\Vehicles\DTOs;

class Vehicle
{
    public function __construct(
        public readonly ?int  $id,
        public readonly int   $vehicleId,
        public readonly float $lat,
        public readonly float $lon,
        public readonly ?string $checksum = null,
    ) {
    }

    public function getChecksum(): string
    {
        return md5($this->vehicleId . '|' . $this->lat . '|' . $this->lon);
    }

    public function toArray(): array
    {
        return [
            'id'        => $this->id,
            'vehicle_id' => $this->vehicleId,
            'lat'       => $this->lat,
            'lon'       => $this->lon,
            'checksum'  => $this->checksum ,
        ];
    }
}
