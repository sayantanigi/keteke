<?php

class Master_model extends CI_Model
{
    var $table;

    function __construct()
    {
        parent::__construct();
    }

    function getNew($table = false)
    {
        if ($table) {
            $this->table = $table;
        }
        $f = $this->db->list_fields($this->table);
        $temp = new stdClass();
        $temp->id = false;
        foreach ($f as $fields) {
            $temp->$fields = '';
        }
        return $temp;
    }
 function getUserDetails(){
        $response = array();
        $this->db->select('*');
        $q = $this->db->get('listing');
        $response = $q->result_array();
        return $response;
    }
    function getRow($id, $table = false)
    {
        if ($table) {
            $this->table = $table;
        }
        return $this->db->get_where($this->table, array('id' => $id))->first_row();
    }
     function getuserRow($id, $table = false)
    {
        if ($table) {
            $this->table = $table;
        }
        return $this->db->get_where($this->table, array('user_id' => $id))->first_row();
    }
     function getsubmenuRow($id, $table = false)
    {
        if ($table) {
            $this->table = $table;
        }
        return $this->db->get_where($this->table, array('submenuId' => $id))->first_row();
    }
    function getSingleRow($column,$value, $table = false)
    {
        if ($table) {
            $this->table = $table;
        }
        return $this->db->get_where($this->table, array($column => $value))->first_row();
    }
    function getRowCoupon($id, $table = false)
    {
        if ($table) {
            $this->table = $table;
        }
        return $this->db->get_where($this->table, array('coupon_id' => $id))->first_row();
    }
    function getAllMember($offset = 0, $limit = 40, $table = false)
    {
        if ($table) {
            $this->table = $table;
        }
        $this->db->order_by('id', 'DESC');
        $this->db->limit($limit, $offset);
        $rest = $this->db->get($this->table);
        $data['results'] = $rest->result();
        $data['total'] = $this->db->get_where($this->table)->num_rows();
        return $data;
    }
    function getAlluser($offset = 0, $limit = 40, $table = false)
    {
        if ($table) {
            $this->table = $table;
        }
        $this->db->order_by('id', 'DESC');
        $this->db->limit($limit, $offset);
        $this->db->where('u_type', 'user');
        $rest = $this->db->get($this->table);
        $data['results'] = $rest->result();
        $data['total'] = $this->db->get_where($this->table,array('u_type' =>'user'))->num_rows();
        return $data;
    }
    function getAll($offset = 0, $limit = 40, $table = false)
    {
        if ($table) {
            $this->table = $table;
        }
        $this->db->order_by('id', 'DESC');
        $this->db->limit($limit, $offset);
        $rest = $this->db->get($this->table);
        $data['results'] = $rest->result();
        $data['total'] = $this->db->get($this->table)->num_rows();
        return $data;
    }
     function getAllusers()
    {
        $query=$this->db->query("SELECT * FROM user_accounts");
        return $query->result();
    }
    function getAllcoupon($offset = 0, $limit = 40, $table = false)
    {
        if ($table) {
            $this->table = $table;
        }
        $this->db->order_by('coupon_id', 'DESC');
        $this->db->limit($limit, $offset);
        $rest = $this->db->get($this->table);
        $data['results'] = $rest->result();
         //echo $this->db->last_query();die;
        $data['total'] = $this->db->get($this->table)->num_rows();
        return $data;
    }

