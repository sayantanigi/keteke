<section class="content">
  <div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-lg-12 col-12">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Add</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form action="<?=admin_url('coupon/add/'.$product->coupon_id)?>" method="post" enctype="multipart/form-data">
            <div class="card-body">
              <div class="form-row row">
                <div class="col-lg-6 col-12">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Coupon Type</label>
                    <select name="frm[coupon_type]" class="form-control" required>
                      <option value="">Choose</option>
                      <option value="amount" <?php if($product->coupon_type=='amount'){echo"selected";} ?>>Amount($)</option>
                      <option value="percent" <?php if($product->coupon_type=='percent'){echo"selected";} ?>>Percentage(%)</option>
                    </select>
                  </div>
                </div>
                 <div class="col-lg-6 col-12">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Coupon Code</label>
                    <input type="text" name="frm[coupon_code]" value="<?=$product->coupon_code?>" class="form-control" id="exampleInputEmail1" placeholder="Enter Unique Code" required>
                  </div>
                </div>
                 <div class="col-lg-6 col-12">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Image</label><br>
                    <img src="<?=site_url('assets/images/coupons/'.$product->coupon_img)?>" onerror="this.src='<?=site_url()?>/assets/images/no-image.png';" class="img-responsive" style="width:100px">
                    <input type="file" name="image" value="<?=$product->coupon_img?>" class="form-control" id="exampleInputEmail1">
                  </div>
                </div>
                <div class="col-lg-6 col-12">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Coupon Amount($)/Percentage(%)</label>
                    <input type="text" name="frm[coupon_amount]" value="<?=$product->coupon_amount?>" class="form-control" id="exampleInputEmail1" placeholder="Enter Coupon Amount or Percentage" required>
                  </div>
                </div>
                <div class="col-lg-6 col-12">
                  <div class="form-group">
                    <label for="exampleInputEmail1">From Date(YYYY-MM-DD)</label>
                    <input type="text" name="frm[created_date]" value="<?=$product->created_date?>" class="form-control" id="fromdate" placeholder="Enter Created date" autocomplete="off"required>
                  </div>
                </div> 
                <div class="col-lg-6 col-12">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Expire Date(YYYY-MM-DD)</label>
                    <input type="text" name="frm[expiry_date]" value="<?=$product->expiry_date?>" class="form-control" id="expiredate" placeholder="Enter Expire Date" autocomplete="off" required>
                  </div>
                </div>
                
                <div class="col-lg-6 col-12">
                  <div class="form-group">
                   <label>Status</label>
                   <select name="frm[coupon_status]" class="form-control">
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                  </select>
                </div>
              </div>
              </div>
          </div>
          <!-- /.card-body -->

          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="button" onclick="goBack()" class="btn btn-danger">Cancel</button>
          </div>
        </form>
      </div>
    </div>
    <!-- ./col -->
  </div>
  <!-- /.row -->
</div><!-- /.container-fluid -->
</section>
<!-- Main content -->
