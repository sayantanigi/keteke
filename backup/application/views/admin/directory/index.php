<style>
  .tablefontsmall td, .tablefontsmall th{
    font-size: 13px;
  }
  .tablefontsmall .btn-sm{
    font-size: 10px;
  }
</style>
 <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-12 col-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Business List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <div class="table-responsive">
                <table id="ex" class="table table-striped table-bordered tablefontsmall" style="width:100%">

              <form name="bulk_action_form"  method="post" onSubmit="delete_confirm()"/>
              <div class="text-right">
                <input type="submit"   class="btn btn-danger btn-sm mb-3"  name="bulk_delete_submit" value="DELETE SELECTED"/>
              </div>
             <thead>
                <tr>
                  <th>SL No.</th>
                  <th>Business Logo</th>
                  <th>Name</th>
                  <th>Email</th>
                  <!-- <th width="250px">Lat/Long</th> -->
                  <th>Category</th>
                  <th>Country</th>
                  <th>Location</th>
                  <th>Status</th>
                  <th>Prefer List</th>
                  <th>Date</th>
                  <th width="200px">Action</th>
                  <th width="100px"><input type="checkbox" id="select_all" value=""/> Select All</th>
                </tr>
              </thead>
               <tbody>
                <?php
                  if(is_array($pages) && count($pages)>0){
                    $i=0;
                    foreach ($pages as $pr) {
                      $catt=$this->db->get_where('category',array('status'=>1,'id'=>$pr->category))->row();
                       $con=$this->db->get_where('country',array('status'=>1,'id'=>$pr->country))->row();
                      $i++;
                      ?>
                      <tr>
                   <td><?=$i?></td>
                   <td><img src="<?=site_url('assets/images/directory/'.$pr->images)?>" title="<?=$pages->title?>" width="50px" onerror="this.src='<?=site_url('assets/images/no-image.png');?>';"></td>
                    <td><?=$pr->title?></td>
                    <td><?=$pr->email?></td>
                    <td><?=$catt->name?></td>
                    <td><?=$con->name?></td>
                    <td><p><?=$pr->street_addr.','.$pr->city.','.$con->name?></p></td>
                    <td>
                          <?php
                          if($pr->status == 1){
                            ?>
                            <a href="<?=admin_url('directories/deactivate/'.$pr->id)?>"><span class="badge bg-green">Active</span></a>
                            <?php
                          }
                          else{
                            ?>
                            <a href="<?=admin_url('directories/activate/'.$pr->id)?>"><span class="badge bg-red">Inactive</span></a>
                            <?php
                          }
                          ?>
                        </td> 
                        <td>
                          <?php
                          if($pr->prefer_list == 1){
                            ?>
                            <a href="<?=admin_url('directories/PreferDeactivate/'.$pr->id)?>"><span class="badge bg-green">Yes</span></a>
                            <?php
                          }
                          else{
                            ?>
                            <a href="<?=admin_url('directories/PreferActivate/'.$pr->id)?>"><span class="badge bg-red">No</span></a>
                            <?php
                          }
                          ?>
                        </td> 
                        <td><?=date('d M Y',strtotime($pr->created))?></td>
                        <td>
                          <div class="action-button">
                            <!-- <a href="<?=admin_url('directories/update/'.$pr->id)?>" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a> -->
                            <a href="<?=admin_url('directories/delete/'.$pr->id)?>" class="btn btn-secondary btn-sm"><i class="fa fa-trash"></i></a>
                          </div>
                        </td>
                        <td><input type="checkbox" name="checked_id[]" class="checkbox" value="<?=$pr->id?>"/></td>
                      </tr>
                      <?php
                    }
                  }
                ?>

                </tbody>
                </table>
        </div>
              </div>
              <!-- /.card-body -->
            </div>
              <?=$paginate?>
            <!-- /.card -->
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
<!-- Main content -->
   