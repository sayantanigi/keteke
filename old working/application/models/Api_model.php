<?php
class Api_model extends Master_Model {

	function __construct () {
		parent::__construct ();
	}

	public function loginCheck($table,$email,$pass){
		$this->db->where('email',$email);
		$this->db->where('password',$pass);
		$this->db->where('status',1);
		$res = $this->db->get($table)->row();
		
		if(!empty($res)){
			return $res;
		}else{
			return 0;
		}
	}

	function getAllListingApi( $table = false)
    {
        if ($table) {
            $this->table = $table;
        }
        $this->db->limit(10);
        $this->db->order_by('pr_status', 'DESC');
        $this->db->order_by('title','ASC');
        $this->db->where('country','usa');
        $this->db->where('status', 1);
        $this->db->or_where('pr_status',1);
        $rest = $this->db->get($this->table);
        $data = $rest->result();
        return $data;
    }

    function getAllListingCountry( $table = false,$cn)
    {
        if ($table) {
            $this->table = $table;
        }
        $this->db->order_by('pr_status', 'DESC');
        $this->db->order_by('title','ASC');
        $this->db->where('country',$cn);
        $this->db->where('status', 1);
        $this->db->or_where('pr_status',1);
        $rest = $this->db->get($this->table);
        $data = $rest->result();
        return $data;
    }
    function allreview($id){
    	return $this->db->get_where('review',array('list_id'=>$id,'status'=>1))->result();
    }
    
    function getAllListingCategory( $table = false,$cn)
    {
        if ($table) {
            $this->table = $table;
        }
        $this->db->order_by('pr_status', 'DESC');
        $this->db->order_by('title','ASC');
        $this->db->where('category',$cn);
        $this->db->where('status', 1);
        $this->db->or_where('pr_status',1);
        $rest = $this->db->get($this->table);
        $data = $rest->result();
        return $data;
    }


}
