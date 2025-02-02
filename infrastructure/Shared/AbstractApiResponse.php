<?php

namespace Infrastructure\Shared;

class AbstractApiResponse
{
    protected array $responseData;

    public function __construct(protected mixed $response)
    {
        $this->responseData = json_decode($this->response, true);
    }

    public function getResponse(): array
    {
        return $this->responseData;
    }
}
