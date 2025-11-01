<?php

namespace RanaTuhin\Hostaway\Resources;

use RanaTuhin\Hostaway\Helpers\RequestHelper;

class Messages extends RequestHelper
{
     /**
      * Retrieve all messages.
      *
      * @param  array  $params
      * @return array
      */
     public function getAll(array $params = [])
     {
          return $this->get('messages', $params);
     }

     /**
      * Retrieve a single message by ID.
      *
      * @param  int  $id
      * @return array
      */
     public function getById(int $id)
     {
          return $this->get("messages/{$id}");
     }

     /**
      * Send a new message to a guest or reservation.
      *
      * @param  array  $data
      * @return array
      */
     public function send(array $data)
     {
          return $this->post('messages', $data);
     }

     /**
      * Send a message to a specific reservation.
      *
      * @param  int  $reservationId
      * @param  string  $message
      * @return array
      */
     public function sendToReservation(int $reservationId, string $message)
     {
          return $this->post("messages/reservations/{$reservationId}", [
               'message' => $message,
          ]);
     }

     /**
      * Send a message to a specific guest.
      *
      * @param  int  $guestId
      * @param  string  $message
      * @return array
      */
     public function sendToGuest(int $guestId, string $message)
     {
          return $this->post("messages/guests/{$guestId}", [
               'message' => $message,
          ]);
     }

     /**
      * Retrieve all threads for a reservation.
      *
      * @param  int  $reservationId
      * @param  array  $params
      * @return array
      */
     public function getThreadsByReservation(int $reservationId, array $params = [])
     {
          return $this->get("messages/reservations/{$reservationId}/threads", $params);
     }

     /**
      * Retrieve all threads for a guest.
      *
      * @param  int  $guestId
      * @param  array  $params
      * @return array
      */
     public function getThreadsByGuest(int $guestId, array $params = [])
     {
          return $this->get("messages/guests/{$guestId}/threads", $params);
     }

     /**
      * Mark a message as read.
      *
      * @param  int  $messageId
      * @return array
      */
     public function markAsRead(int $messageId)
     {
          return $this->post("messages/{$messageId}/read");
     }
}
