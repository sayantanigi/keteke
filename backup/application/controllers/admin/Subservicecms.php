<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subservicecms extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->admin_login();
		$config['upload_path']          = './assets/images/service';
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']             = 1024;
		$config['max_width']            = 1024;
		$config['max_height']           = 768;
		$this->load->library('upload', $config);
        $this->data['title'] = '';
        $this->data['tab'] = '';
	}

	public function index($page = 1)
	{	
		if(isset($_GET['page'])){
			$page = $_GET['page'];
		}
		$show_per_page = 20;
        $offset = ($page - 1) * $show_per_page;
        $this->data['title'] = 'Subservice CMS';
        $this->data['tab'] = 'subcms';
        $this->data['main'] = admin_view('subservicecms/index');
        $cms = $this->Master_model->getAll($offset, $show_per_page,'subservicecms');
        $this->data['pages'] = $cms['results'];
        $config['base_url'] = admin_url('subservicecms/index');
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

	public function add($id=false)
	{
        $this->data['title'] = 'Add Subservice CMS';
        $this->data['tab'] = 'add_subcms';
		$this->data['main'] = admin_view('subservicecms/add');
        $this->data['subservice'] = $this->db->get_where('subservice',array('status'=>1))->result();
		$this->data['pages'] = $this->Master_model->getNew('subservicecms');
        $this->data['pages']->gender = "Male";
        if ($id) {
            $this->data['pages'] = $pages = $this->Master_model->getRow($id,'subservicecms');
            if(!isset($pages)){
               redirect(site_url('404_override'));
               exit();
            }
        }
		$this->form_validation->set_rules('frm[title]', 'Service Title', 'required');
		//$this->form_validation->set_rules('frm[uploaded_by]', 'cms Author', 'required');
		if ($this->form_validation->run()) {
			$formdata = $this->input->post('frm');
			$formdata['id'] = $id;            

			 $slug = $formdata['title'];
            if (empty($slug) || $slug == '') {
                $slug = $formdata['title'];
            }
            $slug = strtolower(url_title($slug));
            $formdata['slug'] = $this->Service_model->get_unique_url($slug, $id);
            //$images = $this->input->post('image');
            if ($this->upload->do_upload('image')) 
            {
                $data = $this->upload->data();
                $formdata['image'] = $data['file_name'];
            }
			
			$id = $this->Master_model->save($formdata);
			$this->session->set_flashdata("success", "Sub Service CMS added");
            redirect(admin_url('subservicecms/add/' . $id));
		}		
		$this->load->view(admin_view('default'),$this->data);
	}

	function activate($id = false)
    {
        $redirect = isset($_GET['redirect_to']) ? $_GET['redirect_to'] : admin_url('subservicecms');
        if ($id) {
            $c['id'] = $id;
            $c['status'] = 1;
            $this->Master_model->save($c,'subservicecms');
            $this->session->set_flashdata("success", "CMS Pages activated");
        }
        redirect($redirect);
    }

    function deactivate($id = false)
    {
        $redirect = isset($_GET['redirect_to']) ? $_GET['redirect_to'] : admin_url('subservicecms');
        if ($id) {
            $c['id'] = $id;
            $c['status'] = 0;
            $this->Master_model->save($c,'subservicecms');
            $this->session->set_flashdata("success", "CMS Pages deactivated");
        }
        redirect($redirect);
    }

	function delete($id){
		if ($id > 0) {
            $this->Master_model->delete($id,'subservicecms');
            $this->session->set_flashdata('success', 'CMS deleted successfully ');
        }
        redirect(admin_url('subservicecms'));
	}
    public function imgview($page = 1)
    {   
        if(isset($_GET['page'])){
            $page = $_GET['page'];
        }
        $show_per_page = 20;
        $offset = ($page - 1) * $show_per_page;
        $this->data['title'] = 'Subservice CMS';
        $this->data['tab'] = 'subcmsimg';
        $this->data['main'] = admin_view('subservicecms/image_view');
        $cms = $this->Master_model->getAll($offset, $show_per_page,'servicecmsimg');
        $this->data['pages'] = $cms['results'];
        $config['base_url'] = admin_url('subservicecms/imgview');
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

    public function imgadd($id=false)
    {
        $this->data['title'] = 'Add Subservice CMS';
        $this->data['tab'] = 'add_subcms_img';
        $this->data['main'] = admin_view('subservicecms/imageadd');
        $this->data['subservice'] = $this->db->get_where('subservicecms',array('status'=>1))->result();
        $this->data['pages'] = $this->Master_model->getNew('servicecmsimg');
        $this->data['pages']->gender = "Male";
        if ($id) {
            $this->data['pages'] = $pages = $this->Master_model->getRow($id,'servicecmsimg');
            if(!isset($pages)){
               redirect(site_url('404_override'));
               exit();
            }
        }
        $this->form_validation->set_rules('frm[name]', 'Image Name', 'required');
        //$this->form_validation->set_rules('frm[uploaded_by]', 'cms Author', 'required');
        if ($this->form_validation->run()) {
            $formdata = $this->input->post('frm');
            $formdata['id'] = $id;
             $formdata['status'] = 1;
          
            if ($this->upload->do_upload('image')) 
            {
                $data = $this->upload->data();
                $formdata['image'] = $data['file_name'];
            }
            
            $id = $this->Master_model->save($formdata);
            $this->session->set_flashdata("success", "subservice image added");
            redirect(admin_url('subservicecms/imgadd/' . $id));
        }       
        $this->load->view(admin_view('default'),$this->data);
    }
    function imgdelete($id){
        if ($id > 0) {
            $this->Master_model->delete($id,'servicecmsimg');
            $this->session->set_flashdata('success', 'Image deleted successfully ');
        }
        redirect(admin_url('subservicecms/imgview'));
    }

}

/* End of file Subservice.php */
/* Location: ./application/controllers/admin/Subservice.php */