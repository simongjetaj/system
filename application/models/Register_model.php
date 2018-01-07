<?php 
  class Register_model extends CI_Model {
    public function register($enc_password, $post_image) {
      // User data array
      $data = array(
        'fullname' => $this->input->post('fullname'),
        'image' => $post_image,
        'address' => $this->input->post('address'),
        'email' => $this->input->post('register_email'),
        'password' => $enc_password
      );

      // Insert User
      return $this->db->insert('system', $data);
    }

    // Check email exists in database
    public function check_email_exists($register_email) {
      $query = $this->db->get_where('system', array('email'=>$register_email));
      
      if(empty($query->row_array())) {
        return true;
      } else {
        return false;
      }
    }

    // Check fullname exists in database
    public function check_name_exists($fullname) {
      $query = $this->db->get_where('system', array('fullname'=>$fullname));

      if(empty($query->row_array())) {
        return true;
      } else {
        return false;
      }
    }
  }