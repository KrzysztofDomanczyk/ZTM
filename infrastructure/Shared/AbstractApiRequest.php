<?php

namespace Infrastructure\Shared;

abstract class AbstractApiRequest implements ApiRequest
{
    public function toArray(): array
    {
        return [
            'method' => $this->method(),
            'headers' => $this->headers(),
            'path' => $this->path(),
            'body' => $this->body()
        ];
    }
}
