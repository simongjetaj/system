<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

  public function index()
  {
    if($this->session->userdata('logged_in')) {
      $data['users'] = $this->admin_model->get_users();
      $this->load->view('admin', $data);
		} else {
			redirect('/');
		}
  }

  public function profile() {
    if($this->session->userdata('logged_in')) {
			$this->load->view('profile');
		} else {
			redirect('/');
		}
  }

  public function department($id = NULL) {
    $this->form_validation->set_rules('dep', 'Departament', 'trim|required');

    if($this->form_validation->run() == FALSE) { 
      if($this->session->userdata('logged_in')) {
        $data['user'] = $this->admin_model->get_users($id);

        if(empty($data['user'])) {
          show_404();
        }

        $data['id'] = $data['user']['id'];
        // print_r($data['user']);
        $this->load->view('department', $data);
      } 
    } else {
      $this->admin_model->insert_department();
      redirect('admin');
    }
  }

  public function person($id = NULL) {
    $this->form_validation->set_rules('fullname', 'Full Name', 'trim|required|min_length[5]');
		$this->form_validation->set_rules('address', 'Address', 'trim|required|min_length[6]');

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
      if($this->session->userdata('logged_in')) {
        $data['user'] = $this->admin_model->get_users($id);

        if(empty($data['user'])) {
          show_404();
        }

        $data['id'] = $data['user']['id'];
        // print_r($data['user']);
        $edit_image = $data['user']['image'];
        $this->load->view('person', $data);
      } 
    } else {
      if($this->upload->do_upload('image')) {
        $data = array('upload_data' => $this->upload->data());
        $edit_image = $_FILES['image']['name'];
      } else {
        $data['user'] = $this->admin_model->get_users($id);
        $edit_image = $data['user']['image'];
      }
      $this->admin_model->update_user($edit_image);
      redirect('admin');
    }
  }

  public function add() {
    $this->form_validation->set_rules('fullname', 'Full Name', 'trim|required|min_length[5]|callback_check_name_exists');
		$this->form_validation->set_rules('address', 'Address', 'trim|required|min_length[6]');
    $this->form_validation->set_rules('register_email', 'E-mail', 'trim|required|valid_email|callback_check_email_exists');
    $this->form_validation->set_rules('role', 'Role', 'required');
    $this->form_validation->set_rules('register_password', 'Password', 'trim|required|min_length[6]');
    
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
      if($this->session->userdata('logged_in')) {
        $this->load->view('add');
      } else {
        redirect('/');
      }
		} else {
			if(! $this->upload->do_upload('image')) {
        $error = array('error' => $this->upload->display_errors());
				$this->session->set_flashdata('error', $error['error']);
				$this->load->view('add');
			} else {
				// Ecrypt password (never use this in production)
				$enc_password = md5($this->input->post('register_password'));

				$data = array('upload_data' => $this->upload->data());
				$post_image = $_FILES['image']['name'];
				$this->admin_model->add($enc_password, $post_image);
				redirect('admin');
			}
    }
  }

  public function departments() {
    if($this->session->userdata('logged_in')) {
      $data['users'] = $this->admin_model->tree();
      // echo '<pre>';
      // print_r($data['users']);
      // echo '</pre>';
      $this->load->view('departments', $data);
		} else {
			redirect('/');
		}
  }

  public function ajax_list()
  {
      $users = $this->admin_model->get_datatables();
      $data = array();
      $no = $_POST['start'];
      foreach ($users as $user) {
          $no++;
          $row = array();
          $row[] = $no;
          $row[] = '<img src="'.base_url().'assets/images/'.$user->image.'" class="img-thumbnail" width="50" height="35">'; 
          $row[] = $user->fullname;
          $row[] = $user->address;
          $row[] = $user->email;
          $row[] = $user->department; 
          $row[] = '
          <a href="admin/department/' .$user->id. '" class="btn btn-xs btn-success">Add Department</a>
          <a href="admin/person/'. $user->id .'" class="btn btn-xs btn-warning">Edit</a>
          <button type="button" id="' .$user->id. '" class="btn btn-xs btn-danger deleteUser">Delete</button>
          ';  
          $data[] = $row;
      }

      $output = array(
                      "draw" => $_POST['draw'],
                      "recordsTotal" => $this->admin_model->count_all(),
                      "recordsFiltered" => $this->admin_model->count_filtered(),
                      "data" => $data,
              );
      //output to json format
      echo json_encode($output);
  }


  public function delete_user() {
    $success = $this->admin_model->delete_user($_POST['id']);
    if($success) {
        $this->session->set_flashdata('user_deleted', 'User Deleted Successfully!');
    }
  }

  // Check if email exists, must be unique in the real world
	function check_email_exists($register_email) 
	{
		$this->form_validation->set_message('check_email_exists', 'That email is already taken. Please, choose a different one.');
		if($this->admin_model->check_email_exists($register_email)) {
			return true;
		} else {
			return false;
		}
	}

	// Check if name exists, should be unique 
	function check_name_exists($fullname) 
	{
		$this->form_validation->set_message('check_name_exists', 'That name is already taken. Please, choose a different one.');

		if($this->admin_model->check_name_exists($fullname)) {
			return true;
		} else {
			return false;
		}
	}

  public function logout() {
    $array_items = array('id', 'fullname', 'image', 'address', 'department', 'logged_in');
		$this->session->unset_userdata($array_items);
	  $this->session->set_flashdata('logout', 'You are now logged out!');
	  redirect('');
  }
}
