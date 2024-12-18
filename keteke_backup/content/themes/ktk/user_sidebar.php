					<div class="panel">
						<div class="user-heading round">
							<a href="#">
								<?php
								if(isprologin()){
									$user = userid2();
									$udetail = $this->db->get_where('user_accounts',array('user_id'=>$user))->row();
								}
								if($udetail->image==''){ ?>
									<img src="<?=site_url('assets/images/profile/user.png')?>" alt="">
								<?php } else { ?>
									<img src="<?=site_url('assets/images/profile/'.$udetail->image)?>" alt="">
								<?php } ?>
							</a>
							<h1><?=$udetail->user_fname.' '.$udetail->user_lname?></h1>
							<p><?=$udetail->user_emailid?></p>
						</div>
						<?php
						$userrl=userrole();
						if($userrl==1 || $userrl==2) { 
							?>
							<ul class="nav nav-pills nav-stacked"> 
      <!-- <li <?php if($load=='search_history'){ ?> class="active" <?php } ?>>
        <a href="<?=site_url('user/search_history')?>" id="business-but"> Search History</a>
    </li> -->
    <li <?php if($load=='profile'){ ?> class="active" <?php } ?>>
    	<a href="<?=site_url('myprofile')?>" class="dash-bots" id="profile-but"> Edit Profile</a>
    </li>
    <li <?php if($load=='listing_create'){ ?> class="active" <?php } ?>>
    	<a href="<?=site_url('list-your-business')?>" class="dash-bots" id="profile-but"> List your business</a>
    </li>
    <li <?php if($load=='listing'){ ?> class="active" <?php } ?>>
    	<a href="<?=site_url('mylistings')?>" class="dash-bots" id="profile-but"> My business listings</a>
    </li>
    <li <?php if($load=='change_pass'){ ?> class="active" <?php } ?>>
    	<a href="<?=site_url('change-password')?>" class="dash-bots" id="profile-but"> Change Password</a>
    </li>
    <li><a href="<?=site_url('signout')?>" class="dash-bots" id="profile-but"> Signout</a></li>
</ul>
<?php }else{ ?>
	<ul class="nav nav-pills nav-stacked">
		<li <?php if($load=='search_history'){ ?> class="active" <?php } ?>>
			<a href="<?=site_url('user/search_history')?>" id="business-but"> Search History</a>
		</li>
		<li <?php if($load=='user_orders'){ ?> class="active" <?php } ?>>
			<a href="<?=site_url('user/userorders')?>" id="business-but"> My Orders</a>
		</li>
		<li <?php if($load=='user_draft_orders'){ ?> class="active" <?php } ?>>
			<a href="<?=site_url('user/userdraftorders')?>" id="business-but"> My Draft Orders</a>
		</li>
		<li <?php if($load=='profile'){ ?> class="active" <?php } ?>>
			<a href="<?=site_url('myprofile')?>" class="dash-bots" id="profile-but"> Edit Profile</a>
		</li>
		<li <?php if($load=='change_pass'){ ?> class="active" <?php } ?>>
			<a href="<?=site_url('change-password')?>" class="dash-bots" id="profile-but"> Change Password</a>
		</li>
		<li><a href="<?=site_url('signout')?>" class="dash-bots" id="profile-but"> Signout</a></li>
	</ul>
<?php } ?>
</div>