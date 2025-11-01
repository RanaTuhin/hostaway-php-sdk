<?php

namespace RanaTuhin\Hostaway\Exceptions;

class InvalidConfigurationException extends HostawayException
{
     public static function missing(string $key): self
     {
          return new self("The Hostaway configuration key [{$key}] is missing or empty. Please check your .env and config/hostaway.php file.");
     }
}
