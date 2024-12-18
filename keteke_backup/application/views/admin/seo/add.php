<!-- Main content -->
<section class="content">
  <div class="row">
    <!-- left column -->
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Add Seo</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form action="<?=admin_url('seo/add/'.$member->id)?>" method="post" enctype="multipart/form-data">
          <div class="box-body">
            <div class="container">
              <div class="row">
                <div class="col-sm-10">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Page</label>
                      <select name="frm[page]" class="form-control">
                        <option value="">--Select--</option>
                        <option value="about-us">About us</option>
                        <option value="career">Career</option>
                        <option value="contact">Contact</option>
                      </select>
                      
                    </div>
                  </div>
                  
                </div>
                <div class="col-sm-10">
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Title</label>
                      <input type="text" name="frm[title]" value="<?=$member->title?>"class="form-control" id="exampleInputEmail1" placeholder="Enter Title">
                    </div>
                  </div>
                </div>

                <div class="col-sm-10">
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Description</label>
                      <textarea class="form-control" name="frm[description]"  placeholder="Enter Description"><?=$member->description?></textarea>
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