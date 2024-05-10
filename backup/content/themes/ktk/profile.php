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
					<div class="panel">
						<div class="panel-body bio-graph-info">
							<!-- <h1>Edit Profile</h1> -->
							<div class="addbus" id="addbus">
								<form class="dash-form" action="<?=site_url('myprofile')?>" role="form" enctype="multipart/form-data"  method="post">
									<div class="dash-form-item-full">
										<div class="dash-form-item-half">
											<b>First Name:</b>
											<input type="text" name="frm[user_fname]" value="<?=$udetail->user_fname?>">
										</div>
										<div class="dash-form-item-half">
											<b>Last Name:</b>
											<input type="text"  name="frm[user_lname]" value="<?=$udetail->user_lname?>">
										</div>      
									</div>
									<div class="dash-form-item-full">
										<b>Email Address:</b>
										<input type="email" name="frm[user_emailid]" value="<?=$udetail->user_emailid?>" readonly>
									</div> 
									<div class="dash-form-item-full">
										<b>Update Profile Pic:</b><br/>
										<input type="file" name="profile_pic" id="profile-img" accept="image/*">
									</div>
									<div class="dash-form-item-full">
										<b>Receive Messages From Customers Via:</b><br/>
										<div class="dash-radio">
											<div class="radio-item">
												<input type="radio" id="message" name="frm[messageType]" <?php if($udetail->messageType=='Email'){?>checked <?php } ?> value="Email"/> Email
											</div>
											<div class="radio-item">
												<input type="radio" id="message" name="frm[messageType]" <?php if($udetail->messageType=='Text'){?>checked <?php } ?> value="Text"/> Text
											</div>
										</div>
									</div> 
									<br>
									<input type="submit" value="Save Changes">
									<input type="submit" onclick="goBack()" value="Cancel">
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>