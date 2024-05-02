<main class="main-one" id="main-one" > 

	<div class="container">
		
		<div class="bootstrap snippets bootdey">
			<div class="row">
				<div class="profile-nav col-md-3">
		<?php
          $this->load->front_view('user_sidebar',$this->data);
           ?>
				</div>
<div class="profile-info col-md-9">
	<div class="panel-body bio-graph-info">
		<h1>My draft Order History</h1>
		<!-- Single Tab Content Start -->
		<div class="myaccount-content">
			<div class="myaccount-table table-responsive text-center">
				<table class="table table-bordered">
					<thead class="thead-light">
						<tr>
							<th>No</th>
							<th>Name</th>
							<th>Quantity</th>
							<th>Price</th>
							<th>Shipping charge</th>
							<th>Transaction ID</th>
							<th>Order Date</th>
							<th>Order Status</th>
						</tr>
					</thead>
					<tbody>
						<?php if(is_array($mydraftorderslist) && count($mydraftorderslist)>0){
							$i=0;
							foreach ($mydraftorderslist as $myord) {
								$prdetls=$this->Master_model->getSingleRow('productId',$myord->product_id,'products');
								$trdetls=$this->Master_model->getSingleRow('id',$myord->draftpayment_orderid,'draftorders_payment');
								$i++;

								?>
								<tr>
									<td><?=$i?></td>
									<td><?=$prdetls->productName?></td>
									<td><?=$myord->qty?></td>
									<td>USD <?=$myord->price?></td>
									<td><?php if($myord->shipping_charge !=NULL){ echo $myord->shipping_charge.' USD'; } ?></td>
									<td><?=$trdetls->txn_id?></td>
									<td><?=date('d M Y',strtotime($trdetls->tran_date))?></td>
									<td><?=$myord->order_status?><br>
										<a href="##" class="btn btn-warning">Track</a></span>
									</td>
								</tr>
							<?php } } else { ?>
								<tr>
									<td colspan="8">
										<h4>No draft Orders..</h4>
									</td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
			<!-- Single Tab Content End -->
		</div>
	</div>
</div>
</div>
</div>
</main>