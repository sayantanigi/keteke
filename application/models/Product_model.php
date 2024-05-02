<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Product_model extends Master_Model {

	public function __construct()
	{
		parent::__construct();
		$this->table = 'products';
	}


    public function abadonedProducts($sellerId=false){
        $query=$this->db->query("SELECT * FROM products AS pr JOIN productorders AS pord ON pord.product_id=pr.productId WHERE pr.userid='$sellerId' AND pord.payment_status='0' AND pord.userid !='guest'");
        return $query->result();
    }
    public function getabandonedOrderDetails($productId=false){
        $query=$this->db->query("SELECT * FROM products AS pr JOIN productorders AS pord ON pord.product_id=pr.productId WHERE pr.productId='$productId' AND pord.payment_status='0' AND pord.userid !='guest'");
        return $query->row();
    }
    public function getAll_customers($sellerId=false)
    {
        $this->db->select('*');
        $this->db->from('user_accounts');
        $this->db->where('created_by', $sellerId);
        $this->db->where('user_status', '1');
        $query= $this->db->get();
        return $query->result();
    }
    public function getAllProducts($sellerId=false)
    {
        $this->db->select('*');
        $this->db->from('products');
        $this->db->where('status','1');
        $this->db->where('userid',$sellerId);
        $query= $this->db->get();
        return $query->result();   
    }
    public function getProducts()
    {
        $this->db->select('*');
        $this->db->from('products');
        $query= $this->db->get();
        return $query->result();   
    }
     public function getAlldraftProducts($sellerId=false)
    {
         $query=$this->db->query("SELECT * FROM draftorders_payment AS dfpt JOIN  draft_orders AS drft ON dfpt.id=drft.draftpayment_orderid JOIN products AS pr ON   drft.product_id=pr.productId WHERE drft.created_by='$sellerId'");
        return $query->result();
    }
     public function getAlldraftOrders($sellerId=false)
    {
        $this->db->select('*');
        $this->db->from('draftorders_payment');
        $this->db->where('payment_created_by',$sellerId);
        $query= $this->db->get();
        return $query->result();  
    }

    public function getAllResult($table,$key,$value){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($key,$value);
        $query= $this->db->get();
        return $query->result(); 
    }
    public function getAlluserdraftOrders($userid=false){
        $this->db->select('*');
        $this->db->from('draft_orders');
        $this->db->where('payment_status','1');
        $this->db->where('userid',$userid);
        $query= $this->db->get();
        return $query->result(); 
    }

    public function getSellerdraftOrderDetails($ordId=false){
        $query=$this->db->query("SELECT * FROM products AS pr JOIN draft_orders AS drford ON drford.product_id=pr.productId WHERE drford.draftpayment_orderid='$ordId' AND drford.payment_status='1'");
        return $query->result();
    }


}

/* End of file Gallery_model.php */
/* Location: ./application/models/Gallery_model.php */