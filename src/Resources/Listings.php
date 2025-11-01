<?php

namespace RanaTuhin\Hostaway\Resources;

use RanaTuhin\Hostaway\Helpers\RequestHelper;

class Listings extends RequestHelper
{
     /**
      * Retrieve all listings.
      *
      * @param  array  $params
      * @return array
      */
     public function getAll(array $params = [])
     {
          return $this->get('listings', $params);
     }

     /**
      * Retrieve a single listing by ID.
      *
      * @param  int  $id
      * @return array
      */
     public function getById(int $id)
     {
          return $this->get("listings/{$id}");
     }

     /**
      * Create a new listing.
      *
      * @param  array  $data
      * @return array
      */
     public function create(array $data)
     {
          return $this->post('listings', $data);
     }

     /**
      * Update an existing listing.
      *
      * @param  int  $id
      * @param  array  $data
      * @return array
      */
     public function update(int $id, array $data)
     {
          return $this->put("listings/{$id}", $data);
     }

     /**
      * Delete a listing by ID.
      *
      * @param  int  $id
      * @return array
      */
     public function delete(int $id)
     {
          return $this->deleteRequest("listings/{$id}");
     }

     /**
      * Get calendar availability for a specific listing.
      *
      * @param  int  $id
      * @param  array  $params
      * @return array
      */
     public function getCalendar(int $id, array $params = [])
     {
          return $this->get("listings/{$id}/calendar", $params);
     }

     /**
      * Get reservations for a specific listing.
      *
      * @param  int  $id
      * @param  array  $params
      * @return array
      */
     public function getReservations(int $id, array $params = [])
     {
          return $this->get("listings/{$id}/reservations", $params);
     }
}
