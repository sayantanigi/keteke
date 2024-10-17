<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Categories extends Admin_Controller {
    public function __construct() {
        parent::__construct();
        $this->admin_login();
        $this->data['title'] = '';
        $this->data['tab'] = '';
    }
    public function categoryIndex($page = 1) {
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        }
        $show_per_page = 10;
        $offset = ($page - 1) * $show_per_page;
        $this->data['title'] = 'Business Category List';
        $this->data['tab'] = 'mrktcat';
        $this->data['main'] = admin_view('category/homepagecategoryindex');
        $cms = $this->Master_model->getAll($offset, $show_per_page, 'category');
        $this->data['pages'] = $cms['results'];
        $this->load->view(admin_view('default'), $this->data);
    }
    public function category_add($id = false) {
        $this->data['title'] = 'Add/Edit Business Category';
        $this->data['tab'] = 'add_subcat';
        $this->data['main'] = admin_view('category/category_edit');
        $this->data['category'] = $this->db->get_where('category', array('status' => 1))->result();
        if ($id) {
            $this->data['pages'] = $pages = $this->Master_model->getRow($id, 'category');
            if (!isset($pages)) {
                redirect(site_url('404_override'));
                exit();
            }
        }
        $this->form_validation->set_rules('frm[name]', 'Category Name', 'required');
        if ($this->form_validation->run()) {
            $formdata = $this->input->post('frm');
            $formdata['id'] = $id;
            $checkduplicatecategory = $this->db->query("SELECT * FROM category WHERE name LIKE '%".$formdata['name']."%'")->result();
            if(!empty($checkduplicatecategory)) {
                $this->session->set_flashdata("error", "Category Name already Exist");
                redirect(admin_url('categories/category_add/'.$id));
            } else {
                $id = $this->Master_model->save($formdata, 'category');
                $this->session->set_flashdata("success", "Category data submitted successfully!");
                redirect(admin_url('categories/categoryIndex'));
            }
            /*$id = $this->Master_model->save($formdata, 'category');
            $this->session->set_flashdata("success", "Category updated");
            redirect(admin_url('categories/categoryIndex'));*/
        }
        $this->load->view(admin_view('default'), $this->data);
    }
    function categorydelete($id) {
        if ($id > 0) {
            $this->Master_model->delete($id, 'category');
            $this->session->set_flashdata('success', 'Category Deleted successfully ');
        }
        redirect(admin_url('categories/categoryIndex'));
    }
    public function add($id = false) {
        $this->data['title'] = 'Add Business Subcategory';
        $this->data['tab'] = 'add_subcat';
        $this->data['main'] = admin_view('category/add');
        $this->data['category'] = $this->db->get_where('category', array('status' => 1))->result();
        if ($id) {
            $this->data['pages'] = $pages = $this->Master_model->getRow($id, 'listing_category');
            if (!isset($pages)) {
                redirect(site_url('404_override'));
                exit();
            }
        }
        $this->form_validation->set_rules('frm[catid]', 'Category Name', 'required');
        $this->form_validation->set_rules('frm[name]', 'Sub-category Name', 'required');
        if ($this->form_validation->run()) {
            $formdata = $this->input->post('frm');
            $formdata['id'] = $id;
            $checkduplicatesubcategory = $this->db->query("SELECT * FROM listing_category WHERE name LIKE '%".$formdata['name']."%'")->result();
            if(!empty($checkduplicatesubcategory)) {
                $this->session->set_flashdata("error", "Subcategory Name already Exist");
                redirect(admin_url('categories/add/'.$id));
            } else {
                $id = $this->Master_model->save($formdata, 'listing_category');
                $this->session->set_flashdata("success", "Sub category data submitted successfully!");
                redirect(admin_url('categories/index'));
            }
            /*$id = $this->Master_model->save($formdata, 'listing_category');
            $this->session->set_flashdata("success", "Sub-category added");
            redirect(admin_url('categories/index'));*/
        }
        $this->load->view(admin_view('default'), $this->data);
    }
    public function index($page = 1) {
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        }
        $show_per_page = 10;
        $offset = ($page - 1) * $show_per_page;
        $this->data['title'] = 'Business Subcategory List';
        $this->data['tab'] = 'subcat';
        $this->data['main'] = admin_view('category/index');
        $cms = $this->Master_model->getAll($offset, $show_per_page, 'listing_category');
        $this->data['pages'] = $cms['results'];
        $config['base_url'] = admin_url('categories/index');
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
        $this->load->view(admin_view('default'), $this->data);
    }
    function category_activate($id = false) {
        $redirect = isset($_GET['redirect_to']) ? $_GET['redirect_to'] : admin_url('categories/categoryIndex');
        if ($id) {
            $c['id'] = $id;
            $c['status'] = 1;
            $this->Master_model->save($c, 'category');
            $this->session->set_flashdata("success", "Category activated");
        }
        redirect($redirect);
    }
    function category_deactivate($id = false) {
        $redirect = isset($_GET['redirect_to']) ? $_GET['redirect_to'] : admin_url('categories/categoryIndex');
        if ($id) {
            $c['id'] = $id;
            $c['status'] = 0;
            $this->Master_model->save($c, 'category');
            $this->session->set_flashdata("success", "Category deactivated");
        }
        redirect($redirect);
    }
    function activate($id = false) {
        $redirect = isset($_GET['redirect_to']) ? $_GET['redirect_to'] : admin_url('categories');
        if ($id) {
            $c['id'] = $id;
            $c['status'] = 1;
            $this->Master_model->save($c, 'listing_category');
            $this->session->set_flashdata("success", "Sub-category activated");
        }
        redirect($redirect);
    }
    function deactivate($id = false) {
        $redirect = isset($_GET['redirect_to']) ? $_GET['redirect_to'] : admin_url('categories');
        if ($id) {
            $c['id'] = $id;
            $c['status'] = 0;
            $this->Master_model->save($c, 'listing_category');
            $this->session->set_flashdata("success", "Sub-category deactivated");
        }
        redirect($redirect);
    }
    function delete($id) {
        if ($id > 0) {
            $this->Master_model->delete($id, 'listing_category');
            $this->session->set_flashdata('success', 'Sub category Deleted successfully ');
        }
        redirect(admin_url('categories'));
    }
    public function addMarketcategory($id = false) {
        $this->data['title'] = 'Add Marketplace Category';
        $this->data['tab'] = 'mrktcat';
        $this->data['main'] = admin_view('category/addmarket');
        if ($id) {
            $this->data['pages'] = $pages = $this->Master_model->getRow($id, 'mrkt_category');
            if (!isset($pages)) {
                redirect(site_url('404_override'));
                exit();
            }
        }
        $this->form_validation->set_rules('frm[name]', 'Market category Name', 'required');
        if ($this->form_validation->run()) {
            $formdata = $this->input->post('frm');
            $formdata['id'] = $id;
            $checkmarketcategory = $this->db->query("SELECT * FROM mrkt_category WHERE name LIKE '%".$formdata['name']."%'")->result();
            if(!empty($checkmarketcategory)) {
                $this->session->set_flashdata("error", "Marketplace category name already exist");
                redirect(admin_url('categories/addMarketcategory/'.$id));
            } else {
                $id = $this->Master_model->save($formdata, 'mrkt_category');
                $this->session->set_flashdata("success", "Marketplace category data submitted successfully!");
                redirect(admin_url('categories/MarketCategoryindex'));
            }
            /*$id = $this->Master_model->save($formdata, 'mrkt_category');
            $this->session->set_flashdata("success", "Category added");
            redirect(admin_url('categories/MarketCategoryindex'));*/
        }
        $this->load->view(admin_view('default'), $this->data);
    }
    public function MarketCategoryindex($page = 1) {
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        }
        $show_per_page = 10;
        $offset = ($page - 1) * $show_per_page;
        $this->data['title'] = 'Marketplace Category List';
        $this->data['tab'] = 'mrktcat';
        $this->data['main'] = admin_view('category/indexmarket');
        $cms = $this->Master_model->getAll($offset, $show_per_page, 'mrkt_category');
        $this->data['pages'] = $cms['results'];
        $this->load->view(admin_view('default'), $this->data);
    }
    function Marketcategoryactivate($id = false) {
        $redirect = isset($_GET['redirect_to']) ? $_GET['redirect_to'] : admin_url('categories/MarketCategoryindex');
        if ($id) {
            $c['id'] = $id;
            $c['status'] = 1;
            $this->Master_model->save($c, 'mrkt_category');
            $this->session->set_flashdata("success", "Category activated");
        }
        redirect($redirect);
    }
    function Marketcategorydeactivate($id = false) {
        $redirect = isset($_GET['redirect_to']) ? $_GET['redirect_to'] : admin_url('categories/MarketCategoryindex');
        if ($id) {
            $c['id'] = $id;
            $c['status'] = 0;
            $this->Master_model->save($c, 'mrkt_category');
            $this->session->set_flashdata("success", "Category deactivated");
        }
        redirect($redirect);
    }
    function MarketCategorydelete($id) {
        if ($id > 0) {
            $this->Master_model->delete($id, 'mrkt_category');
            $this->session->set_flashdata('success', 'Category Deleted successfully ');
        }
        redirect(admin_url('categories/MarketCategoryindex'));
    }
    public function addsubmenuMarketplace($id = false) {
        $this->data['title'] = 'Add Marketplace Category';
        $this->data['tab'] = 'mrktcat';
        $this->data['main'] = admin_view('category/addsubmenumrkt');
        $this->data['mrktcategory'] = $this->db->get_where('mrkt_category', array('status' => 1))->result();
        if ($id) {
            $this->data['pages'] = $pages = $this->Master_model->getsubmenuRow($id, 'marketplace_submenu');
            if (!isset($pages)) {
                redirect(site_url('404_override'));
                exit();
            }
        }
        $this->form_validation->set_rules('frm[name]', 'Marketplace Sub-menu Name', 'required');
        if ($this->form_validation->run()) {
            $formdata = $this->input->post('frm');
            //$formdata['submenuId'] = $id;
            $checkmarketsubcategory = $this->db->query("SELECT * FROM marketplace_submenu WHERE cat_id = '".$formdata['cat_id']."' AND name = '".$formdata['name']."'")->result();
            if(!empty($checkmarketsubcategory)) {
                $this->session->set_flashdata("error", "Marketplace subcategory name already exist");
                redirect(admin_url('categories/addsubmenuMarketplace/'.$id));
            } else {
                if($id) {
                    //$id = $this->Master_model->save($formdata, 'marketplace_submenu');
                    $this->db->where('submenuId', $id);
                    $this->db->update('marketplace_submenu', $formdata);
                    $this->session->set_flashdata("success", "Marketplace subcategory data submitted successfully!");
                    redirect(admin_url('categories/submenumarketplaceindex'));
                } else {
                    $id = $this->Master_model->save($formdata, 'marketplace_submenu');
                    $this->session->set_flashdata("success", "Marketplace subcategory data submitted successfully!");
                    redirect(admin_url('categories/submenumarketplaceindex'));
                }
            }
            /*$id = $this->Master_model->submenusave($formdata, 'marketplace_submenu');
            $this->session->set_flashdata("success", "Sub-menu saved");
            redirect(admin_url('categories/submenumarketplaceindex'));*/
        }
        $this->load->view(admin_view('default'), $this->data);
    }
    public function submenumarketplaceindex() {
        $this->data['title'] = 'Marketplace Sub Category List';
        $this->data['tab'] = 'mrktcat';
        $this->data['main'] = admin_view('category/indexmarketsubmenu');
        $this->data['pages'] = $this->db->get('marketplace_submenu')->result();
        $this->load->view(admin_view('default'), $this->data);
    }
    function submenuMrktactivate($id = false) {
        $redirect = isset($_GET['redirect_to']) ? $_GET['redirect_to'] : admin_url('categories/submenumarketplaceindex');
        if ($id) {
            $c['submenuId'] = $id;
            $c['status'] = 1;
            $this->Master_model->submenusave($c, 'marketplace_submenu');
            $this->session->set_flashdata("success", "Marketplace Sub Category activated");
        }
        redirect($redirect);
    }
    function submenuMrktdeactivate($id = false) {
        $redirect = isset($_GET['redirect_to']) ? $_GET['redirect_to'] : admin_url('categories/submenumarketplaceindex');
        if ($id) {
            $c['submenuId'] = $id;
            $c['status'] = 0;
            $this->Master_model->submenusave($c, 'marketplace_submenu');
            $this->session->set_flashdata("success", "Marketplace Sub Category deactivated");
        }
        redirect($redirect);
    }
    function submenumrktdelete($id) {
        if ($id > 0) {
            $this->db->delete('marketplace_submenu', array('submenuId' => $id));
            $this->session->set_flashdata('success', 'Marketplace Sub Category Deleted successfully ');
        }
        redirect(admin_url('categories/submenumarketplaceindex'));
    }
}