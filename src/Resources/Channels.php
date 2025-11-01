<?php

namespace RanaTuhin\Hostaway\Resources;

use RanaTuhin\Hostaway\Helpers\RequestHelper;

class Channels extends RequestHelper
{
     /**
      * Get all connected channels.
      *
      * @param  array  $params
      * @return array
      */
     public function getAll(array $params = [])
     {
          return $this->get('channels', $params);
     }

     /**
      * Retrieve a specific channel by ID.
      *
      * @param  int  $id
      * @return array
      */
     public function getById(int $id)
     {
          return $this->get("channels/{$id}");
     }

     /**
      * Refresh synchronization for a specific channel.
      *
      * @param  int  $id
      * @return array
      */
     public function refresh(int $id)
     {
          return $this->post("channels/{$id}/refresh");
     }

     /**
      * Disconnect a channel integration.
      *
      * @param  int  $id
      * @return array
      */
     public function disconnect(int $id)
     {
          return $this->post("channels/{$id}/disconnect");
     }

     /**
      * Retrieve listings associated with a specific channel.
      *
      * @param  int  $channelId
      * @param  array  $params
      * @return array
      */
     public function getChannelListings(int $channelId, array $params = [])
     {
          return $this->get("channels/{$channelId}/listings", $params);
     }

     /**
      * Update channel settings (like pricing sync, availability, etc.)
      *
      * @param  int  $id
      * @param  array  $data
      * @return array
      */
     public function updateSettings(int $id, array $data)
     {
          return $this->put("channels/{$id}/settings", $data);
     }
}
