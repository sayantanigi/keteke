<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Directories extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->admin_login();
		$config['upload_path']          = './assets/images/directory';
		$config['allowed_types']        = 'gif|jpg|png';
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
        $this->data['title'] = 'Business Lists';
        $this->data['tab'] = 'dir_list_shop';
        $this->data['main'] = admin_view('directory/index');
        if($this->input->post('bulk_delete_submit')){
            $ids = $this->input->post('checked_id');
            if(!empty($ids)){
                $delete = $this->Pages_model->deleteMultiple($ids);
                if($delete){
                  $this->session->set_flashdata("success", "Selected Listings have been deleted successfully.");
                }else{
                  $this->session->set_flashdata("error", "Some problem occurred, please try again.");
                }
            }else{
              $this->session->set_flashdata("error", "Select at least 1 record to delete.");
            }
        }
        $cms = $this->Master_model->getAll($offset, $show_per_page,'listing');
       
        $this->data['pages'] = $cms['results'];
        $config['base_url'] = admin_url('directories/index');
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
    
    
    public function update($id=false)
        {
        $this->data['title'] = 'Update Listing';
        $this->data['tab'] = 'list_update';
        $this->data['main'] = admin_view('directory/edit');

        $this->data['pages'] = $this->Master_model->getNew('listing');
        $this->data['pages']->gender = "Male";
        if($id) {
            $this->data['pages'] = $pages = $this->Master_model->getRow($id,'listing');
            if(!isset($pages)){
               redirect(site_url('404_override'));
               exit();
            }
        }
        $this->form_validation->set_rules('frm[title]', 'Listing Title', 'required');
        //$this->form_validation->set_rules('frm[uploaded_by]', 'cms Author', 'required');
        if($this->form_validation->run()) {
        $formdata = $this->input->post('frm');
        $formdata['id'] = $id; 
        //print_r($formdata);die;
        $filename = array();
   
      $count = count(array_filter($_FILES['files']['name']));
      //echo $count;die;

     if($count == 0){
         $namesp= explode(',', $pages->images);
        //print_r($namesp);die;
        $formdata['images']= implode(',',$namesp);
        }else{
    
      for($i=0;$i<$count;$i++){
    
        if(!empty($_FILES['files']['name'][$i])){
    
          $_FILES['file']['name'] = $_FILES['files']['name'][$i];
          $_FILES['file']['type'] = $_FILES['files']['type'][$i];
          $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
          $_FILES['file']['error'] = $_FILES['files']['error'][$i];
          $_FILES['file']['size'] = $_FILES['files']['size'][$i];
  
         
          //$config['max_size'] = '5000';
          $config['file_name'] = $_FILES['files']['name'][$i];
   
          $this->load->library('upload',$config); 
    
          if($this->upload->do_upload('file')){
            $uploadData = $this->upload->data();
            $filename[] = $uploadData['file_name'];
          }
        }
    }
    $names= implode(',', $filename);
    $formdata['images'] = $names;
    }
    
    
    $id = $this->Master_model->save($formdata);
    $this->session->set_flashdata("success", "Listing Updated");
    redirect(admin_url('directories'));
    }               
    $this->load->view(admin_view('default'),$this->data);
    }
        function activate($id = false)
    {
        $redirect = isset($_GET['redirect_to']) ? $_GET['redirect_to'] : admin_url('directories');
        if ($id) {
            $c['id'] = $id;
            $c['status'] = 1;
            $this->Master_model->save($c,'listing');
            $this->session->set_flashdata("success", "Listing activated");
        }
        redirect($redirect);
    }

    function deactivate($id = false)
    {
        $redirect = isset($_GET['redirect_to']) ? $_GET['redirect_to'] : admin_url('directories');
        if ($id) {
            $c['id'] = $id;
            $c['status'] = 0;
            $this->Master_model->save($c,'listing');
            $this->session->set_flashdata("success", "Listing deactivated");
        }
        redirect($redirect);
    }
     function PreferActivate($id = false)
    {
        $redirect = isset($_GET['redirect_to']) ? $_GET['redirect_to'] : admin_url('directories');
        if ($id) {
            $c['prefer_list'] = 1;

            $this->db->update('listing',$c,array('id' =>$id));
            $this->session->set_flashdata("success", "Prefer listing activated..");
        }
        redirect($redirect);
    }
    function PreferDeactivate($id = false)
    {
        $redirect = isset($_GET['redirect_to']) ? $_GET['redirect_to'] : admin_url('directories');
        if ($id) {
            $c['prefer_list'] = 0;
             $this->db->update('listing',$c,array('id' =>$id));
            $this->session->set_flashdata("success", "Prefer listing deactivated..");
        }
        redirect($redirect);
    }
    function delete($id){
         if ($id > 0) {
            $this->Master_model->delete($id,'listing');
            $this->session->set_flashdata('success', 'row deleted ');
        }
        redirect(admin_url('directories'));
    }

     public function prefer_listing($page = 1)
    {   
        if(isset($_GET['page'])){
            $page = $_GET['page'];
        }
        $show_per_page = 5;
        $offset = ($page - 1) * $show_per_page;
        $this->data['title'] = 'Preferred Lists';
        $this->data['tab'] = 'pr_list_shop';
        $this->data['main'] = admin_view('directory/pr_listing');
        $cms = $this->Master_model->getAlllist($offset, $show_per_page,'payments');
        $this->data['pages'] = $cms['results'];
        $config['base_url'] = admin_url('directories/prefer_listing');
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
}
