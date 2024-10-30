<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Listing extends AI_Controller {

	public function __construct()
	{
		parent::__construct();
        $this->load->model('Property_model');
        $this->load->library("pagination");
		//Do your magic here
	}


     public function index($page=1) {
         if(!isprologin()){
            redirect(site_url());
        }
        if(isprologin()){
            $user = userid2();
            $this->data['udetail'] = $this->db->get_where('users',array('id'=>$user))->row();
            //echo $this->db->last_query();die;
        }
        $this->data['title'] = 'Board and CareHomes USA | Listing';
        $this->data['load'] = 'listing1';
        $this->data['city'] = $this->db->get_where('cities',array('status'=>1))->result();
        if($this->input->post('zip')){
        $this->session->set_userdata('pzip',$this->input->post('zip'));
        $zip=$this->session->userdata('pzip');
        }else{
            //echo $zip;die;
            $zip=$this->session->userdata('szip');
        }
        $sql = "SELECT * FROM `home_list` WHERE (city = '$zip' OR zip = '$zip') AND status = 1";
        $this->data['checkh']=$checkh = $this->db->query($sql)->num_rows();
        //echo $this->db->last_query();die;
        $this->data['home_li']=$this->db->query($sql)->row();
        if(isset($_GET['page'])){
            $page = $_GET['page'];
        }
        $show_per_page = 10;
        $offset = ($page - 1) * $show_per_page;
        $home_list = $this->Property_model->getAllhome($offset, $show_per_page, $zip);
        $this->data['home_list'] = $home_list['results'];
        $config['base_url'] = site_url('listing');
        $config['num_links'] = 2;
        $config['uri_segment'] = 4;
        $config['total_rows'] = $home_list['total'];
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

        $this->load->front_view('default', $this->data);
    }
    public function listing_detl($id){
        if(!isprologin()){
            redirect(site_url());
        }
        $this->data['title'] = 'Board and CareHomes USA';
        $this->data['load'] = 'list_detail';
        $this->data['result'] = $this->db->get_where('home_list',array('id' =>$id))->row();
        //$this->data['result'] = $this->Property_model->getCms($slug);
        $this->load->front_view('default', $this->data);
    }
}
/* End of file Pages.php */
/* Location: ./application/controllers/Pages.php */