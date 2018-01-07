<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	public function index()
	{
		$data['title'] = 'Simon System | Login';
		$this->form_validation->set_rules('login_email', 'E-mail', 'trim|required|valid_email');
		$this->form_validation->set_rules('login_password', 'Password', 'trim|required|min_length[6]');
		
		if($this->form_validation->run() == FALSE) {
			$this->load->view('welcome_message', $data);
		} else {
			// Get email and password, ecrypt password
			$login_email = $this->input->post('login_email');
			$login_password = md5($this->input->post('login_password'));

			$data = $this->user_model->user($login_email, $login_password);
			// Login user based on his id
			// if it matches the email and password of database 
			if($data) {
				if($data->user_role == 1) {
					$admin_data = array(
						'id'				 => $data->id,
						'fullname'   => $data->fullname,
						'image' 		 => $data->image,
						'address'    => $data->address,
						'department' => $data->department,
						'logged_in'  => true
					);
					$this->session->set_userdata($admin_data);
					redirect('admin');
				} else {
					// Create user session
					$user_data = array(
						'id' 				=> $data->id,
						'fullname'  => $data->fullname,
						'image' 		=> $data->image,
						'address'   => $data->address,
						'logged_in' => true
					);

					$this->session->set_userdata($user_data);
					redirect('user');
				} 
			} else {
				$this->session->set_flashdata('login_failed', 'Incorrect Email/Password Combination!');
				redirect("/");
			}
			
		} 
	}

	// sign up user
	public function register()
	{
		$data['title'] = 'Simon System | Register';

		$this->form_validation->set_rules('fullname', 'Full Name', 'trim|required|min_length[5]|callback_check_name_exists');
		$this->form_validation->set_rules('address', 'Address', 'trim|required|min_length[6]');
		$this->form_validation->set_rules('register_email', 'E-mail', 'trim|required|valid_email|callback_check_email_exists');
		$this->form_validation->set_rules('register_password', 'Password', 'trim|required|min_length[6]');
		$this->form_validation->set_rules('register_password2', 'Confirm Password', 'trim|required|matches[register_password]');
		if(empty($_FILES['image']['name'])) {
			$this->form_validation->set_rules('image', 'Upload Image', 'required');
		}
				$config = [
					'upload_path'   => './assets/images',
					'allowed_types' => 'jpeg|jpg|png|gif|JPG|PNG',
					'max_size'      => 2048,
          'max_width'     => 1024,
          'max_height'    => 768
				];
		
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
		if($this->form_validation->run() == FALSE) { 
			$this->load->view('register', $data);
		} else {
			if(! $this->upload->do_upload('image')) {
				$error = array('error' => $this->upload->display_errors());
				$this->session->set_flashdata('error', $error['error']);
				$this->load->view('register', $data);
			} else {
				// Ecrypt password (never use this in production)
				$enc_password = md5($this->input->post('register_password'));

				$data = array('upload_data' => $this->upload->data());
				$post_image = $_FILES['image']['name'];
				$this->register_model->register($enc_password, $post_image);
				// Set session message
				$this->session->set_flashdata('user_registered', 'You Registered Successfully!');
				redirect('/'); 
			}
		}
	}
	

	// Check if email exists, must be unique in the real world
	function check_email_exists($register_email) 
	{
		$this->form_validation->set_message('check_email_exists', 'That email is already taken. Please, choose a different one.');
		if($this->register_model->check_email_exists($register_email)) {
			return true;
		} else {
			return false;
		}
	}

	// Check if name exists, should be unique 
	function check_name_exists($fullname) 
	{
		$this->form_validation->set_message('check_name_exists', 'That name is already taken. Please, choose a different one.');

		if($this->register_model->check_name_exists($fullname)) {
			return true;
		} else {
			return false;
		}
	}
}
