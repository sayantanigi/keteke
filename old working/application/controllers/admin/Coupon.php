<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Coupon extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->data['header'] = '';
        $this->admin_login();
        $config['upload_path']          = './assets/images/coupons';
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
        $this->data['title'] = 'Coupon code List';
        $this->data['tab'] = 'coupons';
        $this->data['main'] = admin_view('coupon/index');
        $products = $this->Master_model->getAllcoupon($offset, $show_per_page,'coupon_details');
        $this->data['products'] = $products['results'];
        $config['base_url'] = admin_url('coupon/index');
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
        $this->data['title'] = 'Add coupon code';
        $this->data['tab'] = 'coupons';
		$this->data['main'] = admin_view('coupon/add');
		$this->data['product'] = $this->Product_model->getNew('coupon_details');
        $this->data['product']->gender = "Male";
        if ($id) {
            $this->data['product'] = $product = $this->Master_model->getRowCoupon($id,'coupon_details');
            if(!isset($product)){
               show_404();
                exit();
            }
        $this->form_validation->set_rules('frm[coupon_code]', 'Coupon code must be unique', 'required');
        }else{
           $this->form_validation->set_rules('frm[coupon_code]', 'Coupon code must be unique', 'required|is_unique[coupon_details.coupon_code]');
        }

		if ($this->form_validation->run() !=false) {
			$formdata = $this->input->post('frm');
			$formdata['coupon_id'] = $id;
            $formdata['created_date'] = date("Y-m-d", strtotime($formdata['created_date']));
            $formdata['expiry_date'] = date("Y-m-d", strtotime($formdata['expiry_date']));
            $formdata['created']=date("Y-m-d H:i:s");
            if ($this->upload->do_upload('image')) {
                $data = $this->upload->data();
                $formdata['coupon_img'] = $data['file_name'];
            }

			$id = $this->Master_model->savecoupon($formdata,'coupon_details');
            //echo $this->db->last_query(); die();
			$this->session->set_flashdata("success", "Coupon details saved");
            redirect(admin_url('coupon'));
		}else{
            $this->session->set_flashdata("error", "Coupon Code Must be Unique");
        }

		$this->load->view(admin_view('default'),$this->data);
	}

    function activate($id = false)
    {
        $redirect = isset($_GET['redirect_to']) ? $_GET['redirect_to'] : admin_url('coupon');
        if ($id) {
            $c['coupon_id'] = $id;
            $c['coupon_status'] = 1;
            $this->Product_model->savecoupon($c,'coupon_details');
            $this->session->set_flashdata("success", "Code activated");
        }
        redirect($redirect);
    }

    function deactivate($id = false)
    {
        $redirect = isset($_GET['redirect_to']) ? $_GET['redirect_to'] : admin_url('coupon');
        if ($id) {
            $c['coupon_id'] = $id;
            $c['coupon_status'] = 0;
            $this->Product_model->savecoupon($c,'coupon_details');
            $this->session->set_flashdata("success", "Code deactivated");
        }
        redirect($redirect);
    }

	function delete($id){
		if ($id > 0) {
            $this->Product_model->deletecoupon($id,'coupon_details');
            $this->session->set_flashdata('success', 'Coupon deleted successfully ');
        }
        redirect(admin_url('coupon'));
	}



}

/* End of file Products.php */
/* Location: ./application/controllers/admin/Products.php */