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
              <form action="<?=admin_url('countries/add/'.$pages->id)?>" method="post" enctype="multipart/form-data">
                <div class="card-body">
          <div class="form-row row">
            <div class="col-lg-6 col-12">
              <div class="form-group">
                  <label>Country Name</label>
                  <input type="text" name="frm[name]" value="<?=$pages->name?>" class="form-control" id="exampleInputEmail1" placeholder="Enter Country Name">
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
