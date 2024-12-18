

<!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">User List</h3>
              </div>
            <!-- /.box-header -->
            <div class="card-body">
              <table id="ex" class="table table-bordered">
                <thead>
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Email</th>
                  <th>Date</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                  if(is_array($members) && count($members)>0){
                    $i=1;
                    foreach ($members as $member) {
                      ?>
                      <tr>
                        <td><?=$i?></td>
                        <td><?=$member->email?></td>
                        <td><?=date('d M Y',strtotime($member->created))?></td>                      
                        <td>
                           <div class="action-button">
                            <a href="<?=admin_url('members/newsletterdelete/'.$member->id)?>" class="text-danger delete"><span class="fa fa-trash"></span></a>
                           </div>
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