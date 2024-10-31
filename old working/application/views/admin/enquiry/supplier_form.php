<!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Supplier Lists</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered">
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Review For</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th style="width: 25%">Description</th>
                  <th>Status</th>
                  <th>Date</th>
                  <th style="width: 40px">Action</th>
                </tr>
                <?php
                  if(is_array($enquiry) && count($enquiry)>0){
                    $i=1;
                    foreach ($enquiry as $enquiry_v) {
                      $detl=$this->db->get_where('listing',array('id'=>$enquiry_v->list_id,'status'=>1))->row();
                      ?>
                      <tr>
                        <td><?=$i?></td>
                        <td><p><?=$detl->title?></p>
                          <p><?=$detl->location?></p></td>
                        <td><?=$enquiry_v->name?></td>
                        <td><?=$enquiry_v->email?></td>
                        <td><?=$enquiry_v->descr?></td>
                        <td>
                          <?php
                          if($enquiry_v->status == 1){
                            ?>
                            <a href="<?=admin_url('enquiry/deactivate/'.$enquiry_v->id)?>"><span class="badge bg-green">Active</span></a>
                            <?php
                          }
                          else{
                            ?>
                            <a href="<?=admin_url('enquiry/activate/'.$enquiry_v->id)?>"><span class="badge bg-red">Inactive</span></a>
                            <?php
                          }
                          ?>                          
                        </td>
                       
                       
                        <td><?=date('d M Y',strtotime($enquiry_v->created))?></td>
                        <td>
                          <!-- <a href="javascript:void(0);" class="text-info" title="Reply"><span class="fa fa-eye"></span></a> -->
                          <a href="<?=admin_url('enquiry/review_delete/'.$enquiry_v->id)?>" class="text-danger delete"><span class="fa fa-trash"></span></a>
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