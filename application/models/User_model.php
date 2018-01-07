<?php 
  class User_model extends CI_Model {
    public function user($login_email, $login_password) 
    {
      $this->db->select('*');
      $this->db->from('system');
      $this->db->where(array('email' => $login_email, 'password' => $login_password));
      $query = $this->db->get();
      $user = $query->row();
      return $user;
    }

    public function edit($edit_image) 
    {
      $data = array(
        'fullname' => $this->input->post('edit_fullname'),
        'image'    => $edit_image,
        'address'  => $this->input->post('edit_address')
      );
      
      $this->session->set_userdata($data);
      $this->db->where('id', $this->session->userdata('id'));
      return $this->db->update('system', $data);
    }

}