<section class="content">
  <div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-lg-12 col-12">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Add</h3>
          </div>
          <!-- /.card-header -->
        <form action="<?=admin_url('members/add/'.$member->user_id)?>" method="post" enctype="multipart/form-data">
           <div class="card-body">
              <div class="form-row row">
                 <div class="col-lg-12 col-12">
                        <?php
                    
                    if($this -> session -> flashdata('error')){
                        ?>
                        <div class="alert alert-danger alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <?php echo $this -> session -> flashdata('error'); ?>
                        </div>
                        <?php
                    }
                    $err = validation_errors();
                    if($err){
                        ?>
                        <div class="alert alert-warning alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <?php echo $err; ?>
                        </div>
                        <?php
                    }
                    ?>
                  </div>
                     <div class="col-lg-6 col-12">
                    <div class="form-group">
                      <label for="exampleInputEmail1">First Name</label>
                      <input type="text" name="frm[user_fname]" value="<?=$member->user_fname?>"class="form-control" id="exampleInputEmail1" placeholder="Enter First Name">
                    </div>
                  </div>
                   <div class="col-lg-6 col-12">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Last Name</label>
                      <input type="text" name="frm[user_lname]" value="<?=$member->user_lname?>"class="form-control" id="exampleInputEmail1" placeholder="Enter Last Name">
                    </div>
                  </div>
                     <div class="col-lg-6 col-12">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Email</label>
                      <input type="text" name="frm[user_emailid]" value="<?=$member->user_emailid?>"class="form-control" id="exampleInputEmail1" placeholder="Enter Email">
                    </div>
                  </div>
                     <div class="col-lg-6 col-12">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Password</label>
                      <input type="password" name="frm[user_pasword]" value="<?=$member->user_pasword?>"class="form-control" id="exampleInputEmail1" placeholder="Enter Password">
                      
                    </div>
                  </div>
                  <?php if($member->u_type==1){
                    $utype="Business Owner";}
                    elseif($member->u_type==2){
                      $utype="Service Provider";}
                      elseif($member->u_type==3){
                        $utype="Seller";}
                      elseif($member->u_type==4){
                        $utype="User";}?>

                      <div class="col-lg-6 col-12">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Usertype</label>
                     <input type="text" value="<?=@$utype?>" class="form-control" id="exampleInputEmail1" placeholder="Enter User Type" readonly>
                    </div>
                  </div>
               
                     <div class="col-lg-6 col-12">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Status</label>
                      <select name="frm[user_status]" class="form-control">
                        <option value="1" <?=($member->user_status == 1)?'selected':'';?>>Active</option>
                        <option value="0" <?=($member->user_status == 0)?'selected':'';?>>Inactive</option>
                      </select>
                    </div>
                  </div>
              </div>
              <div class="box-footer">
                 <a href="<?=admin_url('members')?>" class="btn btn-primary">Back</a>
            <!-- <button type="submit" class="btn btn-primary">Back</button> -->
          </div>
          </div>
          
        </form>
      </div>
      <!-- /.box -->
    </div>
  </div>
</div>
</section>