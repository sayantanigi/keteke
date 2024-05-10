<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->data['header'] = '';
        $this->admin_login();
        $this->load->model('Master_model'); 

    }

    public function index($page=1)
    {
      if(isset($_GET['page'])){
        $page = $_GET['page'];
    }

    $this->data['title'] = 'Product List';
    $this->data['tab'] = 'products';
    $this->data['main'] = admin_view('product/index');
    $this->data['products']= $this->Product_model->getProducts();
    $this->load->view(admin_view('default'),$this->data);
}

public function add()
{
    $this->data['title'] = 'Add a product';
    $this->data['tab'] = 'products';
    $this->data['main'] = admin_view('product/add');
    $this->data['mcategoty'] = $this->db->get_where('mrkt_category',array('status'=>1))->result();

    $this->form_validation->set_rules('frm[productName]', 'Product Name', 'required');
    $this->form_validation->set_rules('frm[prcode]', 'Product Code', 'required');
    $this->form_validation->set_rules('frm[maxPrice]', 'Max Price', 'required');
    $this->form_validation->set_rules('frm[offprice]', 'Offer Price', 'required');
    if($this->form_validation->run() === TRUE) {
        $frm = $this->input->post('frm');
        $frm['userid'] =0;
        $frm['status']=1;
        $frm['created']=date("Y-m-d h:i:s");
        $slug = $formdata['title'];
        if (empty($slug) || $slug == '') {
            $slug = $frm['productName'];
        }
        $slug = strtolower(url_title($slug));
        $frm['slug'] = $this->Cms_model->get_unique_url($slug, $id);
        $res = $this->db->insert('products',$frm);

         $productId = $this->db->insert_id();
         $frm['prcode'] ='promocode'.rand(1111,9999).$productId;
         $frm['sku'] ='sku'.rand(1111,9999).$productId;
        $this->db->update('products',$frm,array('productId'=>$productId));
        if(!empty($_FILES['files']['name']) && count(array_filter($_FILES['files']['name'])) > 0){ 
            $filesCount = count($_FILES['files']['name']); 
            for($i = 0; $i < $filesCount; $i++){ 
                $_FILES['file']['name']     = $_FILES['files']['name'][$i]; 
                $_FILES['file']['type']     = $_FILES['files']['type'][$i]; 
                $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i]; 
                $_FILES['file']['error']     = $_FILES['files']['error'][$i]; 
                $_FILES['file']['size']     = $_FILES['files']['size'][$i]; 

                    // File upload configuration 
                $uploadPath = './assets/images/products/';  
                $config['upload_path'] = $uploadPath; 
                $config['allowed_types'] = 'jpg|jpeg|png|gif'; 
                $this->load->library('upload', $config); 
                $this->upload->initialize($config);
                if($this->upload->do_upload('file')){ 
                    $fileData = $this->upload->data(); 
                    $uploadData[$i]['productImage'] = $fileData['file_name']; 
                    $uploadData[$i]['productId'] = $productId; 
                }
            } 
            $insert = $this->db->insert_batch('product_images',$uploadData); 
            if(!empty($uploadData)){ 
              $this->session->set_flashdata('success', 'Product Submitted successfully!');
              redirect(admin_url('products/add/' . $id));
          }
          else{
           $this->session->set_flashdata('error', 'Some error has occured');
           redirect(admin_url('products/add/' . $id));
       }
   }
}
$this->load->view(admin_view('default'),$this->data);		

}

public function editproduct($prodId=false) {

    $this->data['title'] = 'Add a product';
    $this->data['tab'] = 'products';
    $this->data['main'] = admin_view('product/edit');

    $this->data['mcategoty'] = $this->db->get_where('mrkt_category',array('status'=>1))->result();
    $this->data['title'] = 'Keteke | Marketplace';
    $this->data['load'] = 'marketplace/seller_edit_product';
    $this->data['product'] = $this->db->get_where('products',array('status'=>1,'productId'=>$prodId))->row();
    $this->data['mindprdctimg'] = $this->db->get_where('product_images',array('productId'=>$prodId))->result();
    $this->form_validation->set_rules('frm[productName]', 'Product Name', 'required');
    $this->form_validation->set_rules('frm[prcode]', 'Product Code', 'required');
    $this->form_validation->set_rules('frm[maxPrice]', 'Max Price', 'required');
    $this->form_validation->set_rules('frm[offprice]', 'Offer Price', 'required');
    $this->form_validation->set_rules('frm[sku]', 'SKU', 'trim|required|is_unique[products.sku]');

    if($this->form_validation->run() === TRUE) {
      // echo "hello"; exit;
        $frm = $this->input->post('frm');
       
        $frm['userid'] =0;
        $frm['status']=1;
        $frm['modified']=date("Y-m-d h:i:s");
        $slug = $frm['productName'];
        if (empty($slug) || $slug == '') {
            $slug = $frm['productName'];
        }
        $slug = strtolower(url_title($slug));
        $frm['slug'] = $this->Cms_model->get_unique_url($slug, $prodId);
       
        $res = $this->db->update('products',$frm,array('productId'=>$prodId));

        if(!empty($_FILES['files']['name']) && count(array_filter($_FILES['files']['name'])) > 0){ 
            $filesCount = count($_FILES['files']['name']); 

            for($i = 0; $i < $filesCount; $i++){ 
                $_FILES['file']['name']     = $_FILES['files']['name'][$i]; 
                $_FILES['file']['type']     = $_FILES['files']['type'][$i]; 
                $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i]; 
                $_FILES['file']['error']     = $_FILES['files']['error'][$i]; 
                $_FILES['file']['size']     = $_FILES['files']['size'][$i]; 

                    // File upload configuration 
                $uploadPath = './assets/images/products/';  
                $config['upload_path'] = $uploadPath; 
                $config['allowed_types'] = 'jpg|jpeg|png|gif'; 
                $this->load->library('upload', $config); 
                $this->upload->initialize($config);
                if($this->upload->do_upload('file')){ 
                    $fileData = $this->upload->data(); 
                    $uploadData[$i]['productImage'] = $fileData['file_name']; 
                    $uploadData[$i]['productId'] = $prodId; 
                }
            } 
            $insert = $this->db->insert_batch('product_images',$uploadData); 
        }
        if(!empty($res) || !empty($insert)){ 
            
          $this->session->set_flashdata('success', 'Product details updated successfully!');
          redirect(admin_url('products'));
      }
  
      else{
      
       $this->session->set_flashdata('error', 'Some error has occured');
       redirect(admin_url('products/editproduct/'.$prodId));
   }
}

