<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages_model extends Master_Model {

	public function __construct()
	{
		parent::__construct();
		$this->table = 'listing';
	}

	function getRowsByCheck($keyword){
		$search_keuword = '';
        if (count($keyword) > 0) {
            foreach ($keyword as $key => $value) {
                if ($key == 'country') {
                    $search_keuword .= "and country IN ('" . $value . "')";
                }
                if ($key == 'category') {
                    $search_keuword .= "and category IN ('" . $value . "')";
                }
        }
        $res = $this->db->query("SELECT * FROM listing WHERE id!='' " . $search_keuword . "")->result_array();
        //echo $this->db->last_query();die;
        return $res;

    }

}
function getAllrestaurant($offset = 0, $limit = 40, $table = false)
    {
        if ($table) {
            $this->table = $table;
        }
        $this->db->order_by('title', 'ASC');
        $this->db->where('category','restaurant');
        $this->db->limit($limit, $offset);
        $rest = $this->db->get($this->table);
        $data['results'] = $rest->result();
        $data['total'] = $this->db->get_where($this->table,array('category'=>'restaurant'))->num_rows();
         //echo $this->db->last_query();die;
        return $data;
    }
    function getAllhotel($offset = 0, $limit = 40, $table = false)
    {
        if ($table) {
            $this->table = $table;
        }
        $this->db->order_by('title', 'ASC');
        $this->db->where('category','hotel');
        $this->db->limit($limit, $offset);
        $rest = $this->db->get($this->table);
        $data['results'] = $rest->result();
        $data['total'] = $this->db->get_where($this->table,array('category'=>'hotel'))->num_rows();
         //echo $this->db->last_query();die;
        return $data;
    }
     function getAllclub($offset = 0, $limit = 40, $table = false)
    {
        if ($table) {
            $this->table = $table;
        }
        $this->db->order_by('title', 'ASC');
        $this->db->where('category','nightclub');
        $this->db->limit($limit, $offset);
        $rest = $this->db->get($this->table);
        $data['results'] = $rest->result();
        $data['total'] = $this->db->get_where($this->table,array('category'=>'nightclub'))->num_rows();
         //echo $this->db->last_query();die;
        return $data;
    }
    function getAllcruise($offset = 0, $limit = 40, $table = false)
    {
        if ($table) {
            $this->table = $table;
        }
        $this->db->order_by('title', 'ASC');
        $this->db->where('category','cruise');
        $this->db->limit($limit, $offset);
        $rest = $this->db->get($this->table);
        $data['results'] = $rest->result();
        $data['total'] = $this->db->get_where($this->table,array('category'=>'cruise'))->num_rows();
         //echo $this->db->last_query();die;
        return $data;
    }
public function deleteMultiple($id){
        if(is_array($id)){
            $this->db->where_in('id', $id);
        }else{
            $this->db->where('id', $id);
        }
        $delete = $this->db->delete('listing');
        //echo $this->db->last_query();die;
       return $delete?true:false;
    }
}

/* End of file Pages_model.php */
/* Location: ./application/models/Pages_model.php */