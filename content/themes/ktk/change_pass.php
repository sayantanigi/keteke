<main class="main-one" id="main-one" >  
  <div class="container">
   <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="122" height="109" viewBox="0 0 122 109">
    <defs>
      <style>
        .cls-1 {
          fill: red;
        }

        .cls-2 {
          filter: url(#Rectangle_22);
        }

        .cls-3 {
          filter: url(#Rectangle_21);
        }

        .cls-4 {
          filter: url(#Rectangle_20);
        }
      </style>
      <filter id="Rectangle_20" x="64" y="14" width="58" height="58" filterUnits="userSpaceOnUse">
        <feOffset input="SourceAlpha"/>
        <feGaussianBlur stdDeviation="3" result="blur"/>
        <feFlood flood-opacity="0.239"/>
        <feComposite operator="in" in2="blur"/>
        <feComposite in="SourceGraphic"/>
      </filter>
      <filter id="Rectangle_21" x="0" y="0" width="72" height="72" filterUnits="userSpaceOnUse">
        <feOffset input="SourceAlpha"/>
        <feGaussianBlur stdDeviation="3" result="blur-2"/>
        <feFlood flood-opacity="0.239"/>
        <feComposite operator="in" in2="blur-2"/>
        <feComposite in="SourceGraphic"/>
      </filter>
      <filter id="Rectangle_22" x="29" y="64" width="43" height="45" filterUnits="userSpaceOnUse">
        <feOffset input="SourceAlpha"/>
        <feGaussianBlur stdDeviation="3" result="blur-3"/>
        <feFlood flood-opacity="0.239"/>
        <feComposite operator="in" in2="blur-3"/>
        <feComposite in="SourceGraphic"/>
      </filter>
    </defs>
    <g id="Group_351" data-name="Group 351" transform="translate(-98 -288)">
      <g class="cls-4" transform="matrix(1, 0, 0, 1, 98, 288)">
        <rect id="Rectangle_20-2" data-name="Rectangle 20" class="cls-1" width="40" height="40" rx="10" transform="translate(73 23)"/>
      </g>
      <g class="cls-3" transform="matrix(1, 0, 0, 1, 98, 288)">
        <rect id="Rectangle_21-2" data-name="Rectangle 21" class="cls-1" width="54" height="54" rx="10" transform="translate(9 9)"/>
      </g>
      <g class="cls-2" transform="matrix(1, 0, 0, 1, 98, 288)">
        <rect id="Rectangle_22-2" data-name="Rectangle 22" class="cls-1" width="25" height="27" rx="4" transform="translate(38 73)"/>
      </g>
    </g>
  </svg>
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
         <h1>Change Password</h1>
         <div class="addbus" id="addbus">
          <?php
          if($this -> session -> flashdata('success')){
            ?>
            <div class="alert alert-success alert-dismissible">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <?php echo $this -> session -> flashdata('success'); ?>
            </div>
            <?php
          }
          if($this -> session -> flashdata('error')){
            ?>
            <div class="alert alert-danger alert-dismissible">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <?php echo $this -> session -> flashdata('error'); ?>
            </div>
            <?php
          }
          $err = validation_errors();
          if($err){
            ?>
            <div class="alert alert-warning alert-dismissible">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <?php echo $err; ?>
            </div>
            <?php
          }
          ?>
          <form class="dash-form" action="<?=site_url('change-password')?>" role="form"   method="post">
					<!-- 	<div class="dash-form-item-full">
						  <b>Current Password:</b>
						  <input type="password" name="new_pass" value="">
						</div> -->
						<div class="dash-form-item-full">
              <b>New Password:</b>
              <input type="password" name="new_pass" value="">
            </div> 
            <div class="dash-form-item-full">
              <b>Confirm New Password:</b>
              <input type="password" name="con_pass" value="">
            </div> 						
            <br>
            <input type="submit" value="Change">
            <a href="<?=site_url('change-password')?>" style="background: red;
  color: white !important;
  outline: none;
  padding: 2% 8%;
  width: auto;
  border: none;
  border-radius: 50px;">Cancel</a>
            <!-- <input type="submit" onclick="goBack()" value="Cancel"> -->
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>
</main>