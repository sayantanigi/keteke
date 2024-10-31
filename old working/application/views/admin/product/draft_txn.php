<style>
  .tablefontsmall td, .tablefontsmall th{
    font-size: 13px;
  }
  .tablefontsmall .btn-sm{
    font-size: 10px;
  }
</style>
<!-- Main content -->
       <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Draft Order Transactions List</h3>
            </div>
          <div class="card-body">
           
            <!-- /.box-header -->
            <div class="box-body">
              <table id="ex" class="table table-bordered tablefontsmall">
                <thead>
                <tr>
                  <th>SL No.</th>
                  <th>Buyer Name</th>
                  <th>Amount</th>
                  <th>Transaction ID</th>
                  <th>Status</th>
                  <th>Tran Date</th>
                  <th>Created By</th>
                  <th>View Orders</th>
                </tr>
                </thead>
                <tbody>
                <?php
                  if(is_array($trans) && count($trans)>0){
                    $i=1;
                    foreach ($trans as $trans_v) {
                       $muser=$this->Master_model->getSingleRow('user_id',$trans_v->payment_created_by,'user_accounts');
                      ?>
                      <tr>
                        <td><?=$i?></td>
                         <td><?=$trans_v->cardholder_name?></td>
                         <td><?=$trans_v->payment_gross?> USD</td>
                         <td><?=$trans_v->txn_id?></td>
                         <td><?=$trans_v->payment_status?>(Stripe)</td>
                        <td><?=date('d M Y',strtotime($trans_v->tran_date))?></td>
                        <td><b>Seller Name:</b> <?=$muser->user_fname.' '.$muser->user_lname?><br>
                            <b>Created: </b><?=date('d M Y',strtotime($trans_v->payment_created_date))?>
                      </td>
                        <td>
                          <div class="action-button">
                           <a href="<?=admin_url('products/draftordersview/'.$trans_v->id)?>" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
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
            <!-- /.box-body -->
            <div class="box-footer clearfix">
              <?=$paginate?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>