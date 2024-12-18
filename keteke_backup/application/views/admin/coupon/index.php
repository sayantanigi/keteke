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
              <h3 class="card-title">Coupon Lists</h3>
            </div>
             
            <!-- /.box-header -->
            <div class="card-body">
              <div class="box-header with-border">
             <a href="<?=admin_url('coupon/add')?>" class="pull-right btn btn-warning btn-sm mb-3"><span class="fa fa-plus"></span> Add</a><br>
           </div>
              <table class="table table-bordered tablefontsmall">
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Image</th>
                  <th>Coupon Type</th>
                  <th>Code</th>
                  <th>Amount($)/ Percentage(%)</th>
                  <th>Created date</th>
                  <th>Expire date</th>
                  <th style="width: 50px">Status</th>
                  <th style="width: 80px">Action</th>
                </tr>
                <?php
                  if(is_array($products) && count($products)>0){
                    $i=1;
                    foreach ($products as $products_v) {
                      ?>
                      <tr>
                        <td><?=$i?></td>
                         <td><img src="<?=site_url('assets/images/coupons/'.$products_v->coupon_img)?>" title="" width="80px" onerror="this.src='<?=site_url('assets/images/no-image.png');?>';">
                        <td><?php if($products_v->coupon_type=="amount") {echo"Amount($)";}elseif($products_v->coupon_type=="percent"){echo "Percentage(%)";} ?></td>
                        <td><?=$products_v->coupon_code?></td>
                        <td><?=$products_v->coupon_amount?></td>
                        <td><?=$products_v->created_date?></td>
                        <td><?=$products_v->expiry_date?></td>
                        <td>
                          <?php
                          if($products_v->coupon_status == 1){
                            ?>
                            <a href="<?=admin_url('coupon/deactivate/'.$products_v->coupon_id )?>"><span class="badge bg-green">Active</span></a>
                            <?php
                          }
                          else{
                            ?>
                            <a href="<?=admin_url('coupon/activate/'.$products_v->coupon_id )?>"><span class="badge bg-red">Inactive</span></a>
                            <?php
                          }
                          ?>                          
                        </td>
                        <td>
                          <div class="action-button">
                            <a href="<?=admin_url('coupon/add/'.$products_v->coupon_id )?>" class="btn btn-xs btn-info"><i class="fa fa-edit" area-hidden="true"></i></a>
                            <a href="<?=admin_url('coupon/delete/'.$products_v->coupon_id )?>" class="btn btn-xs btn-danger delete"><i class="fa fa-trash" area-hidden="true"></i></a>
                          </div>
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