<!-- Main content -->
<section class="content">
  <div class="row">
    <!-- left column -->
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Add Bulk Listing</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
     
              <!-- form start -->
        <form action="<?=admin_url('directories/add')?>" method="post" enctype="multipart/form-data">
          <div class="box-body">
            <div class="container">
              <div class="row">
                <div class="col-sm-10">
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Import csv File For bulk data uploading</label>
                      <input type="file" name="file" accept=".csv"/>
                    </div>
                  </div>
                   <div class="box-footer">
                  <button type="submit" name="importSubmit" class="btn btn-primary">Import</button>
                </div>
                </div>
         
              </div>
            </div>
          </div>
         
        </form>
      <!-- /.box -->
      </div>
      <!-- /.box -->
    </div>
  </div>
</section>