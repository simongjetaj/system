<?php 
  class Chat_model extends CI_Model {
    function add_chat_message($user_id, $chat_message_content) {

      //$query = "INSERT INTO chat_messages (chat_id, id, chat_message_content) VALUES (?, ?, ?)";
      $query = "INSERT INTO chat_messages (id, chat_message_content) VALUES (?, ?)";

      // $this->db->query($query, array($chat_id, $user_id, $chat_message_content));
      $this->db->query($query, array($user_id, $chat_message_content));
    }

    function get_chat_messages() {
      $query = "
        SELECT 
        cm.id, 
        cm.chat_message_content, 
        DATE_FORMAT(cm.create_date, '%D of %M %Y at %H:%i:%s') AS chat_message_timestamp, 
        u.fullname 
        FROM chat_messages cm 
        JOIN system u ON cm.id = u.id
        ORDER BY chat_message_id
      ";

      $result = $this->db->query($query);
      return $result;
    }
  }