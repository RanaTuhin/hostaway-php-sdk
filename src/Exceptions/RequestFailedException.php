<?php

namespace RanaTuhin\Hostaway\Exceptions;

class RequestFailedException extends HostawayException
{
     public static function fromResponse(array $response): self
     {
          $message = $response['error_description']
               ?? $response['message']
               ?? json_encode($response);

          return new self("Hostaway API request failed: {$message}");
     }
}
