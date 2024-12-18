<!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Plan List</h3>
              <a href="<?=admin_url('package/add')?>" class="pull-right btn btn-primary">Add</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered">
                <tr>
                  <th style="width: 10px">#</th>
                  <!-- <th>Image</th> -->
                  <th>Plan</th>
                  <th>Type</th>
                  <th>Price</th>
                  <th>Status</th>
                 
                  <th style="width: 40px">Action</th>
                </tr>
                <?php
                  if(is_array($members) && count($members)>0){
                    $i=1;
                    foreach ($members as $member) {
                      ?>
                      <tr>
                        <td><?=$i?></td>
                        <td><?php if($member->plan=='1'){ echo "1 Month";} elseif($member->plan==6){ echo"6 Months";}elseif($member->plan==12){echo"1 Year";}?></td>
                        <td><?=$member->type?></td>
                        <td>$ <?=$member->price?></td>
                        <td>
                          <?php
                          if($member->status == 1){
                            ?>
                            <a href="<?=admin_url('package/deactivate/'.$member->id)?>"><span class="badge bg-green">Active</span></a>
                            <?php
                          }
                          else{
                            ?>
                            <a href="<?=admin_url('package/activate/'.$member->id)?>"><span class="badge bg-red">Inactive</span></a>
                            <?php
                          }
                          ?>                          
                        </td>
                        <td>
                          <div class="action-button">
                            <a href="<?=admin_url('package/add/'.$member->id)?>" class="btn btn-xs btn-info"><span class="fa fa-pencil"></span></a>
                            <a href="<?=admin_url('package/delete/'.$member->id)?>" class="btn btn-xs btn-danger delete"><span class="fa fa-trash"></span></a>
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