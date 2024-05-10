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
		<h1>My Order History</h1>
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
							<th>Order ID</th>
							<th>Order Date</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php if(is_array($myorderslist) && count($myorderslist)>0){
							$i=0;
							foreach ($myorderslist as $myord) {
								$returndays= $myord->return_day;
						$curdate=date("Y-m-d H:i:s");
                        $dayc = (strtotime($curdate)-strtotime($myord->order_complete_date)) / (60 * 60 * 12);
                        $days= round($dayc);

								$i++;


								?>
								<tr>
									<td><?=$i?></td>
									<td><?=$myord->prd_title?></td>
									<td><?=$myord->quantity?></td>
									<td>$<?=$myord->amount?>.00</td>
									<td><?=$myord->shipping_charge?></td>
									<td><?=$myord->orderid?></td>
									<td><?=date('d M Y',strtotime($myord->order_date))?></td>
									<td><?=$myord->order_status?></td>
									<td>
									<?php if($myord->order_status=='completed' && $returndays < $days ){ ?>
										<a href="<?=site_url('user/return_order/'.base64_encode($myord->id).'/'.$myord->product_id)?>" class="btn btn-danger">Return</a>
									<?php } ?>
									</td>
								</tr>
							<?php } } else { ?>
								<tr>
									<td colspan="8">
										<h4>No Orders..</h4>
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