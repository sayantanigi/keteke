<main class="main-one" id="main-one" >  
        <!--section class="dash-box" id="dash-box">
          <div class="dash-but-box no-mobile">
            <a href="<?=site_url('user/search_history')?>" class="active" id="business-but"> Search History</a>
            <a href="<?=site_url('user/mylistings')?>" class="dash-bots" id="profile-but"> My Listings</a>
            <a href="<?=site_url('user/edit_profile')?>" class="dash-bots" id="profile-but"> Edit Profile</a>
            <a href="<?=site_url('user/changepassword')?>" class="dash-bots" id="profile-but"> Change Password</a>
            <a href="<?=site_url('signout')?>" class="dash-bots" id="profile-but"> Signout</a>
            </div>
          <div class="mobile" >
            <a href="<?=site_url('user/search_history')?>" class="active" id="business-mob-but"> Search History</button>
            <a href="<?=site_url('user/mylistings')?>" class="dash-bots" id="profile-but"> My Listings</a>
            <a href="<?=site_url('user/edit_profile')?>" class="dash-bots" id="profile-mob-but"> Edit Profile</a>
            <a href="<?=site_url('user/changepassword')?>" class="dash-bots" id="profile-mob-but"> Change Password</a>
            <a href="<?=site_url('signout')?>" class="dash-bots" id="profile-mob-but"> Signout</button>
            </div>
          <div class="dash-main-box"> 
            <h2>Welcome <?=$udetail->user_fname?></h2>
            <div class="addedbus" id="business">
                            
            </div>
            <div class="profile-box" id="profile">
              <div class="profile">
                <div class="row"> 
                  <div class="col-11">
                    <span class="busnam"><?=$udetail->user_fname.' '.$udetail->user_lname?></span>
                    <br>
                    <?=$udetail->user_emailid?><br><br><br>
                   
                  </div>
                </div>
              </div>
            </div>
          </div>  
        </section-->
		
		
		<div class="container">

		<div class="bootstrap snippets bootdey">
		<div class="row">
		<?php
       $userrl=userrole();
     if($userrl==1 || $userrl==2 || $userrl==3) { ?>
      <?=$this->load->front_view('sidebar')?>
    <?php }else{ ?>
    <?=$this->load->front_view('usersidebar')?>
    <?php } ?>
		  <div class="profile-info col-md-9">
			  <div class="panel">
				  <div class="panel-body bio-graph-info">
					  <h1>Bio Graph</h1>
					  <div class="row">
						  <div class="bio-row">
							  <p><span>First Name </span>: Camila</p>
						  </div>
						  <div class="bio-row">
							  <p><span>Last Name </span>: Smith</p>
						  </div>
						  <div class="bio-row">
							  <p><span>Country </span>: Australia</p>
						  </div>
						  <div class="bio-row">
							  <p><span>Birthday</span>: 13 July 1983</p>
						  </div>
						  <div class="bio-row">
							  <p><span>Occupation </span>: UI Designer</p>
						  </div>
						  <div class="bio-row">
							  <p><span>Email </span>: jsmith@flatlab.com</p>
						  </div>
						  <div class="bio-row">
							  <p><span>Mobile </span>: (12) 03 4567890</p>
						  </div>
						  <div class="bio-row">
							  <p><span>Phone </span>: 88 (02) 123456</p>
						  </div>
					  </div>
				  </div>
			  </div>
		  </div>
		</div>
		</div>
		</div>
      </main>