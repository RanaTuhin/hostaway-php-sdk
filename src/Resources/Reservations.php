<?php

namespace RanaTuhin\Hostaway\Resources;

use RanaTuhin\Hostaway\Helpers\RequestHelper;

class Reservations extends RequestHelper
{
     /**
      * Retrieve all reservations.
      *
      * @param  array  $params
      * @return array
      */
     public function getAll(array $params = [])
     {
          return $this->get('reservations', $params);
     }

     /**
      * Retrieve a single reservation by ID.
      *
      * @param  int  $id
      * @return array
      */
     public function getById(int $id)
     {
          return $this->get("reservations/{$id}");
     }

     /**
      * Create a new reservation.
      *
      * @param  array  $data
      * @return array
      */
     public function create(array $data)
     {
          return $this->post('reservations', $data);
     }

     /**
      * Update an existing reservation.
      *
      * @param  int  $id
      * @param  array  $data
      * @return array
      */
     public function update(int $id, array $data)
     {
          return $this->put("reservations/{$id}", $data);
     }

     /**
      * Cancel a reservation by ID.
      *
      * @param  int  $id
      * @param  array  $params
      * @return array
      */
     public function cancel(int $id, array $params = [])
     {
          return $this->post("reservations/{$id}/cancel", $params);
     }

     /**
      * Get messages for a specific reservation.
      *
      * @param  int  $id
      * @param  array  $params
      * @return array
      */
     public function getMessages(int $id, array $params = [])
     {
          return $this->get("reservations/{$id}/messages", $params);
     }

     /**
      * Add a note to a reservation.
      *
      * @param  int  $id
      * @param  string  $note
      * @return array
      */
     public function addNote(int $id, string $note)
     {
          return $this->post("reservations/{$id}/notes", ['note' => $note]);
     }
}