    function getAllrvw($offset = 0, $limit = 40, $table = false,$id=false)
    {
        if ($table) {
            $this->table = $table;
        }
        $this->db->order_by('id','DESC');
        $this->db->limit($limit, $offset);
        $this->db->where('status', 1);
        $this->db->where('list_id',$id);
        $rest = $this->db->get($this->table);
        $data['results'] = $rest->result();
        //echo $this->db->last_query();die;

        $this->db->where('status', 1);
        $this->db->where('list_id',$id);
        $data['total'] = $this->db->get($this->table)->num_rows();
        //echo $this->db->last_query();die;
        return $data;
    }
    function getAllsearchdata($offset = 0, $limit = 40, $table = false,$search_keuword = false)
    {
        if ($table) {
            $this->table = $table;
        }

        $ser= "id!=''".$search_keuword;
        $this->db->limit($limit, $offset);
        $this->db->where($ser);
        $this->db->where('status', 1);
        $rest = $this->db->get($this->table);
        $data['results'] = $rest->result();

        $this->db->where($ser);
        $this->db->where('status', 1);
        $data['total'] = $this->db->get($this->table)->num_rows();
        return $data;
    }
function getAlllist($table = false)
    {
        if ($table) {
            $this->table = $table;
        }
        $this->db->order_by('id', 'DESC');
        $this->db->where('payment_status', 'succeeded');
        $rest = $this->db->get($this->table);
        $data['results'] = $rest->result();
        $data['total'] = $this->db->get($this->table,array('payment_status'=>'succeeded'))->num_rows();
        return $data;
    }
    function pendinggetAll($offset = 0, $limit = 40, $table = false)
    {
        if ($table) {
            $this->table = $table;
        }
        $this->db->order_by('id', 'DESC');
        $this->db->limit($limit, $offset);
        $this->db->where('status',0);
        $rest = $this->db->get($this->table);
        $data['results'] = $rest->result();
        $data['total'] = $this->db->get_where($this->table,array('status'=>0))->num_rows();
        return $data;
    }

    function completedgetAll($offset = 0, $limit = 40, $table = false)
    {
        if ($table) {
            $this->table = $table;
        }
        $this->db->order_by('id', 'DESC');
        $this->db->limit($limit, $offset);
        $this->db->where('status',1);
        $rest = $this->db->get($this->table);
        $data['results'] = $rest->result();
        $data['total'] = $this->db->get($this->table,array('status'=>0))->num_rows();
        return $data;
    }

    function getAllSearched($offset = 0, $limit = 40, $likes = array(), $table = false)
    {
        if ($table) {
            $this->table = $table;
        }
        if (count($likes) > 0) {
            foreach ($likes as $key => $val) {
                $this->db->or_like($key, $val);
            }
        }
        $this->db->order_by('title', 'ASC');
        $sql = $this->db->get_compiled_select($this->table, false);
        $this->db->limit($limit, $offset);
        $rest = $this->db->get();
        $data['results'] = $rest->result();
        $data['total'] = $this->db->query($sql)->num_rows();

        return $data;
    }

    function getWhereRecords($limit = 40, $offset = 0, $rules = array(), $table = false)
    {
        $this->db->order_by('id', 'DESC');
        if ($table) {
            $this->table = $table;
        }
        if (is_array($rules) && count($rules) > 0) {
            foreach ($rules as $key => $value) {
                $this->db->or_where($key, $value);
            }
        }
        $sql = $this->db->get_compiled_select($this->table, false);
        $this->db->limit($limit, $offset);
        $rest = $this->db->get();
        $data['results'] = $rest->result();
        $data['total'] = $this->db->query($sql)->num_rows();
        return $data;
    }

    function listAll($table = false)
    {
        if ($table) {
            $this->table = $table;
        }
        $rest = $this->db->get($this->table);
        return $rest->result();
    }

    function listAllByDesc($table = false)
    {
        if ($table) {
            $this->table = $table;
        }
        $this->db->order_by('id', 'DESC');
        $rest = $this->db->get($this->table);
        return $rest->result();
    }

