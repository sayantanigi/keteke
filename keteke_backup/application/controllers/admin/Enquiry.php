<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Enquiry extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->admin_login();
        $this->data['title'] = '';
        $this->data['tab'] = '';
	}

	public function index($page=1)
	{

		if(isset($_GET['page'])){
			$page = $_GET['page'];
		}
		$show_per_page = 20;
        $offset = ($page - 1) * $show_per_page;
        $this->data['title'] = 'Enquiry Lists';
        $this->data['tab'] = 'enquiry_f';
        $this->data['main'] = admin_view('enquiry/index');
        $contact = $this->Master_model->getAll($offset, $show_per_page,'enquiry');
        $this->data['enquiry'] = $contact['results'];
        $config['base_url'] = admin_url('enquiry/index');
        $config['num_links'] = 2;
        $config['uri_segment'] = 4;
        $config['total_rows'] = $contact['total'];
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
        function delete($id){
                if ($id > 0) {
            $this->User_model->delete($id,'enquiry');
            $this->session->set_flashdata('success', 'row deleted successfully.');
        }
        redirect(admin_url('enquiry'));
        }



public function review_list($page=1)
    {
 //echo 'hiii';die();
        if(isset($_GET['page'])){
            $page = $_GET['page'];
        }
        $show_per_page = 20;
        $offset = ($page - 1) * $show_per_page;
        $this->data['title'] = 'Review Lists';
        $this->data['tab'] = 'rev_f';
        $this->data['main'] = admin_view('enquiry/review_form');
        $enquiry = $this->Master_model->getAll($offset, $show_per_page,'review');
        $this->data['enquiry'] = $enquiry['results'];
        $config['base_url'] = admin_url('enquiry/review_list');
        $config['num_links'] = 2;
        $config['uri_segment'] = 4;
        $config['total_rows'] = $enquiry['total'];
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

     function review_delete($id){
        if($id > 0) {
            $this->User_model->delete($id,'review');
            $this->session->set_flashdata('success', 'row deleted successfully.');
        }
        redirect(admin_url('enquiry/review_list'));
        }

         function activate($id = false)
    {
        $redirect = isset($_GET['redirect_to']) ? $_GET['redirect_to'] : admin_url('enquiry/review_list');
        if ($id) {
            $c['id'] = $id;
            $c['status'] = 1;
            $this->User_model->save($c,'review');
            $this->session->set_flashdata("success", "Review activated");
        }
        redirect($redirect);
    }

    function deactivate($id = false)
    {
        $redirect = isset($_GET['redirect_to']) ? $_GET['redirect_to'] : admin_url('enquiry/review_list');
        if ($id) {
            $c['id'] = $id;
            $c['status'] = 0;
            $this->User_model->save($c,'review');
            $this->session->set_flashdata("success", "Review deactivated");
        }
        redirect($redirect);
    }

        
    public function newsemail_list($page=1)
    {
 //echo 'hiii';die();
        if(isset($_GET['page'])){
            $page = $_GET['page'];
        }
        $show_per_page = 20;
        $offset = ($page - 1) * $show_per_page;
        $this->data['title'] = 'Newsletter Lists';
        $this->data['tab'] = 'news_f';
        $this->data['main'] = admin_view('enquiry/newsletter_form');
        $enquiry = $this->Master_model->getAll($offset, $show_per_page,'newsletter');
        $this->data['enquiry'] = $enquiry['results'];
        $config['base_url'] = admin_url('contacts/newsemail_list');
        $config['num_links'] = 2;
        $config['uri_segment'] = 4;
        $config['total_rows'] = $enquiry['total'];
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

     function newsletter_delete($id){
                if ($id > 0) {
            $this->User_model->delete($id,'newsletter');
            $this->session->set_flashdata('success', 'row deleted successfully.');
        }
        redirect(admin_url('enquiry/newsemail_list'));
        }

}

/* End of file Contacts.php */
/* Location: ./application/controllers/admin/Contacts.php */