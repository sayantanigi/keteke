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
                  <th>Address</th>
                  <th>Phone</th>
                  <th>Country</th>
                  <th>State</th>
                  <th>Postal Code</th>
                  <th>Product Specifications</th>
                  <th>Product Quantity</th>
                  <th>Price Expectation(FOB Or CIF)</th>
                  <th>Delivery Schedule</th>
                  <th>Date</th>
                  <th style="width: 40px">Action</th>
                </tr>
                <?php
                  if(is_array($enquiry) && count($enquiry)>0){
                    $i=1;
                    foreach ($enquiry as $enquiry_v) {
                      ?>
                      <tr>
                        <td><?=$i?></td>
                        <td><?=$enquiry_v->fullname?></td>
                        <td><?=$enquiry_v->email?></td>
                        <td><?=$enquiry_v->address?></td>
                        <td><?=$enquiry_v->contact_no?></td>
                        <td><?php $state=$this->db->get_where('countries',array('id'=>$enquiry_v->country))->row();
                        echo $state->name;?></td>
                        <td><?php $st=$this->db->get_where('states',array('id'=>$enquiry_v->state))->row();
                        echo $st->name;
                        ?></td>
                        <td><?=$enquiry_v->postal_code?></td>
                        <td><?=$enquiry_v->product_spec?></td>
                        <td><?=$enquiry_v->prd_quantity?></td>
                        <td><?=$enquiry_v->price_expect?></td>
                        <td><?=$enquiry_v->delivery_schedule?></td>
                        <td><?=date('d M Y',strtotime($enquiry_v->date))?></td>
                        <td>
                          <!-- <a href="javascript:void(0);" class="text-info" title="Reply"><span class="fa fa-eye"></span></a> -->
                          <a href="<?=admin_url('enquiry/buyer_delete/'.$enquiry_v->id)?>" class="text-danger delete"><span class="fa fa-trash"></span></a>
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