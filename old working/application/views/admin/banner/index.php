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
              <h3 class="card-title">Banner List</h3>
            </div>
          <div class="card-body">
           
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered tablefontsmall">
                <tr>
                  <th style="width: 10px">#</th>
                  <th style="width: 150px">Image</th>
                  <th>Text</th>
                  <th>Link</th>
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
                        <td><img src="<?=site_url('assets/images/banner/'.$products_v->image)?>" title="<?=$products_v->name?>" width="80px" onerror="this.src='<?=site_url('assets/images/no-image.png');?>';">
                          <p><?php if($products_v->banner_type=='mbanner'){echo"Marketplace banner";}elseif($products_v->banner_type=='adv'){echo"Advertisement banner";} ?></p></td>
                        <td><?=$products_v->banner_text?></td>
                        <td><?=$products_v->link?></td>
                        <td>
                          <?php
                          if($products_v->status == 1){
                            ?>
                            <a href="<?=admin_url('banner/deactivate/'.$products_v->id)?>"><span class="badge bg-green">Active</span></a>
                            <?php
                          }
                          else{
                            ?>
                            <a href="<?=admin_url('banner/activate/'.$products_v->id)?>"><span class="badge bg-red">Inactive</span></a>
                            <?php
                          }
                          ?>                          
                        </td>
                        <td>
                          <div class="action-button">
                            <a href="<?=admin_url('banner/add/'.$products_v->id)?>" class="btn btn-xs btn-info"><i class="fa fa-edit" area-hidden="true"></i></a>
                            <a href="<?=admin_url('banner/delete/'.$products_v->id)?>" class="btn btn-xs btn-danger delete"><i class="fa fa-trash" area-hidden="true"></i></a>
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
        </div>
          <!-- /.box -->
        </div>
      </div>