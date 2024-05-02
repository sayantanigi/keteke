 <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-12 col-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">CMS List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                  <th style="width: 10px">#</th>
                  <th style="width: 100px">Image</th>
                  <th>Name</th>
                  <th>Description</th>
                  <th style="width:95px;">Action</th>
                </tr>
                  </thead>
                  <tbody>
                       <?php
                  if(is_array($pages) && count($pages)>0){
                    $i=1;
                    foreach ($pages as $pages) {
                      ?>
                      <tr>
                        <td><?=$i?></td>
                        <td><img src="<?=site_url('assets/images/cms/'.$pages->image)?>" title="<?=$pages->title?>" width="80px" onerror="this.src='<?=site_url('assets/images/no-image.png');?>';"></td>
                        <td><?=$pages->title?></td>
                    
                        <td><?=substr($pages->description,0,100)?>...</td>
                        <td>
                           <a href="<?=admin_url('cms/add/'.$pages->id)?>" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a> 
                           <a href="<?=admin_url('cms/delete/'.$pages->id)?>" class="btn btn-secondary btn-sm"><i class="fa fa-trash"></i></a>
                        </td>
                      </tr>
                      <?php
                    $i++;
                    }
                  }
                ?>
                </tbody>
                </table>
        </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
<!-- Main content -->
   