<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends admin_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->form_validation->set_error_delimiters('<div>', '</div>');
        $this->load->model('Admin_model');
    }

	public function index()
	{
		$this->load->view(admin_view('users/login'));
	}

	public function login()
    {
       
            $this->form_validation->set_rules('username', 'Username/Email ID', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');
           // print_r($_POST);die;
          if($this->form_validation->run()) {
                $username = $this->input->post('username');
                $password = $this->input->post('password');
                if ($this->Admin_model->authenticate($username, md5($password))) {
                    $sess = array('userid' => TRUE);
                    $this->session->set_userdata($sess);
                    redirect(admin_url('dashboard'));
                } else {
                    $this->session->set_flashdata('error', 'Invalid userid/password. Try again');
                    redirect(admin_url('users/login'));
                }
            }
        $this->load->view(admin_view('users/login'));
    }

	public function logout()
    {
        $newdata = array('userid' => '', 'username' => '', 'role' => '');
        $this->session->unset_userdata($newdata);
        $this->session->sess_destroy();
        $this->session->set_flashdata('error', 'You have successfully logged out');
        redirect(admin_url('users'));
    }

}

/* End of file Users.php */
/* Location: ./application/controllers/admin/Users.php */