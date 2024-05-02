<?php
error_reporting(0);
class Dashboard extends Admin_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->data['header'] = '';
    $this->admin_login();
  }
  public function index()
  {
    
    $this->data['main'] = admin_view('index');
    $this->data['title'] = 'Dashboard';
    $this->data['tab'] = 'dashboard';
    $this->data['contacts'] = $this->db->get('contacts')->num_rows();
    $this->data['members'] = $this->db->get('user_accounts')->num_rows();
    $this->data['lists'] = $this->db->get_where('listing',array('status'=>1))->num_rows();
    $prodorders=$this->db->query("select SUM(quantity) as totalsale, month(order_date) AS monthName from productorders where payment_status='1' group by month(order_date) order by month(order_date) asc")->result();
    foreach ($prodorders as $key => $value) {
      # code...
      //echo $key;
    }
    
  

    foreach ($prodorders as $prds) {
     $prdsale=$prds->Totalsale;
    }
    //print_r(json_encode($prdsale)); 
    //print_r($prodorders[0]->Totalsale);
    $draftorders=$this->db->query("select SUM(qty) as drftsale, month(created_at) from draft_orders where payment_status='1' group by month(created_at) order by month(created_at)")->result();
    //$this->data['pr_lists'] = $this->db->get_where('listing',array('pr_status'=>1))->num_rows();
   
    //$arr = array('a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5);
     //echo json_encode(array_values($arr));
    $this->load->view(admin_view('default'),$this->data);

  }

}
