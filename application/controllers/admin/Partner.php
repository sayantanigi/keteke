<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Partner extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->data['header'] = '';
        $this->admin_login();
        $config['upload_path']          = './assets/images/partners';
		$config['allowed_types']        = 'gif|jpg|png|jpeg';
		$config['max_size']             = 1024;
		$config['max_width']            = 1024;
		$config['max_height']           = 768;
		$this->load->library('upload', $config);
	}

	public function index($page=1)
	{
		if(isset($_GET['page'])){
            $page = $_GET['page'];
        }
        $show_per_page = 10;
        $offset = ($page - 1) * $show_per_page;
        $this->data['title'] = 'Partners List';
        $this->data['tab'] = 'partners';
        $this->data['main'] = admin_view('partner/index');
        $products = $this->Master_model->getAll($offset, $show_per_page,'partners');
        $this->data['products'] = $products['results'];
        $config['base_url'] = admin_url('partner/index');
        $config['num_links'] = 2;
        $config['uri_segment'] = 4;
        $config['total_rows'] = $products['total'];
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

	public function add($id=false)
	{
        $this->data['title'] = 'Add Partners';
        $this->data['tab'] = 'add_partner';
		$this->data['main'] = admin_view('partner/add');
		$this->data['product'] = $this->Product_model->getNew();
        $this->data['product']->gender = "Male";
        if ($id) {
            $this->data['product'] = $product = $this->Product_model->getRow($id,'partners');
            if(!isset($product)){
               show_404();
                exit();
            }
        }
		$this->form_validation->set_rules('frm[title]', 'Partner title', 'required');
		$this->form_validation->set_rules('frm[description]', 'Product description', 'required');
		if ($this->form_validation->run()) {
			$formdata = $this->input->post('frm');
			$formdata['id'] = $id;
			//$images = $this->input->post('image');
			if ($this->upload->do_upload('image'))
			{
				$data = $this->upload->data();
				$formdata['image'] = $data['file_name'];
			}
			
			$id = $this->Product_model->save($formdata);
			$this->session->set_flashdata("success", "Partner detail saved");
            redirect(admin_url('partner/add/' . $id));
		}		
		$this->load->view(admin_view('default'),$this->data);
	}

    function activate($id = false)
    {
        $redirect = isset($_GET['redirect_to']) ? $_GET['redirect_to'] : admin_url('partner');
        if ($id) {
            $c['id'] = $id;
            $c['status'] = 1;
            $this->Product_model->save($c);
            $this->session->set_flashdata("success", "Partner activated");
        }
        redirect($redirect);
    }

    function deactivate($id = false)
    {
        $redirect = isset($_GET['redirect_to']) ? $_GET['redirect_to'] : admin_url('partner');
        if ($id) {
            $c['id'] = $id;
            $c['status'] = 0;
            $this->Product_model->save($c);
            $this->session->set_flashdata("success", "Partner deactivated");
        }
        redirect($redirect);
    }

	function delete($id){
		if ($id > 0) {
            $this->Product_model->delete($id);
            $this->session->set_flashdata('success', 'Partner deleted successfully ');
        }
        redirect(admin_url('partner'));
	}
        public function clientlogolist($page=1)
    {
        if(isset($_GET['page'])){
            $page = $_GET['page'];
        }
        $show_per_page = 10;
        $offset = ($page - 1) * $show_per_page;
        $this->data['title'] = 'Client Logo List';
        $this->data['tab'] = 'client_logo';
        $this->data['main'] = admin_view('partner/logoview');
        $products = $this->Master_model->getAll($offset, $show_per_page,'client_logo');
        $this->data['products'] = $products['results'];
        $config['base_url'] = admin_url('partner/clientlogolist');
        $config['num_links'] = 2;
        $config['uri_segment'] = 4;
        $config['total_rows'] = $products['total'];
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
        public function clientlogoadd($id=false)
    {
        $this->data['title'] = 'Add Client Logo';
        $this->data['tab'] = 'clientload';
        $this->data['main'] = admin_view('partner/logoadd');
        $this->data['product'] = $this->Product_model->getNew('client_logo');
        $this->data['product']->gender = "Male";
        if ($id) {
            $this->data['product'] = $product = $this->Product_model->getRow($id,'client_logo');
            if(!isset($product)){
               show_404();
                exit();
            }
        }
        $this->form_validation->set_rules('frm[title]', 'Client Name', 'required');
        if ($this->form_validation->run()) {
            $formdata = $this->input->post('frm');
            $formdata['id'] = $id;
            $formdata['status'] = 1;
            //$images = $this->input->post('image');
            if ($this->upload->do_upload('image'))
            {
                $data = $this->upload->data();
                $formdata['image'] = $data['file_name'];
            }
            
            $id = $this->Product_model->save($formdata);
            $this->session->set_flashdata("success", "Logo Added");
            redirect(admin_url('partner/clientlogoadd/' . $id));
        }       
        $this->load->view(admin_view('default'),$this->data);
    }

    function logo_delete($id){
        if ($id > 0) {
            $this->Product_model->delete($id,'client_logo');
            $this->session->set_flashdata('success', 'Logo deleted successfully ');
        }
        redirect(admin_url('partner/clientlogolist'));
    }

}

/* End of file Products.php */
/* Location: ./application/controllers/admin/Products.php */