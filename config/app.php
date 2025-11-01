<?php

return [
     'providers' => [
          // ...
          RanaTuhin\Hostaway\HostawayServiceProvider::class,
     ],

     'aliases' => [
          // ...
          'Hostaway' => RanaTuhin\Hostaway\Facades\Hostaway::class,
     ],

];