    function save($data, $table = false)
    {
        if ($table) {
            $this->table = $table;
        }
        if ($data['id']) {
            $this->db->update($this->table, $data, array('id' => $data['id']));
            return $data['id'];
        } else {
            $this->db->insert($this->table, $data);
            return $this->db->insert_id();
        }
    }
    function submenusave($data, $table = false)
    {
        if ($table) {
            $this->table = $table;
        }
        if ($data['submenuId']) {
            $this->db->update($this->table, $data, array('submenuId' => $data['submenuId']));
            return $data['submenuId'];
        } else {
            $this->db->insert($this->table, $data);
            return $this->db->insert_id();
        }
    }
    function savecoupon($data, $table = false)
    {

        if ($table) {
            $this->table = $table;
        }
        if ($data['coupon_id']) {
            $this->db->update($this->table, $data, array('coupon_id' => $data['coupon_id']));
            return $data['coupon_id'];
        } else {
            $this->db->insert($this->table, $data);
            return $this->db->insert_id();
        }
    }
    function delete($id, $table = false)
    {
        if ($table) {
            $this->table = $table;
        }
        $this->db->delete($this->table, array('id' => $id));
    }
function deletecoupon($id, $table = false)
    {
        if ($table) {
            $this->table = $table;
        }
        $this->db->delete($this->table, array('coupon_id' => $id));
    }
    function get_unique_url($url, $id = false)
    {
        $this->db->select('slug, id');
        $this->db->where('slug', $url);
        $rest = $this->db->get($this->table);
        if ($rest->num_rows() == 0) {
            return $url;
        } else {
            $cr = $rest->first_row();
            if ($cr->id == $id) {
                return $url;
            } else {
                $url = $url . '1';
                return $this->get_unique_url($url, $id);
            }
        }
    }

    function totalCount(){
        return $this->db->get($this->table)->num_rows();
    }



 function fetch_state_id($country_id)
 {
  $this->db->where('country_id',$country_id);
  $this->db->order_by('id', 'ASC');
  $query = $this->db->get('states');

  $output = '<option value="">Select State</option>';
  foreach($query->result() as $row)
  {
   $output .= '<option value="'.$row->id.'">'.$row->name.'</option>';
  }
  return $output;
 }
   function fetch_city_id($state_id)
 {
  $this->db->where('state_id', $state_id);
  $this->db->order_by('id', 'ASC');
  $query = $this->db->get('cities');
  $output = '<option value="">Select City</option>';
  foreach($query->result() as $row)
  {
   $output .= '<option value="'.$row->id.'">'.$row->name.'</option>';
  }
  return $output;
 }

 public function productRating($productId)
    {
        $this->db->select_avg('rating');
        $this->db->where("product_id=$productId");
        $result = $this->db->get('product_review')->row();
        return FLOOR($result->rating);

    }
 public function businessRating($businessId)
    {
        $this->db->select_avg('rating');
        $this->db->where("business_id=$businessId");
        $result = $this->db->get('user_listreview')->row();
        return FLOOR($result->rating);

    }
    public function getAll_where($table,$key, $value){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($key, $value);
        $query= $this->db->get();
        return $query->row();
    }

    // public function searchproducts(){
    //    $data['productslist']= $this->db->query('SELECT * FROM products AS pd JOIN mrkt_category AS mk ON mk.id=pd.category WHERE (mk.name LIKE "%'.$prname.'%" OR pd.productName LIKE "%'.$prname.'%")')->result();
    // }

    public function getSellerOrders($sellerId=false){
        $query=$this->db->query("SELECT * FROM products AS pr JOIN productorders AS pord ON pord.product_id=pr.productId WHERE pr.userid='$sellerId' AND pord.payment_status='1'");
        return $query->result();
    }
    public function getSellerOrderDetails($ProductId=false){
        $query=$this->db->query("SELECT * FROM products AS pr JOIN productorders AS pord ON pord.product_id=pr.productId WHERE pr.productId='$ProductId' AND pord.payment_status='1'");
        return $query->row();
    }
     public function getSellerCustomerDetails($sellerId=false){
        $query=$this->db->query("SELECT * FROM user_accounts  WHERE created_by='$sellerId' AND user_status='1'");
        return $query->result();
    }
}