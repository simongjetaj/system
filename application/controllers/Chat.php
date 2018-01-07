<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chat extends CI_Controller {

  public function index()
  {
    if($this->session->userdata('logged_in')) {
      $data['user_id'] = $this->session->userdata('id');

      $this->load->view('chat', $data);
		} else {
			redirect('/');
		}
  }

  function ajax_add_chat_message() {
    $user_id = $this->input->post('user_id');
    $chat_message_content = $this->input->post('chat_message_content', TRUE);

    $this->chat_model->add_chat_message($user_id, $chat_message_content);

    return json_encode($result);
  }

  function ajax_get_chat_messages() {
    echo $this->_get_chat_messages();
  }

  function _get_chat_messages() {
    $chat_messages = $this->chat_model->get_chat_messages();
    
    if($chat_messages->num_rows() > 0) {
      $content = "<ul>";
        foreach($chat_messages->result() as $chat_message) {
          $li_class = ($this->session->userdata('id') == $chat_message->id) ? 'class="current_user"' : '';

          $content .= '<li '. $li_class . '>' . '<span class="chat_message_header">'. $chat_message->chat_message_timestamp . ' by ' . '<strong>'.$chat_message->fullname.'</strong>' . '</span><br><p class="message_content">' . $chat_message->chat_message_content .'</p></li><hr>';
        }
      $content .= "</ul>";

      $result = array('status' => 'ok', 'content' => $content);
      return json_encode($result);
    } else {
      $result = array('status' => 'ok', 'content' => '');
      return json_encode($result);
    }
  }
}