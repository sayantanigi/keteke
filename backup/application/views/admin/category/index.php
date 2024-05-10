 <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-12 col-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Sub-category List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="ex">
                  <thead>
                    <tr>
                  <th style="width: 10px">#</th>
                  <th>Subcategory</th>
                  <th>Category</th>
                  <th>Status</th>
                  <th style="width: 100px">Action</th>
                </tr>
                  </thead>
                  <tbody>
                       <?php
                    if(is_array($pages) && count($pages)>0){
                    $i=1;
                    foreach ($pages as $pr) {
                        $parent = $this->db->get_where('category',array('id'=>$pr->catid))->row();
                      ?>
                       <tr>
                        <td><?=$i?></td>
                        <td>
                          <?php echo $pr->name;?></td>
                        <td><?php  echo $parent->name;?></td>
                        <td>
                          <?php
                          if($pr->status == 1){
                            ?>
                            <a href="<?=admin_url('categories/deactivate/'.$pr->id)?>"><span class="badge bg-green">Active</span></a>
                            <?php
                          }
                          else{
                            ?>
                            <a href="<?=admin_url('categories/activate/'.$pr->id)?>"><span class="badge bg-red">Inactive</span></a>
                            <?php
                          }
                          ?>
                        </td>
                        <td>
                          <div class="action-button">
                            <a href="<?=admin_url('categories/add/'.$pr->id)?>" class="btn btn-info btn-xs"><i class="fa fa-edit"></i></a>
                            <a href="<?=admin_url('categories/delete/'.$pr->id)?>" class="btn btn-danger btn-xs delete"><i class="fa fa-trash"></i></a>
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
   
