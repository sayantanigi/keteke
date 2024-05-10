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
          <div class="tab-pane fade show active" id="address-edit" role="tabpanel">
            <div class="myaccount-content">
              <h3>Create Draft Order</h3>

              <div class="account-details-form">
                <form action="<?=site_url('create-draftorder')?>" method="post" enctype="multipart/form-data">
                  <div class="row">
                    <div class="col-lg-6 col-12 mb-30">
                      <label>Select Customer</label>
                      <select class="form-control" name="frm[userid]" required>
                       <option value="">Select</option>
                       <?php if(is_array($customers) && count($customers)>0){
                         foreach ($customers as $mcus) {
                          ?>
                          <option value="<?=$mcus->user_id?>"><?=$mcus->user_fname.' '.$mcus->user_lname?></option>
                        <?php } } ?>
                        
                      </select>
                    </div>
                    <div class="col-lg-6 col-12 mb-30">
                      <label>Product Name</label>
                       <select class="form-control" name="product_id[]" onchange="getProductprice()" id="multiselectId" multiple="" required>
                        <option value="">Select</option>
                        <?php if(is_array($products) && count($products)>0){
                         foreach ($products as $prds) {
                          ?>
                          <option value="<?=$prds->productId?>"><?=$prds->productName?></option>
                        <?php } } ?>
                      </select>
                    </div>
                    <div class="col-lg-6 col-12 mb-30">
                      <label>Quantity</label>
                      <input placeholder="Qty"  name="frm[qty]" type="number" min="1">
                    </div>
                    <div class="col-lg-6 col-12 mb-30">
                      <label>Price Including shipping charge ($)</label>
                      <input placeholder="Paid Price" id="pprice"  name="frm[price]" type="text" readonly>
                    </div>
                    
                    <div class="col-lg-12 col-12 mb-30">
                     <button class="save-change-btn" type="submit">Create</button>
                     <button class="save-change-btn" onclick="goBack()">Cancel</button>
                   </div>
                 </div>
               </form>
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
     function getProductprice()
     {
     var productId = $("#multiselectId").val();
       $.ajax({
         url: '<?=site_url("seller/productPriceAjax")?>',
         type: 'POST',
         dataType: 'html',
         data: {productId:productId},
       })
       .done(function(priceValue){
          $('#pprice').val(priceValue);
       
     });
     }
      </script>
