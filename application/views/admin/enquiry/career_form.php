<!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Buyer Lists</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered">
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Gender</th>
                  <th>Date Of Birth</th>
                  <th>Address</th>
                  <th>Country</th>
                  <th>State</th>
                  <th>City</th>
                  <th>Preferred Industry</th>
                  <th>Prefered Job Title</th>
                  <th>Profile Summary</th>
                  <th>Resume</th>
                  <th>Date</th>
                </tr>
                <?php
                  if(is_array($enquiry) && count($enquiry)>0){
                    $i=1;
                    foreach ($enquiry as $enquiry_v) {
                      ?>
                      <tr>
                        <td><?=$i?></td>
                        <td><?=$enquiry_v->fname.' '.$enquiry_v->lname?></td>
                        <td><?=$enquiry_v->email?></td>
                        <td><?=$enquiry_v->contact_num?></td>
                        <td><?php if($enquiry_v->gender == 1){ echo"Male";}else{ echo"Female";}?></td>
                        <td><?=$enquiry_v->dob?></td>
                        <td><p><?=$enquiry_v->address1?></p>
                          <p><?=$enquiry_v->address2?></p></td>
                        <td><?php $coun=$this->db->get_where('countries',array('id'=>$enquiry_v->country))->row();
                        echo $coun->name;?></td>
                        <td><?php $st=$this->db->get_where('states',array('id'=>$enquiry_v->state))->row();
                        echo $st->name;
                        ?></td>
                        <td><?php $ct=$this->db->get_where('cities',array('id'=>$enquiry_v->city))->row();
                        echo $ct->name;
                        ?></td>
                        <td><?=$enquiry_v->prefer_industry?></td>
                        <td><?=$enquiry_v->job_title?></td>
                        <td><?=$enquiry_v->profile_summary?></td>
                        <td><a href="<?=site_url('assets/images/profile/'.$enquiry_v->resume)?>" download><span class="fa fa-download"></span></a></td>
                        <td><?=date('d M Y',strtotime($enquiry_v->date))?></td>
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