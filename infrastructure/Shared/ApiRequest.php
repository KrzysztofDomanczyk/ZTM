<?php

namespace Infrastructure\Shared;

interface ApiRequest
{
    public function method(): string;
    public function headers(): array;
    public function path(): string;
    public function body(): array;
    public function toArray(): array;
}
