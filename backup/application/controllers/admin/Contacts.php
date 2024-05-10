<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contacts extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->admin_login();
                $this->data['title'] = 'Contacts';
                $this->data['tab'] = 'contacts';
	}

	public function index($page=1)
	{

		if(isset($_GET['page'])){
			$page = $_GET['page'];
		}
		$show_per_page = 20;
        $offset = ($page - 1) * $show_per_page;
        $this->data['main'] = admin_view('contact/index');
        $this->data['contacts'] = $this->Master_model->listAllByDesc('contacts');
		$this->load->view(admin_view('default'),$this->data);

	}
        function delete($id){
        if ($id > 0) {
            $this->User_model->delete($id,'contacts');
            $this->session->set_flashdata('success', 'row deleted successfully.');
        }
        redirect(admin_url('contacts'));
        }



}

/* End of file Contacts.php */
/* Location: ./application/controllers/admin/Contacts.php */