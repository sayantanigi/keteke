<!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Seo List</h3>
              <a href="<?=admin_url('seo/add')?>" class="pull-right btn btn-primary">Add</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered">
                <tr>
                  <th style="width: 10px">#</th>
                  <!-- <th>Image</th> -->
                  <th>Page</th>
                  <th>Title</th>
                 
                  <th style="width: 40px">Action</th>
                </tr>
                <?php
                  if(is_array($members) && count($members)>0){
                    $i=1;
                    foreach ($members as $member) {
                      ?>
                      <tr>
                        <td><?=$i?></td>
                        <!-- <td><img src="<?=site_url('assets/images/cms/'.$member->image)?>" title="<?=$pages->title?>" width="80px" onerror="this.src='<?=site_url('assets/images/no-image.png');?>';"></td> -->
                        <td><?=$member->page?></td>
                        <td><?=$member->title?></td>
                        <td>
                          <div class="action-button">
                            <a href="<?=admin_url('seo/add/'.$member->id)?>" class="btn btn-xs btn-info"><span class="fa fa-pencil"></span></a>
                            <a href="<?=admin_url('seo/delete/'.$member->id)?>" class="btn btn-xs btn-danger delete"><span class="fa fa-trash"></span></a>
                          </div>
                        </td>
                      </tr>
                      <?php
                    $i++;
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