<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Banner extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->data['header'] = '';
        $this->admin_login();
        $config['upload_path']          = './assets/images/banner';
		$config['allowed_types']        = 'gif|jpg|png|jpeg';
		$this->load->library('upload', $config);
	}

	public function index($page=1)
	{
		if(isset($_GET['page'])){
            $page = $_GET['page'];
        }
        $show_per_page = 10;
        $offset = ($page - 1) * $show_per_page;
        $this->data['title'] = 'Banner List';
        $this->data['tab'] = 'banners';
        $this->data['main'] = admin_view('banner/index');
        $products = $this->Master_model->getAll($offset, $show_per_page,'banner');
        $this->data['products'] = $products['results'];
        $config['base_url'] = admin_url('banner/index');
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
        $this->data['title'] = 'Add Banner';
        $this->data['tab'] = 'banners';
		$this->data['main'] = admin_view('banner/add');
		$this->data['product'] = $this->Product_model->getNew('banner');
        $this->data['product']->gender = "Male";
        if ($id) {
            $this->data['product'] = $product = $this->Product_model->getRow($id,'banner');
            if(!isset($product)){
               show_404();
                exit();
            }
        }
		$this->form_validation->set_rules('frm[banner_type]', 'Banner Location', 'required');
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
			$this->session->set_flashdata("success", "Banner detail saved");
            redirect(admin_url('banner/add/' . $id));
		}		
		$this->load->view(admin_view('default'),$this->data);
	}

    function activate($id = false)
    {
        $redirect = isset($_GET['redirect_to']) ? $_GET['redirect_to'] : admin_url('banner');
        if ($id) {
            $c['id'] = $id;
            $c['status'] = 1;
            $this->Product_model->save($c,'banner');
            $this->session->set_flashdata("success", "Banner activated");
        }
        redirect($redirect);
    }

    function deactivate($id = false)
    {
        $redirect = isset($_GET['redirect_to']) ? $_GET['redirect_to'] : admin_url('banner');
        if ($id) {
            $c['id'] = $id;
            $c['status'] = 0;
            $this->Product_model->save($c,'banner');
            $this->session->set_flashdata("success", "Banner deactivated");
        }
        redirect($redirect);
    }

	function delete($id){
		if ($id > 0) {
            $this->Product_model->delete($id,'banner');
            $this->session->set_flashdata('success', 'Banner deleted successfully ');
        }
        redirect(admin_url('banner'));
	}
       
}

/* End of file Products.php */
/* Location: ./application/controllers/admin/Products.php */