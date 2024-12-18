<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Package extends AI_Controller {

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

    public function index($page=1)
    {
        if(isset($_GET['page'])){
            $page = $_GET['page'];
        }
        $show_per_page = 20;
        $offset = ($page - 1) * $show_per_page;
        $this->data['title'] = 'View Plan';
        $this->data['tab'] = 'pk';
        $this->data['main'] = admin_view('packages/index');
        $members = $this->Master_model->getAll($offset, $show_per_page,'package');
        $this->data['members'] = $members['results'];
        $config['base_url'] = admin_url('package/index');
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

    public function add($id=false)
    {
        $this->data['title'] = 'Add Plan';
        $this->data['tab'] = 'add_pk';
        $this->data['main'] = admin_view('packages/add');
        $this->data['member'] = $this->Master_model->getNew('package');
        if ($id) {
            $this->data['member'] = $pages = $this->Master_model->getRow($id,'package');
            if(!isset($pages)){
               redirect(site_url('404_override'));
               exit();
            }
        } 
        $this->form_validation->set_rules('frm[price]', 'Price', 'required');
        if ($this->form_validation->run()) {
            $formdata = $this->input->post('frm');
            
            $formdata['id'] = $id;
        
            $id = $this->Master_model->save($formdata,'package');
            $this->session->set_flashdata("success", "Package detail saved");
            redirect(admin_url('package'));
        }       
        $this->load->view(admin_view('default'),$this->data);
    }

    function activate($id = false)
    {
        $redirect = isset($_GET['redirect_to']) ? $_GET['redirect_to'] : admin_url('package');
        if ($id) {
            $c['id'] = $id;
            $c['status'] = 1;
            $this->User_model->save($c,'package');
            $this->session->set_flashdata("success", "Package activated successfully!");
        }
        redirect($redirect);
    }

    function deactivate($id = false)
    {
        $redirect = isset($_GET['redirect_to']) ? $_GET['redirect_to'] : admin_url('package');
        if ($id) {
            $c['id'] = $id;
            $c['status'] = 0;
            $this->User_model->save($c,'package');
            $this->session->set_flashdata("success", "Package deactivated successfully!");
        }
        redirect($redirect);
    }

    function delete($id){
        if ($id > 0) {
            $this->User_model->delete($id,'package');
            $this->session->set_flashdata('success', 'row deleted successfully ');
        }
        redirect(admin_url('package'));
    }

        public function feelist()
    {
        $this->data['title'] = 'View Registration Cost';
        $this->data['tab'] = 'rf';
        $this->data['main'] = admin_view('packages/fee_list');
        $this->data['fee'] = $this->db->get_where('reg_fee',array('status'=>1))->result();
        $this->load->view(admin_view('default'),$this->data);
    }

    public function feeupdate($id = false){
        $this->data['title'] = 'Add Plan';
        $this->data['tab'] = 'rf';
        $this->data['main'] = admin_view('packages/fee_upd');
        $this->data['member'] = $this->Master_model->getNew('reg_fee');
        if($id) {
            $this->data['member'] = $pages = $this->Master_model->getRow($id,'reg_fee');
            if(!isset($pages)){
               redirect(site_url('404_override'));
               exit();
            }
        } 
        $this->form_validation->set_rules('frm[price]', 'Price', 'required');
        if ($this->form_validation->run()) {
            $formdata = $this->input->post('frm');
            
            $formdata['id'] = $id;
        
            $id = $this->Master_model->save($formdata,'reg_fee');
            $this->session->set_flashdata("success", "Fee detail saved");
            redirect(admin_url('package/feelist'));
        }       
        $this->load->view(admin_view('default'),$this->data);
    }

}

/* End of file Members.php */
/* Location: ./application/controllers/admin/Members.php */