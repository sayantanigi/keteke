<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Apimodel extends Master_model
{
    function __construct()
    {
        parent::__construct();
    }


    public function add_details($tbl, $data)
    {
        $this->db->insert($tbl, $data);
        $lastid = $this->db->insert_id();
        return $lastid;
    }

    public function insert_bulk($tbl, $data = array())
    {
        $insert = $this->db->insert_batch($tbl, $data);
        return $insert ? true : false;
    }

    public function get_cond($tablename, $cond)
    {
        $this->db->select('*');
        $this->db->from($tablename);
        $this->db->where($cond);
        $query = $this->db->get();
        $res = $query->row();
        return $res;
    }

    public function get_cond_all($tablename, $cond)
    {
        $this->db->select('*');
        $this->db->from($tablename);
        $this->db->where($cond);
        $query = $this->db->get();
        $res = $query->result();
        return $res;
    }

    public function update_cond($tablename, $cond, $value)
    {
        $this->db->where($cond);
        $this->db->update($tablename, $value);
        return true;
    }

    public function fetch_all_join($query)
    {
        $query = $this->db->query($query);
        return $query->result();
    }

    public function fetch_single_join($query)
    {
        $query = $this->db->query($query);
        return $query->row();
    }

    public function delete_single_con($tbl, $where)
    {
        $this->db->where($where);
        $delete = $this->db->delete($tbl);
        return $delete;

    }

    public function count($table, $where = NULL)
    {
        if ($where != NULL) {
            $this->db->where($where);

        }
        $this->db->from($table);
        return $this->db->count_all_results();
    }

    public function randString($length, $charset = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz123456789')
    {
        $str = '';
        $count = strlen($charset);
        while ($length--) {
            $str .= $charset[mt_rand(0, $count - 1)];
        }

        return $str;
    }

    public function SaveData($table,$data,$condition='') {
        $DataArray = array();
        if(!empty($condition)) {
            $data['modified']=date("Y-m-d H:i:s");
        } else if(empty($condition)) {
            $data['created']=date("Y-m-d H:i:s");
            $data['modified']=date("Y-m-d H:i:s");
        }
        $table_fields = $this->db->list_fields($table);
        foreach($data as $field=>$value) {
            if(in_array($field,$table_fields)) {
                $DataArray[$field]= $value;
            }
        }
        if($condition != '') {
            $this->db->where($condition);
            $this->db->update($table, $DataArray);
        } else {
            $this->db->insert($table, $DataArray);
        }
    }
}

?>