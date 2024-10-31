<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class City extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->admin_login();
        $this->data['title'] = '';
        $this->data['tab'] = '';
	}

	public function index($page = 1)
	{	
		if(isset($_GET['page'])){
			$page = $_GET['page'];
		}
		$show_per_page = 10;
        $offset = ($page - 1) * $show_per_page;
        $this->data['title'] = 'Cities';
        $this->data['tab'] = 'city';
        $this->data['main'] = admin_view('city/index');
        $cms = $this->Master_model->getAll($offset, $show_per_page,'cities');
        $this->data['pages'] = $cms['results'];
        $config['base_url'] = admin_url('city/index');
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
        $this->data['title'] = 'Add City';
        $this->data['tab'] = 'add_city';
		$this->data['main'] = admin_view('city/add');
        $this->data['city'] = $this->db->get_where('cities',array('status'=>1))->result();
		$this->data['pages'] = $this->Master_model->getNew('cities');
        $this->data['pages']->gender = "Male";
        if ($id) {
            $this->data['pages'] = $pages = $this->Master_model->getRow($id,'cities');
            if(!isset($pages)){
               redirect(site_url('404_override'));
               exit();
            }
        }
		$this->form_validation->set_rules('frm[name]', 'City Name', 'required');
		//$this->form_validation->set_rules('frm[uploaded_by]', 'cms Author', 'required');
		if ($this->form_validation->run()) {
			$formdata = $this->input->post('frm');
			$formdata['id'] = $id;            

			// if ($this->upload->do_upload('image'))
			// {
			// 	$data = $this->upload->data();
			// 	$formdata['image'] = $data['file_name'];
			// }
			
			$id = $this->Master_model->save($formdata);
			$this->session->set_flashdata("success", "City added");
            redirect(admin_url('city'));
		}		
		$this->load->view(admin_view('default'),$this->data);
	}

	function activate($id = false)
    {
        $redirect = isset($_GET['redirect_to']) ? $_GET['redirect_to'] : admin_url('city');
        if ($id) {
            $c['id'] = $id;
            $c['status'] = 1;
            $this->Master_model->save($c,'cities');
            $this->session->set_flashdata("success", "City activated");
        }
        redirect($redirect);
    }
     function deactivate($id = false)
    {
        $redirect = isset($_GET['redirect_to']) ? $_GET['redirect_to'] : admin_url('city');
        if ($id) {
            $c['id'] = $id;
            $c['status'] = 0;
            $this->Master_model->save($c,'cities');
            $this->session->set_flashdata("success", "City deactivated");
        }
        redirect($redirect);
    }

    function delete($id){
        if ($id > 0) {
            $this->Master_model->delete($id,'cities');
            $this->session->set_flashdata('success', 'City Deleted successfully ');
        }
        redirect(admin_url('city'));
    }

    public function upload_file(){
        $this->data['tab'] = 'add_city';
        $this->data['main'] = admin_view('city/add');
        $csvMimes = array('application/vnd.ms-excel','text/plain','text/csv','text/tsv');
        if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'],$csvMimes)){
            if(is_uploaded_file($_FILES['file']['tmp_name'])){
                
                //open uploaded csv file with read only mode
                $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
                
                // skip first line
                // if your csv file have no heading, just comment the next line
                fgetcsv($csvFile);
                
                //parse data from csv file line by line
                while(($line = fgetcsv($csvFile)) !== FALSE){
                    //check whether member already exists in database with same email
                    $result = $this->db->get_where("cities", array("id"=>$line[0]))->result();

                    if(count($result) > 0){
                        //update member data
                        $this->db->update("cities", array("name"=>$line[1], "state"=>$line[2], "zip"=>$line[3], "status"=>$line[4]), array("id"=>$line[0]));
                    }else{
                        //insert member data into database
                        $this->db->insert("cities", array("id"=>$line[0], "name"=>$line[1], "state"=>$line[2], "zip"=>$line[3], "status"=>$line[4]));
                        //echo $this->db->last_query();
                   }
                }
                
                //close opened csv file
                fclose($csvFile);

                $this->data["status"] = 'Success';
            }else{
                $this->data["status"] = 'Error';
            }
        }else{
            $this->data["status"] = 'Invalid file';
        }
        $this->load->view(admin_view('default'),$this->data);
    }

}

/* End of file city.php */
/* Location: ./application/controllers/admin/city.php */