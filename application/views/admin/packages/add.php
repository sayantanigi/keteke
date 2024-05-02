<!-- Main content -->
<section class="content">
  <div class="row">
    <!-- left column -->
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Add Plan</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form action="<?=admin_url('package/add/'.$member->id)?>" method="post" enctype="multipart/form-data">
          <div class="box-body">
            <div class="container">
              <div class="row">
                <div class="col-sm-10">
                    <div class="col-sm-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Subscription Plan For</label>
                      <select name="frm[plan]" class="form-control">
                        <option value="1" <?php if($member->plan=='1'){echo"selected";} ?>>1 Month</option>
                        <option value="6" <?php if($member->plan=='6'){echo"selected";} ?>>6 Months</option>
                        <option value="12" <?php if($member->plan=='12'){echo"selected";} ?>>1 Year</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Plan Type</label>
                      <input type="text" name="frm[type]" value="<?=$member->type?>"class="form-control" id="exampleInputEmail1" placeholder="Enter Plan">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Price</label>
                       <input type="text" name="frm[price]" value="<?=$member->price?>"class="form-control" id="exampleInputEmail1" placeholder="Enter Price">
                    </div>
                  </div>
                   <div class="col-sm-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Status</label>
                      <select name="frm[status]" class="form-control">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                      </select>
                    </div>
                  </div>
                </div>
                    
              </div>
            </div>
          </div>
          <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
      <!-- /.box -->
    </div>
  </div>
</section>