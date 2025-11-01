<?php

namespace RanaTuhin\Hostaway\Helpers;

use Illuminate\Support\Facades\Http;
use RanaTuhin\Hostaway\Exceptions\RequestFailedException;

class RequestHelper
{
     protected string $baseUrl;
     protected ?string $accessToken = null;

     public function __construct(string $baseUrl, string $accessToken)
     {
          $this->baseUrl = rtrim($baseUrl, '/');
          $this->accessToken = $accessToken;
     }

     /**
      * Perform a GET request.
      */
     public function get(string $endpoint, array $params = []): array
     {
          $response = Http::withHeaders($this->getHeaders())
               ->get("{$this->baseUrl}{$endpoint}", $params);

          return $this->handleResponse($response);
     }

     /**
      * Perform a POST request.
      */
     public function post(string $endpoint, array $data = []): array
     {
          $response = Http::withHeaders($this->getHeaders())
               ->post("{$this->baseUrl}{$endpoint}", $data);

          return $this->handleResponse($response);
     }

     /**
      * Perform a PUT request.
      */
     public function put(string $endpoint, array $data = []): array
     {
          $response = Http::withHeaders($this->getHeaders())
               ->put("{$this->baseUrl}{$endpoint}", $data);

          return $this->handleResponse($response);
     }

     /**
      * Perform a DELETE request.
      */
     public function delete(string $endpoint, array $params = []): array
     {
          $response = Http::withHeaders($this->getHeaders())
               ->delete("{$this->baseUrl}{$endpoint}", $params);

          return $this->handleResponse($response);
     }

     /**
      * Common headers for all requests.
      */
     protected function getHeaders(): array
     {
          return [
               'Authorization' => "Bearer {$this->accessToken}",
               'Cache-control' => 'no-cache',
               'Accept' => 'application/json',
          ];
     }

     /**
      * Handle and normalize response or throw exception.
      */
     protected function handleResponse($response): array
     {
          if (!$response->successful()) {
               throw RequestFailedException::fromResponse($response->json());
          }

          return $response->json();
     }
}