$this->load->view(admin_view('default'),$this->data);
}
function delete_productImg($prdimgid,$prodid){
    if($prdimgid > 0) {
        $this->db->delete('product_images',array('productImageId' => $prdimgid));
        $this->session->set_flashdata('error', 'Product Image Deleted successfully ');
    }
    redirect(admin_url('products/editproduct/'.$prodid));
}

function activate($id = false)
{
    $redirect = isset($_GET['redirect_to']) ? $_GET['redirect_to'] : admin_url('products');
    if ($id) {
        $c['status'] = 1;
        $this->db->update('products',$c,array('productId' =>$id));
        $this->session->set_flashdata("success", "Product activated");
    }
    redirect($redirect);
}

function deactivate($id = false)
{
    $redirect = isset($_GET['redirect_to']) ? $_GET['redirect_to'] : admin_url('products');
    if ($id) {
        $c['status'] = 0;
        $this->db->update('products',$c,array('productId' =>$id));
        $this->session->set_flashdata("success", "Product deactivated");
    }
    redirect($redirect);
}

function delete($id){
  if ($id > 0) {
    $this->db->delete('products',array('productId'=>$id));
    $this->session->set_flashdata('success', 'Product deleted successfully.. ');
}
redirect(admin_url('products'));
}
function PreferActivate($id = false)
{
    $redirect = isset($_GET['redirect_to']) ? $_GET['redirect_to'] : admin_url('products');
    if ($id) {
        $c['prefer_list'] = 1;

        $this->db->update('products',$c,array('productId' =>$id));
        $this->session->set_flashdata("success", "Prefer Product activated..");
    }
    redirect($redirect);
}
function PreferDeactivate($id = false)
{
    $redirect = isset($_GET['redirect_to']) ? $_GET['redirect_to'] : admin_url('products');
    if ($id) {
        $c['prefer_list'] = 0;
        $this->db->update('products',$c,array('productId' =>$id));
        $this->session->set_flashdata("success", "Prefer Product deactivated..");
    }
    redirect($redirect);
}
public function transactions(){

    $this->data['title'] = 'Transaction List';
    $this->data['tab'] = 'trans';
    $this->data['main'] = admin_view('product/txn');
    $products = $this->Master_model->getAlllist('payments');
    $this->data['trans'] = $products['results'];
    $this->load->view(admin_view('default'),$this->data);
}
public function orders($orderId=false)
{
    $this->data['title'] = 'Order Details';
    $this->data['tab'] = 'trans';
    $this->data['main'] = admin_view('product/order_index');
    $this->data['ordrs'] = $this->db->query("SELECT * FROM products AS pd JOIN productorders AS prod ON prod.product_id=pd.productId WHERE prod.orderid='".$orderId."'")->result();
    $this->data['payInfo'] =$this->db->get_where('payments',array('order_id'=>$orderId))->row();

    $this->load->view(admin_view('default'),$this->data);

}
public function DraftOrdertransactions(){

    $this->data['title'] = 'Draft Order Transaction List';
    $this->data['tab'] = 'trans';
    $this->data['main'] = admin_view('product/draft_txn');
    $products = $this->Master_model->getAlllist('draftorders_payment');
    $this->data['trans'] = $products['results'];
    $this->load->view(admin_view('default'),$this->data);
}
public function draftordersview($orderId=false)
{
    $this->data['title'] = 'Draft Order Details';
    $this->data['tab'] = 'trans';
    $this->data['main'] = admin_view('product/draftorder_index');
    $this->data['ordrs'] = $this->db->query("SELECT * FROM products AS pd JOIN draft_orders AS drfod ON drfod.product_id=pd.productId WHERE drfod.draftpayment_orderid='".$orderId."'")->result();
    $this->data['payInfo'] =$this->db->get_where('draftorders_payment',array('id'=>$orderId))->row();

    $this->load->view(admin_view('default'),$this->data);

}

}

/* End of file Products.php */
/* Location: ./application/controllers/admin/Products.php */