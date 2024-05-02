 <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-12 col-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Category List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <a href="<?= admin_url('categories/addsubmenuMarketplace')?>" class="btn btn-warning btn-sm mb-3">Add</a>
              <div class="table-responsive">
                <table class="table table-bordered" id="ex">
                  <thead>
                    <tr>
                  <th style="width: 10px">#</th>
                  <th>Sub-menu Name</th>
                  <th>Menu Name </th>
                  <th>Status</th>
                  <th>Created</th>
                  <th style="width: 100px">Action</th>
                </tr>
                  </thead>
                  <tbody>
                       <?php
                    if(is_array($pages) && count($pages)>0){
                    $i=1;
                    foreach ($pages as $pr) {
                      $mrktcategory = $this->db->get_where('mrkt_category',array('id'=>$pr->cat_id))->row();

                      ?>
                       <tr>
                        <td><?=$i?></td>
                        <td>
                          <?php echo $pr->name;?></td>
                           <td>
                          <?php echo $mrktcategory->name;?></td>
                        <td>
                          <?php
                          if($pr->status == 1){
                            ?>
                            <a href="<?=admin_url('categories/submenuMrktdeactivate/'.$pr->submenuId)?>"><span class="badge bg-green">Active</span></a>
                            <?php
                          }
                          else{
                            ?>
                            <a href="<?=admin_url('categories/submenuMrktactivate/'.$pr->submenuId)?>"><span class="badge bg-red">Inactive</span></a>
                            <?php
                          }
                          ?>
                        </td>

                        <td><?php  echo date('d M Y',strtotime($pr->created));?></td>
                        <td>
                          <div class="action-button">
                            <a href="<?=admin_url('categories/addsubmenuMarketplace/'.$pr->submenuId)?>" class="btn btn-info btn-xs"><i class="fa fa-edit"></i></a>
                            <a href="<?=admin_url('categories/submenumrktdelete/'.$pr->submenuId)?>" class="btn btn-danger btn-xs delete"><i class="fa fa-trash"></i></a>
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
   
