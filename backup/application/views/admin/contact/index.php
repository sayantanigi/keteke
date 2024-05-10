 <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-12 col-12">
            <div class="card card-primary"> 
              <div class="card-header">
                <h3 class="card-title">Contact User List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <div class="table-responsive">
              <table class="table table-bordered" id="ex">
                <thead>
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th style="width: 25%">Message</th>
                  <th>Date</th>
                  <th style="width: 40px">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  if(is_array($contacts) && count($contacts)>0){
                    $i=1;
                    foreach ($contacts as $contacts_v) {
                      ?>
                      <tr>
                        <td><?=$i?></td>
                        <td><?=$contacts_v->name?></td>
                        <td><?=$contacts_v->email?></td>
                        <td><?=$contacts_v->message?></td>
                        <td><?=date('d M Y',strtotime($contacts_v->created_at))?></td>
                        <td>
                          <a href="<?=admin_url('contacts/delete/'.$contacts_v->id)?>" class="text-danger delete"><span class="fa fa-trash"></span></a>
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
    </div>
  </div>
</section>