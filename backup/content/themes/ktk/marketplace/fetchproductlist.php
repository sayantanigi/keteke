 <?php if(is_array($catproducts) && count($catproducts)>0){
    $k=0;
  foreach ($catproducts as $mp) { $k++;?>
<tr>
    <td><?=$k?></td>
    <td><?=$mp->productName?></td>
    <td><?=date('M d, Y',strtotime($mp->created))?></td>
    <td>
      <?php if($mp->status !=1){ ?>
      <span class="btn btn-warning btn-xs">Deactive</span>
    <?php }else { ?>
      <span class="btn btn-success btn-xs">Active</span>
    <?php } ?>
    </td>
    <td>$<?=$mp->offprice?></td>
    <td><a href="<?=site_url('view-product/'.$mp->productId)?>" class="btn btn-warning btn-xs">View</a></td>
    <td><a href="#" class="btn btn-primary btn-xs">Edit</a></td>
    <td><a href="<?=site_url('Deleteproduct/'.$mp->productId)?>" class="btn btn-danger btn-xs delete">Delete</a></td>
</tr>
<?php } }else{ ?>
  <tr><td colspan="6">
    No products found..
  </td></tr>
  <?php } ?>