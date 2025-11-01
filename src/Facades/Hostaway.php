<?php

namespace RanaTuhin\Hostaway\Facades;

use Illuminate\Support\Facades\Facade;

class Hostaway extends Facade
{
     protected static function getFacadeAccessor()
     {
          return 'hostaway';
     }
}
