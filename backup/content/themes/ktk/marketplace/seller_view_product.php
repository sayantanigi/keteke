<div class="breadcrumb-area pt-10 pb-10 border-bottom mb-40">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <!--=======  breadcrumb content  =======-->
        
        <div class="breadcrumb-content">
          <ul>
            <li class="has-child"><a href="<?=site_url()?>">Home </a></li>
            <li>Seller Dashboard</li>
          </ul>
        </div>
        
        <!--=======  End of breadcrumb content  =======-->
      </div>
    </div>
  </div>
</div>
<div class="page-section pb-40">
 <div class="container">
  <div class="row">
    <div class="col-12">
      <div class="row">
        <!-- My Account Tab Menu Start -->
        <div class="col-lg-3 col-12">
            <?php
          $this->load->front_view('marketplace/mrkt_sidebar',$this->data);
           ?>
        </div>
        <!-- My Account Tab Menu End -->

        <!-- My Account Tab Content Start -->
        <div class="col-lg-9 col-12">
         <?php
         if($this -> session -> flashdata('success')){
          ?>
          <div class="alert alert-success alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <?php echo $this -> session -> flashdata('success'); ?>
          </div>
          <?php
        }
        if($this -> session -> flashdata('error')){ 
          ?>
          <div class="alert alert-danger alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <?php echo $this -> session -> flashdata('error'); ?>
          </div>
          <?php
        }
        $err = validation_errors();
        if($err){
          ?>
          <div class="alert alert-warning alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <?php echo $err; ?>
          </div>
          <?php
        }
        ?>
        <div class="tab-content" id="myaccountContent">
          
          <!-- Single Tab Content Start -->
          <div class="tab-pane fade show active" id="orders" role="tabpanel">
            <div class="myaccount-content">
              <div class="row">
               <div class="col-lg-8 col-md-6 col-xs-12">
                <h3>Product List</h3>
              </div>
              <div class="col-lg-4 col-md-6 col-xs-12">
                <input type="hidden" id="userid" value="<?=$udetail->user_id?>">
                <select class="select-field" id="mcategory" onchange="getproductbycategory()">
                  <option value="">Choose Category</option>
                  <?php if(is_array($mcategoty) && count($mcategoty)>0){
                   foreach ($mcategoty as $mcat) {
                    ?>
                    <option value="<?=$mcat->id?>"><?=$mcat->name?></option>
                  <?php } } ?>
                  <option value="0">All</option>
                </select>
              </div>
            </div>
            <div class="myaccount-table table-responsive text-center">
              <table class="table table-bordered" id="ex">
                <thead class="thead-light">
                  <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Offered Total</th>
                    <th>Action</th>
                  </tr>
                </thead>

                <tbody id="showproductlist">
                  <?php if(is_array($mproducts) && count($mproducts)>0){
                    $j=0;
                    foreach ($mproducts as $mp) { $j++;?>
                      <tr >
                        <td><?=$j?></td>
                        <td><?=$mp->productName?></td>
                        <td><?=date('M d, Y',strtotime($mp->created))?></td>
                        <td>
                          <?php if($mp->status !=1){ ?>
                            <span class="btn btn-warning btn-xs">Deactive</span>
                          <?php }else { ?>
                            <span class="btn btn-success btn-xs">Active</span>
                          <?php } ?>
                        </td>
                        <td>$<?=$mp->offprice?></td>
                        <td><a href="<?=site_url('view-product/'.$mp->productId)?>" class="btn btn-warning btn-xs">View</a> <a href="<?=site_url('edit-product/'.$mp->productId)?>" class="btn btn-primary btn-xs">Edit</a><a href="<?=site_url('Deleteproduct/'.$mp->productId)?>" class="btn btn-danger btn-xs delete ml-1">Delete</a></td>
                      </tr>
                    <?php } } ?>
                    
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <!-- Single Tab Content End -->
          
        </div>
      </div>
      <!-- My Account Tab Content End -->
    </div>

  </div>
</div>   
</div>
</div>
<script>
  function getproductbycategory(){
    var caatid=$("#mcategory").val();
    var loguid=$("#userid").val();
    $.ajax({
     url: '<?=site_url("shop/fetchproduct")?>',
     type: 'POST',
     dataType: 'html',
     data: {caatid:caatid,loguid:loguid},

     success: function(data) {
      console.log(data);
      $('#showproductlist').html(data);
      
    }
  })
  }
</script>
<script>
 $(document).ready(function(){
  $(".delete").click(function(){
    if (!confirm("Do you want to delete")){
      return false;
    }
  });
});
</script>