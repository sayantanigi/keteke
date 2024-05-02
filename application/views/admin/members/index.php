 <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-12 col-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">User List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <div class="table-responsive">
                <table id="ex" class="table table-striped table-bordered tableSmall" style="width:100%">
              <!-- <table class="table table-bordered"> -->
                <thead>
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Profile Image</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>User Type</th>
                  <th>Status</th>
                  <th>Created</th>
                  <th style="width: 100px">Action</th>
                </tr>
              </thead> 
              <tbody>
                <?php
                  if(is_array($members) && count($members)>0){
                    $i=0;
                    foreach ($members as $member) {
                     
                      $i++;
                      ?>
                      <tr>
                        <td><?=$i?></td>
                         <td><img src="<?=site_url('assets/images/profile/'.$member->image)?>" title="<?=$member->fname?>" width="80px" onerror="this.src='<?=site_url('assets/images/no-image.png');?>';"></td>
                        <td><?=$member->user_fname.' '.$member->user_lname?></td>
                        <td><?=$member->user_emailid?></td>
                        <!-- <td><?=$member->mobile?></td>
                        <td><?=base64_decode($member->password)?></td> -->
                        <td><?php if($member->u_type==1){echo"Business Owner";}elseif($member->u_type==2){echo"Service Provider";}if($member->u_type==3){echo"Seller";}if($member->u_type==4){echo"User";}?></td>
                        <td>
                          <?php
                          if($member->user_status == 1){
                            ?>
                            <a href="<?=admin_url('members/deactivate/'.$member->user_id)?>"><span class="badge bg-green">Active</span></a>
                            <?php
                          }
                          else{
                            ?>
                            <a href="<?=admin_url('members/activate/'.$member->user_id)?>"><span class="badge bg-red">Inactive</span></a>
                            <?php
                          }
                          ?>                          
                        </td>
                        <td><?=date('d M Y',strtotime($member->created_at))?></td>
                        <td>
                           <div class="action-button">
                             <a href="<?=admin_url('members/view/'.$member->user_id)?>" class="btn btn-secondary btn-sm"><span class="fa fa-eye">
                           </span></a>
                            <a href="<?=admin_url('members/delete/'.$member->user_id)?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></span></a>
                           </div>
                        </td>
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
            <!-- /.card -->
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
<!-- Main content -->
   