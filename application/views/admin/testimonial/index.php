<!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Testimonials Lists</h3>
              <a href="<?=admin_url('testimonials/add')?>" class="pull-right btn btn-primary">Add</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered">
                <tr>
                  <th style="width: 10px">#</th>
                  <!-- <th>Image</th> -->
                  <th>Name</th>
                  <th>Designation</th>
                  <th>Description</th>
                  <th>Status</th>
                  <th style="width: 40px">Action</th>
                </tr>
                <?php
                  if(is_array($testimonials) && count($testimonials)>0){
                    $i=0;
                    foreach ($testimonials as $testimonial) {
                      $i++;
                      ?>
                      <tr>
                        <td><?=$i?></td>
                       <!--  <td><img src="<?=site_url('assets/images/testimonial/'.$testimonial->image)?>" title="<?=$testimonial->name?>" width="80px" onerror="this.onerror=null;this.src='<?=site_url('assets/images/download.jpg');?>';"></td> -->
                        <td><?=$testimonial->name?></td>
                        <td><?=$testimonial->designation?></td>
                        <td><?=$testimonial->description?></td>
                        <td>
                          <?php
                          if($testimonial->status == 1){
                            ?>
                            <a href="<?=admin_url('testimonials/deactivate/'.$testimonial->id)?>"><span class="badge bg-green">Active</span></a>
                            <?php
                          }
                          else{
                            ?>
                            <a href="<?=admin_url('testimonials/activate/'.$testimonial->id)?>"><span class="badge bg-red">Inactive</span></a>
                            <?php
                          }
                          ?>                          
                        </td>
                        <td>
                          <div class="action-button">
                            <a href="<?=admin_url('testimonials/add/'.$testimonial->id)?>" class="btn btn-xs btn-info"><span class="fa fa-pencil"></span></a>
                            <a href="<?=admin_url('testimonials/delete/'.$testimonial->id)?>" class="btn btn-xs btn-danger delete"><span class="fa fa-trash"></span></a>
                          </div>
                        </td>
                      </tr>
                      <?php
                    }
                  }
                ?>
              </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
              <?=$paginate?>
              <!-- <ul class="pagination pagination-sm no-margin pull-right">
                <li><a href="#">&laquo;</a></li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">&raquo;</a></li>
              </ul> -->
            </div>
          </div>
          <!-- /.box -->
        </div>
      </div>