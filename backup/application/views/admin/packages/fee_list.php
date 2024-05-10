<!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Registration Plan List</h3>
              <!-- <a href="<?=admin_url('package/add')?>" class="pull-right btn btn-primary">Add</a> -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered">
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Title</th>
                  <th>Price</th>
                  <th style="width: 40px">Action</th>
                </tr>
                <?php
                  if(is_array($fee) && count($fee)>0){
                    $i=1;
                    foreach ($fee as $member) {
                      ?>
                      <tr>
                        <td><?=$i?></td>
                        
                        <td><?=$member->title?></td>
                        <td>$ <?=$member->price?></td>
                        
                        <td>
                          <div class="action-button">
                            <a href="<?=admin_url('package/feeupdate/'.$member->id)?>" class="btn btn-xs btn-info"><span class="fa fa-pencil"></span></a>
                            <!-- <a href="<?=admin_url('package/delete/'.$member->id)?>" class="btn btn-xs btn-danger delete"><span class="fa fa-trash"></span></a> -->
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
            
          </div>
          <!-- /.box -->
        </div>
      </div>