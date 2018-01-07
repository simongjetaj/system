<?php 
  class Admin_model extends CI_Model {

    var $table = 'system';
    var $column_order = array(null, 'image', 'fullname','address','email', 'department', 'id'); // set column field database for datatable orderable
    var $column_search = array('fullname','address','email', 'department'); // set column field database for datatable searchable 
    var $order = array('fullname' => 'asc'); // default order 
      
    private function _get_datatables_query()
    {
        $this->db->where('user_role', '0');
        $this->db->from($this->table);
 
        $i = 0;
     
        foreach ($this->column_search as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                 
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
         
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
 
    function get_datatables()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $this->db->where('user_role', '0');
        // $this->db->join('departments', 'system.department_id = departments.dep_id', 'left');
        $query = $this->db->get();
        return $query->result();
    }
 
    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all()
    {
        $this->db->from($this->table);
        
        return $this->db->count_all_results();
    }

    public function get_users($id = FALSE) {
        $this->db->where("user_role", 0);
        if($id == FALSE) {
            $query = $this->db->get('system');
            return $query->result_array();
        }

        $query = $this->db->get_where('system', array('id' => $id));
        return $query->row_array();
    }


    public function add($enc_password, $post_image) {
        // User data array
        $data = array(
          'fullname' => $this->input->post('fullname'),
          'user_role' => $this->input->post('role'),
          'image' => $post_image,
          'address' => $this->input->post('address'),
          'department' => $this->input->post('depart'),
          'email' => $this->input->post('register_email'),
          'password' => $enc_password
        );
  
        // Insert User
        return $this->db->insert('system', $data);
      }

    public function delete_user($id) {
        $this->db->where("id", $id);  
        $this->db->delete("system"); 
        return true;
    }

    public function insert_department() {
        $this->db->set('department', $this->input->post('dep')); 
        $this->db->where('id', $this->input->post('id')); 
        return $this->db->update('system');  
    }

    public function update_user($edit_image) {
        $data = array(
            'fullname' => $this->input->post('fullname'),
            'image'    => $edit_image,
            'address'  => $this->input->post('address'),
            'department'  => $this->input->post('dep')
          );
          
          $this->db->where('id', $this->input->post('id'));
          return $this->db->update('system', $data);
    }

    public function tree() {
        $query = $this->db->select('department, fullname')->from('system')->order_by('department, fullname')->get();
        return $query->result_array();
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

