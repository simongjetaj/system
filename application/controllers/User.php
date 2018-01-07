<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
  public function index()
	{
		if($this->session->userdata('logged_in')) {
			$this->load->view('user');
		} else {
			redirect('/');
		}
	}

	public function edit() {
			$this->form_validation->set_rules('edit_fullname', 'Full Name', 'trim|required|min_length[5]');
			$this->form_validation->set_rules('edit_address', 'Address', 'trim|required|min_length[6]');

			$config = [
							'upload_path'   => './assets/images',
							'allowed_types' => 'jpeg|jpg|png|gif',
							'max_size'      => 2048,
				      'max_width'     => 1024,
				      'max_height'    => 768
						];

			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			
			if($this->form_validation->run() == FALSE) {
				$this->load->view('edit');
			} else {
				if($this->upload->do_upload('edit_image')) {
					$data = array('upload_data' => $this->upload->data());
					$edit_image = $_FILES['edit_image']['name'];
				} else {
					$edit_image = $this->session->userdata('image');
				}
				$this->user_model->edit($edit_image);
				redirect('user');	
			}
		}

		public function logout() 
		{
			// Removing session data
			$array_items = array('id', 'image', 'fullname', 'address', 'logged_in');
			$this->session->unset_userdata($array_items);
			
			$this->session->set_flashdata('logout', 'You are now logged out!');
			redirect('');
		}
}