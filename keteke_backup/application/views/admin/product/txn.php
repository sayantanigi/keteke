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
              <h3 class="card-title">Transactions List</h3>
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
                  <th>Order ID</th>
                  <th>Transaction ID</th>
                  <th>Status</th>
                  <th>Tran Date</th>
                  <th>View Orders</th>
                </tr>
                </thead>
                <tbody>
                <?php
                  if(is_array($trans) && count($trans)>0){
                    $i=1;
                    foreach ($trans as $trans_v) {
                      $udetail = $this->Master_model->getSingleRow('user_id',$trans_v->user_id,'user_accounts');
                      ?>
                      <tr>
                        <td><?=$i?></td>
                        <td><?php if($trans_v->user_id=="guest"){
                          echo $trans_v->cardholder_name;
                        }else {
                         echo $udetail->user_fname.' '.$udetail->user_lname; }?></td>
                         <td><?=$trans_v->payment_gross?> USD</td>
                         <td><?=$trans_v->order_id?></td>
                         <td><?=$trans_v->txn_id?></td>
                         <td><?=$trans_v->payment_status?>(Stripe)</td>
                        <td><?=date('m-d-Y',strtotime($trans_v->date))?></td>
                        <td>
                          <div class="action-button">
                           <a href="<?=admin_url('products/orders/'.$trans_v->order_id)?>" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
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