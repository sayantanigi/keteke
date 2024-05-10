 <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-12 col-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add CMS</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="<?=admin_url('cms/add/'.$pages->id)?>" method="post" enctype="multipart/form-data">
                <div class="card-body">
          <div class="form-row row">
            <div class="col-lg-6 col-12">
              <div class="form-group">
                <div class="form-group">
                  <label>Title</label>
                    <input type="text" name="frm[title]" value="<?=$pages->title?>" class="form-control"  placeholder="Enter Title">
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-12">
              <div class="form-group">
                <label>Meta Title</label>
                  <input type="text" name="frm[meta_title]" value="<?=$pages->meta_title?>" class="form-control" id="exampleInputEmail1" placeholder="Enter Meta Title">
              </div>
            </div>
          </div>
          <div class="form-row row">
            <div class="col-lg-12 col-12">
              <div class="form-group">
                <label>Meta Description</label>
                <textarea name="frm[meta_description]" rows="5" class="form-control"><?=$pages->meta_description?></textarea>
              </div>
            </div>
          </div>
          <div class="form-row row">
            <div class="col-lg-12 col-12">
               <div class="form-group">
                  <label>Description</label>
                  <textarea name="frm[description]" rows="5" class="form-control"><?=$pages->description?></textarea>
                </div>
              </div>
          </div>
          <div class="form-row row">
            <div class="col-lg-12 col-12">
              <div class="form-group">
                <div class="form-group">
                   <img src="<?=site_url('assets/images/cms/'.$pages->image)?>" onerror="this.src='<?=site_url()?>/assets/images/no-image.png';" class="img-responsive" style="width:100px">
                      <label>Image</label>
                      <input type="file" name="image" value="<?=$pages->image?>" class="form-control" id="exampleInputEmail1">
                </div>
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
