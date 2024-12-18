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
        <form action="<?=admin_url('package/feeupdate/'.$member->id)?>" method="post">
          <div class="box-body">
            <div class="container">
              <div class="row">
                <div class="col-sm-10">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Title</label>
                      <input type="text" name="frm[title]" value="<?=$member->title?>"class="form-control" id="exampleInputEmail1" placeholder="Enter Plan">
                    </div>
                  </div>
                </div>
                <div class="col-sm-10">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Price</label>
                       <input type="text" name="frm[price]" value="<?=$member->price?>"class="form-control" id="exampleInputEmail1" placeholder="Enter Price">
                    </div>
                  </div>
                </div>
                    
              </div>
            </div>
            <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
          </div>
          
        </form>
      </div>
      <!-- /.box -->
    </div>
  </div>
</section>