<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Members extends AI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->data['title'] = 'Members';
        $this->data['tab'] = 'members';
        $config['upload_path']          = './assets/images/profile';
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']             = 1024;
		$config['max_width']            = 1024;
		$config['max_height']           = 768;
		$this->load->library('upload', $config);
	}

	public function index()
	{
        $this->data['title'] = 'Registered Users List';
        $this->data['tab'] = 'members';
        $this->data['main'] = admin_view('members/index');
        $this->data['members']  = $this->Master_model->getAllusers();
        $this->load->view(admin_view('default'),$this->data);
	}
    public function newsletters()
    {
        
        $this->data['title'] = 'Newsletter Users List';
        $this->data['tab'] = 'members';
        $this->data['main'] = admin_view('members/newsletter_index');
        $this->data['members'] = $this->db->get('newsletter')->result();
        $this->load->view(admin_view('default'),$this->data);
    }
    function newsletterdelete($id){
        if ($id > 0) {
            $this->Master_model->delete($id,'newsletter');
            $this->session->set_flashdata('success', 'Newsletter deleted successfully.');
        }
        redirect(admin_url('members/newsletters'));
    }
	public function view($id=false)
	{
        $this->data['title'] = 'View User'; 
        $this->data['tab'] = 'members';
		$this->data['main'] = admin_view('members/add');
		$this->data['member'] = $this->Master_model->getNew('user_accounts');
        if ($id) {
            $this->data['member'] = $pages = $this->Master_model->getuserRow($id,'user_accounts');
            if(!isset($pages)){
               redirect(site_url('404_override'));
               exit();
            }
        }
        
		$this->form_validation->set_rules('frm[user_fname]', 'First Name', 'required');
        $this->form_validation->set_rules('frm[user_lname]', 'Last Name', 'required');
        $this->form_validation->set_rules('frm[user_emailid]', 'Email', 'required|is_unique[user_accounts.user_emailid]');
        $this->form_validation->set_rules('frm[user_pasword]', 'Password', 'required');
		if ($this->form_validation->run()) {
			$formdata = $this->input->post('frm');
			
			$formdata['user_id'] = $id;
            $formdata['u_type'] = '4';
            $formdata['user_pasword'] = base64_encode($formdata['user_pasword']);
            $formdata['user_status'] =1;
            $formdata['created_at']=date('Y-m-d h:i:s');
			$id = $this->Master_model->save($formdata,'user_accounts');
           
			$this->session->set_flashdata("success", "User created successfully");
            redirect(admin_url('members'));
	
	}
        $this->load->view(admin_view('default'),$this->data);
    }
    public function edit($id=false)
    {
        $this->data['title'] = 'Edit User'; 
        $this->data['tab'] = 'add_member';
        $this->data['main'] = admin_view('members/edit');
        $this->data['member'] = $this->Master_model->getNew('users');
        if ($id) {
            $this->data['member'] = $pages = $this->Master_model->getRow($id,'users');
            if(!isset($pages)){
               redirect(site_url('404_override'));
               exit();
            }
        }
        
        $this->form_validation->set_rules('frm[fname]', 'Full Name', 'required');
        $this->form_validation->set_rules('frm[mobile]', 'Contact Number', 'required');
        $this->form_validation->set_rules('frm[password]', 'Password', 'required');
        if ($this->form_validation->run()) {
            $formdata = $this->input->post('frm');
            
            $formdata['user_id'] = $id;
            $formdata['u_type'] = 'fo';
            $formdata['password'] = base64_encode($formdata['password']);
            $id = $this->User_model->save($formdata,'users');
           
            $this->session->set_flashdata("success", "User details updated");
            redirect(admin_url('members/edit/' . $id));
    
    }
        $this->load->view(admin_view('default'),$this->data);
    }
	function activate($id = false)
    {
        $redirect = isset($_GET['redirect_to']) ? $_GET['redirect_to'] : admin_url('members');
        if ($id) {
            $c['user_status'] = 1;
            $this->db->update('user_accounts',$c,array('user_id'=>$id));
            $this->session->set_flashdata("success", "User activated successfully!");
        }
        redirect($redirect);
    }

    function deactivate($id = false)
    {
        $redirect = isset($_GET['redirect_to']) ? $_GET['redirect_to'] : admin_url('members');
        if ($id) {
            $c['user_status'] = 0;
            $this->db->update('user_accounts',$c,array('user_id'=>$id));
            $this->session->set_flashdata("success", "User deactivated successfully!");
        }
        redirect($redirect);
    }

	function delete($id){
		if ($id > 0) {
            $this->db->delete('user_accounts',array('user_id'=>$id));
            $this->session->set_flashdata('success', 'User deleted successfully');
        }
        redirect(admin_url('members'));
	}
    public function user_list($page=1)
    {
        if(isset($_GET['page'])){
            $page = $_GET['page'];
        }
        $show_per_page = 20;
        $offset = ($page - 1) * $show_per_page;
        $this->data['title'] = 'Users List';
        $this->data['tab'] = 'users_list';
        $this->data['main'] = admin_view('members/users_index');
        $members = $this->Master_model->getAlluser($offset, $show_per_page,'users');
        // if ($this->input->get('btnsearch')) {
        //     $q = $this->input->get('q');
        //     if ($q <> '') {
        //         $likes = array(
        //             'first_name' => $q, 'last_name' => $q, 'email_id' => $q
        //         );
        //         $members = $this->Service_model->getAllSearched($offset, $show_per_page, $likes);
        //     }
        // }
        $this->data['members'] = $members['results'];
        $config['base_url'] = admin_url('members/user_list');
        $config['num_links'] = 2;
        $config['uri_segment'] = 4;
        $config['total_rows'] = $members['total'];
        $config['per_page'] = $show_per_page;
        $config['full_tag_open'] = '<ul class="pagination pagination-sm">';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['prev_link'] = 'Prev';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = 'Next';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['use_page_numbers'] = true;
        $config['use_page_numbers'] = true;
        $config['page_query_string'] = true;
        $config['query_string_segment'] = 'page';
        $config['reuse_query_string'] = true;

        $this->pagination->initialize($config);
        $this->data['paginate'] = $this->pagination->create_links();
        $this->load->view(admin_view('default'),$this->data);
    }
    function useractivate($id = false)
    {
        $redirect = isset($_GET['redirect_to']) ? $_GET['redirect_to'] : admin_url('members/user_list');
        if ($id) {
            $c['id'] = $id;
            $c['status'] = 1;
            $this->User_model->save($c,'users');
            $this->session->set_flashdata("success", "User activated successfully!");
        }
        redirect($redirect);
    }

    function userdeactivate($id = false)
    {
        $redirect = isset($_GET['redirect_to']) ? $_GET['redirect_to'] : admin_url('members/user_list');
        if ($id) {
            $c['id'] = $id;
            $c['status'] = 0;
            $this->User_model->save($c,'users');
            $this->session->set_flashdata("success", "User deactivated successfully!");
        }
        redirect($redirect);
    }

    function userdelete($id){
        if ($id > 0) {
            $this->User_model->delete($id,'users');
            $this->session->set_flashdata('success', 'User deleted successfully ');
        }
        redirect(admin_url('members/user_list'));
    }

}

/* End of file Members.php */
/* Location: ./application/controllers/admin/Members.php */