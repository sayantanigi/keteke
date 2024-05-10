<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Countries extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->admin_login();
        $this->data['title'] = '';
        $this->data['tab'] = '';
	}

    public function add($id=false)
    {
        $this->data['title'] = 'Add Country';
        $this->data['tab'] = 'add_country';
        $this->data['main'] = admin_view('country/add');
        if ($id) {
            $this->data['pages'] = $pages = $this->Master_model->getRow($id,'country');
            if(!isset($pages)){
               redirect(site_url('404_override'));
               exit();
            }
        }
        $this->form_validation->set_rules('frm[name]', 'Country Name', 'required');
        if($this->form_validation->run()) {
            $formdata = $this->input->post('frm');
            $formdata['id'] = $id;   
            $id = $this->Master_model->save($formdata,'country');
            $this->session->set_flashdata("success", "Country added");
            redirect(admin_url('countries/index'));
        }       
        $this->load->view(admin_view('default'),$this->data);
    }

public function index($page = 1)
    {   
        if(isset($_GET['page'])){
            $page = $_GET['page'];
        }
        $show_per_page = 10;
        $offset = ($page - 1) * $show_per_page;
        $this->data['title'] = 'Country List';
        $this->data['tab'] = 'country';
        $this->data['main'] = admin_view('country/index');
        $cms = $this->Master_model->getAll($offset, $show_per_page,'country');
        $this->data['pages'] = $cms['results'];
        $config['base_url'] = admin_url('countries/index');
        $config['num_links'] = 2;
        $config['uri_segment'] = 4;
        $config['total_rows'] = $cms['total'];
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
    

    function activate($id = false)
    {
        $redirect = isset($_GET['redirect_to']) ? $_GET['redirect_to'] : admin_url('countries');
        if ($id) {
            $c['id'] = $id;
            $c['status'] = 1;
            $this->Master_model->save($c,'country');
            $this->session->set_flashdata("success", "Country activated");
        }
        redirect($redirect);
    }
     function deactivate($id = false)
    {
        $redirect = isset($_GET['redirect_to']) ? $_GET['redirect_to'] : admin_url('countries');
        if ($id) {
            $c['id'] = $id;
            $c['status'] = 0;
            $this->Master_model->save($c,'country');
            $this->session->set_flashdata("success", "Country deactivated");
        }
        redirect($redirect);
    }

    function delete($id){
        if ($id > 0) {
            $this->Master_model->delete($id,'country');
            //echo $this->db->last_query();die;
            $this->session->set_flashdata('success', 'Country deleted successfully ');
        }
        redirect(admin_url('countries'));
    }
  
}

/* End of file city.php */
/* Location: ./application/controllers/admin/city.php */