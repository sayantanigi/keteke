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
          <form action="<?=admin_url('banner/add/'.$product->id)?>" method="post" enctype="multipart/form-data">
            <div class="card-body">
              <div class="form-row row">
                <div class="col-lg-6 col-12">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Banner Location</label>
                    <select name="frm[banner_type]" class="form-control">
                      <option value="">Choose</option>
                      <option value="mbanner" <?php if($product->banner_type=='mbanner'){echo"selected";} ?>>Marketplace home Page</option>
                      <option value="adv" <?php if($product->banner_type=='adv'){echo"selected";} ?>>Marketplace Advertisement</option>
                    </select>
                  </div>
                </div>
                 <div class="col-lg-6 col-12">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Banner Text</label>
                    <input type="text" name="frm[banner_text]" value="<?=$product->banner_text?>" class="form-control" id="exampleInputEmail1" placeholder="Enter Text" required>
                  </div>
                </div>
                <div class="col-lg-6 col-12">
                  <div class="form-group">
                    <img src="<?=site_url('assets/images/banner/'.$product->image)?>" onerror="this.src='<?=site_url()?>/assets/images/no-image.png';" class="img-responsive" style="width:100px">
                    <label for="exampleInputEmail1">Image</label>
                    <input type="file" name="image" value="<?=$product->image?>" class="form-control" id="exampleInputEmail1">
                  </div>
                </div>
               
                <div class="col-lg-6 col-12">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Banner href Link </label>
                    <input type="text" name="frm[link]" value="<?=$product->link?>" class="form-control" id="exampleInputEmail1" placeholder="Enter href link" required>
                  </div>
                </div>
              </div>
              <div class="form-row row">
                <div class="col-lg-6 col-12"> 
                  <div class="form-group">
                   <label>Status</label>
                   <select name="frm[status]" class="form-control">
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
