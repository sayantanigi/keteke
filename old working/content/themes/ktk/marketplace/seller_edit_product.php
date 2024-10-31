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

              <div class="account-details-form">

                <form action="<?=site_url('edit-product/'.$mindprdct->productId)?>" method="POST" enctype="multipart/form-data">

                  <div class="row"> 

                    <div class="col-lg-6 col-12 mb-30">

                      <label>Select Category<span class="red">&nbsp; *</span></label>

                      <select class="form-control" name="frm[category]">

                       <option value="">Select</option>

                       <?php if(is_array($mcategoty) && count($mcategoty)>0){

                         foreach ($mcategoty as $mcat) {

                          ?>

                          <option value="<?=$mcat->id?>" <?php if($mindprdct->category==$mcat->id){echo"selected";} ?>><?=$mcat->name?></option>

                        <?php } } ?>

                        

                      </select>

                    </div>

                    <?php if($mindprdct->category=="2"){ ?>

                     <div class="col-lg-6 col-12 mb-30" id="clothmenu" >

                      <label>Product Sub category</label>

                      <select class="form-control" name="frm[prsubmenuId]">

                       <option value="">Select</option>

                       <?php if(is_array($mcatsubmenu) && count($mcatsubmenu)>0){

                         foreach ($mcatsubmenu as $msub) {

                          ?>

                          <option value="<?=$msub->submenuId?>" <?php if($msub->submenuId==$mindprdct->prsubmenuId){echo "selected";} ?>><?=$msub->name?></option>

                        <?php } } ?>

                        

                      </select>

                    </div>

                  <?php } ?>

                    <div class="col-lg-6 col-12 mb-30">

                      <label>Product Name<span class="red">&nbsp; *</span></label>

                      <input placeholder="Product Name" name="frm[productName]" value="<?=$mindprdct->productName?>" type="text">

                    </div>

                    <div class="col-lg-6 col-12 mb-30">

                      <label>Product Code<span class="red">&nbsp; *</span></label>

                      <input placeholder="Product Code" name="frm[prcode]" value="<?=$mindprdct->prcode?>" type="text">

                    </div>

                    <div class="col-lg-6 col-12 mb-30">

                      <label>Product Type</label>

                      <input placeholder="Product Type" name="frm[product_type]" value="<?=$mindprdct->product_type?>" type="text">

                    </div>

                    <div class="col-lg-6 col-12 mb-30">

                      <label>Brand/Vendor Name</label>

                      <input placeholder="Brand Name" name="frm[brand_name]" value="<?=$mindprdct->brand_name?>" type="text">

                    </div>

                    <div class="col-lg-6 col-12 mb-30">

                      <label>Regular Price<span class="red">&nbsp; *</span></label>

                      <input placeholder="Regular Price" name="frm[maxPrice]" value="<?=$mindprdct->maxPrice?>" id="maxPrice" type="number">

                    </div>

                    <div class="col-lg-6 col-12 mb-30">

                      <label>Discount %</label>

                      <input placeholder="Discount %" onkeyup="fetchprice()" id="disc_percent" name="frm[disc_percent]" value="<?=$mindprdct->disc_percent?>" id="disc_percent" type="number">

                    </div>

                    <div class="col-lg-6 col-12 mb-30">

                      <label>Offered Price<span class="red">&nbsp; *</span></label>

                      <input placeholder="Offred Price" name="frm[offprice]" value="<?=$mindprdct->offprice?>" id="offedprice" type="number" readonly >

                    </div>

                     <div class="col-lg-6 col-12 mb-30"> 

                      <label>SKU<span class="red">&nbsp; *</span></label>

                      <input placeholder="Add unique identifier for the product" name="frm[sku]" value="<?=$mindprdct->sku?>" type="text" >

                    </div>

                     <div class="col-lg-6 col-12 mb-30"> 

                      <label>Inventory</label>

                      <input placeholder="Inventory" value="<?=$mindprdct->inventory?>" name="frm[inventory]" type="text"  >

                    </div>

                     <div class="col-lg-6 col-12 mb-30"> 

                      <label>Collections</label>

                      <input placeholder="Collections" value="<?=$mindprdct->collections?>" name="frm[collections]" type="text"  >

                    </div>

                     <div class="col-lg-6 col-12 mb-30"> 

                      <label>Tags</label>

                      <input placeholder="Tags" value="<?=$mindprdct->tags?>" name="frm[tags]" type="text">

                    </div>

                     <div class="col-lg-12 col-12 mb-30">

                      <label>Shipping Information</label>

                      <textarea class="form-control" name="frm[shipping_info]"><?=$mindprdct->shipping_info?></textarea>

                    </div>

                    <div class="col-lg-12 col-12 mb-30">

                      <label>Short Description</label>

                      <textarea class="form-control" name="frm[description]"><?=$mindprdct->description?></textarea>

                    </div>

                    <div class="col-lg-6 col-12 mb-30">

                      <label>Shipping Charges($)</label>

                      <input placeholder="Shipping Charges" name="frm[shipping_charge]" type="text" value="<?=$mindprdct->shipping_charge?>">

                    </div> 

                    <div class="col-lg-6 col-12 mb-30 tagfullwidth"> 

                      <label>Variants</label>

                      <input placeholder="Enter Variants using TAB" name="frm[variants]" type="text" value="<?=$mindprdct->variants?>"  data-role="tagsinput" class="form-control">

                    </div>

                     <div class="col-lg-12 col-12 mb-30"> 

                      <label>SEO Title</label>

                      <input placeholder="SEO Title" value="<?=$mindprdct->seo_title?>" name="frm[seo_title]" type="text">

                    </div>

                     <div class="col-lg-12 col-12 mb-30"> 

                      <label>SEO Meta Description</label>

                      <input placeholder="SEO Meta Description" value="<?=$mindprdct->seo_descr?>" name="frm[seo_descr]" type="text">

                    </div>

                    <div class="col-lg-12 col-12 mb-30">

                      <label>Upload Product Images</label><br>

                      <input type="file" name="files[]" multiple><br/>

                      <?php foreach ($mindprdctimg as $mprdimg) { ?> 

                        <div class="boxuploadImg">

                          <img src="<?=site_url('assets/images/products/'.$mprdimg->productImage)?>" class="img-responsive">

                          <a href="<?=site_url('shop/delete_productImg/'.$mprdimg->productImageId.'/'.$mindprdct->productId)?>" onclick="return confirm('Are you sure want to delete')" class="deleteimg"><i class="fa fa-trash" area-hidden="true"> </i>Delete</a>

                        </div>

                      <?php } ?>

                    </div>

                     <div class="col-lg-12 col-12 mb-30"> 

                      <label>Return Or Cancel within days</label>

                      <input placeholder="return day" name="frm[return_day]" value="<?=$mindprdct->return_day?>" min="1" type="number">

                    </div>

                    <div class="col-lg-12 col-12 mb-30">

                      <button class="save-change-btn" type="submit">Update</button>

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

  function fetchprice(){

    var regPrice = $("#maxPrice").val();

    var dprcnt = $("#disc_percent").val();

    var offprc = (regPrice*dprcnt)/100;

    var discprc = Math.round(regPrice-offprc);

    $("#offedprice").val(discprc);

  }



</script>