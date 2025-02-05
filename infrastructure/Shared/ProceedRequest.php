<?php

namespace Infrastructure\Shared;

use Exception;

class ProceedRequest
{
    protected array $responseClasses = [];

    public function __invoke(AbstractApiRequest $request)
    {
        $responseClass = $this->getResponseClass($request);
        $jsonData = json_encode($request->body());
        $ch = curl_init($request->path());

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $request->headers());

        //TODO Other options are not implemented
        if ($request->method() === 'POST') {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        } else {
            curl_setopt($ch, CURLOPT_HTTPGET, true);
        }

        $response = curl_exec($ch);

        if (curl_errno($ch) !== 0) {
            throw new \Exception('Curl error: '.curl_error($ch));
        }

        curl_close($ch);

        return new $responseClass($response);
    }

    protected function getResponseClass(ApiRequest $request): string
    {
        $requestClass = get_class($request);

        $responseClass = $this->responseClasses[$requestClass] ?? str_replace('Request', 'Response', $requestClass);

        if (!class_exists($responseClass)) {
            throw new Exception('Class '.$responseClass.' not found.');
        }
        return $responseClass;
    }
}
