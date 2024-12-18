 <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-12 col-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Change Password</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="<?=admin_url('profile')?>" method="post" enctype="multipart/form-data">
                <div class="card-body">
          <div class="form-row row">
            <div class="col-lg-6 col-12">
              <div class="form-group">
                <div class="form-group">
                  <label>Old Password</label>
                   <input type="password" name="old_password" class="form-control" id="exampleInputEmail1" placeholder="Enter Old Password">
                </div>
              </div>
            </div>
          </div>
          <div class="form-row row">
            <div class="col-lg-6 col-12">
              <div class="form-group">
                <label>New Password</label>
                <input type="password" name="new_password" class="form-control" id="exampleInputEmail1" placeholder="Enter New Password">
              </div>
            </div>
          </div>
          <div class="form-row row">
            <div class="col-lg-6 col-12">
               <div class="form-group">
                  <label>Re-Enter Password</label>
                 <input type="password" name="retype_password" class="form-control" id="exampleInputEmail1" placeholder="Enter Confirm Password">
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
