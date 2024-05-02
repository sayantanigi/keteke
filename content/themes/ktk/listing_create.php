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
                  if($userrl==1 || $userrl==2 || $userrl==3) { 
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
</div>
<div class="profile-info col-md-9">

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
  <div class="panel">
    <div class="panel-body bio-graph-info">
      <h1>Add Your Business</h1>
      <form class="dash-form" name="registration_business" action="<?=site_url('list-your-business')?>" role="form" enctype="multipart/form-data"  method="post">
        <h3>Business Details</h3>
        <div class="dash-form-item-full">
          <b>Business Name:<span class="red">&nbsp; *</span></b>
          <input type="text" name="frm[title]" required>
        </div> 
        <div class="dash-form-item-full">
          <div class="dash-form-item-half">
            <b class="tooltipicon">Business classification: <span class="tooltiptext">
            Choose from the list below </span><span class="red">&nbsp; *</span></b>
            <!-- <input type="text" name="frm[busi_classi]" required> -->
            <select name="frm[category]" required >
              <option value="">Select</option>
              <?php if(is_array($category) && count($category) >0){

               foreach ($category as $cat) { ?>
                 <option value="<?=$cat->id?>"><?=$cat->name?></option>
               <?php } } ?>
             </select>
           </div> 
          
           <div class="dash-form-item-half secondhalfbox" required> 
             <b>Keywords:<span class="red">&nbsp; *</span></b>
             <input type="text" name="frm[keywords]" required="">
           </div> 
         </div> 
         <div class="dash-form-item-full">
           <div class="dash-form-item-half">
            <b>Street Address<span class="red">&nbsp; *</span></b>
            <input type="text" name="frm[street_addr]" id="location" value="<?=$loc?>" required>
            <input type="hidden" id="search_lat" name="frm[lati]" value="<?=$lat?>">
            <input type="hidden" id="search_lon" name="frm[longi]" value="<?=$lon?>">
          </div>
          <div class="dash-form-item-half secondhalfbox">
            <b>City of business:<span class="red">&nbsp; *</span></b>
            <input type="text" name="frm[city]" value="<?=$city?>" required> 
          </div>        
        </div>
        <div class="dash-form-item-full" > 
         <div class="dash-form-item-half">
          <b>Country:<span class="red">&nbsp; *</span></b>
          <select name="frm[country]" required>
            <option value="">Select</option>
            <?php if(is_array($countries) && count($countries)>0){
              foreach ($countries as $cntry) { ?>
                <option value="<?=$cntry->id?>"><?=$cntry->name?></option>
              <?php } } ?>
            </select>
          </div> 
          <div class="dash-form-item-half secondhalfbox"> 
            <b>Website URL (If Available):</b>
            <input type="url" name="frm[website]" >
          </div>  
        </div> 

        <div class="dash-form-item-full">
          <div class="dash-form-item-half">
            <b>Company Email:<span class="red">&nbsp; *</span>
            </b>
            <span class="alert-red" id="mailiderror">Email format is wrong</span>
            <input type="email" name="frm[email]" id="comemail" required>
          </div>
          <div class="dash-form-item-half secondhalfbox">
            <b>Company Phone number:<span class="red">&nbsp; *</span></b>
            <input type="number"  name="frm[phone]" required>
          </div>      
        </div>
        <div class="dash-form-item-full">
          <div class="dash-form-item-half">
            <b>Facebook Link:
            </b>
            <input type="url" name="frm[fblink]">
          </div>
          <div class="dash-form-item-half secondhalfbox">
            <b>Twitter Link:</b>
            <input type="url"  name="frm[twlink]">
          </div>      
        </div>
        <div class="dash-form-item-full" style="padding-bottom:20px;">
          <b>Company Logo: </b><br><br>
          <div class="fileinput fileinput-new" data-provides="fileinput">

            <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;"> <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" /> </div>

            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>

            <div> <span class="btn default btn-file"> <span class="browsfle"> Browse Image </span>
              <div class="clearfix"></div>

              <input type="file" name="blogo" onchange = 'readURL(this);' style="margin-left:20px;" id="profile-img" accept="image/*">
            </span>
            <div class="clearfix"></div>
            <div class="btnlist">
              <span class="fileinput-exists btn"> Change </span> 
              <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a> 
            </div>
          </div>

        </div>


      </div>
      <br>
      <input type="submit" value="Add Business">
      <input type="submit" onclick="goBack()" value="Cancel">
    </form>
  </div>
</div>
</div> 
</div>
</div>
</div>
</main> 
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDPtZAQdkwdTzhen3vsljr7x22S3mL83-k&libraries=places"></script>
<script type="text/javascript">
  google.maps.event.addDomListener(window, 'load', function () {
    var places = new google.maps.places.Autocomplete(document.getElementById('location'));
    //alert(places);
    google.maps.event.addListener(places, 'place_changed', function () {
      var place = places.getPlace();
      var address = place.formatted_address;
      var latitude = place.geometry.location.lat();
      var longitude = place.geometry.location.lng();
      var mesg = "Address: " + address;
      mesg += "\nLatitude: " + latitude;
      mesg += "\nLongitude: " + longitude;
            //alert(mesg);
            $('#search_lat').val(latitude);
            $('#search_lon').val(longitude);
          });
  });
</script>
<script>
  $(document).ready(function() { 
    var location={
      latitude:'',
      longitude:''
    };
    if (navigator.geolocation){
      navigator.geolocation.getCurrentPosition(showPosition);
    }
    else{
    //latitudeAndLongitude.innerHTML="Geolocation is not supported by this browser.";
    //
  }

  function showPosition(position){ 
    location.latitude=position.coords.latitude;
    location.longitude=position.coords.longitude;
      //latitudeAndLongitude.innerHTML="Latitude: " + position.coords.latitude + 
      "<br>Longitude: " + position.coords.longitude; 
      var geocoder = new google.maps.Geocoder();
      var latLng = new google.maps.LatLng(location.latitude, location.longitude);
      $('#search_lat').val(location.latitude);
      $('#search_lon').val(location.longitude);

      if (geocoder) {
        geocoder.geocode({ 'latLng': latLng}, function (results, status) {
         if (status == google.maps.GeocoderStatus.OK) {
           console.log(results); 
           $('#location').val(results[0].formatted_address);

         }
         else {
          $('#location').html('Geocoding failed: '+status);
          console.log("Geocoding failed: " + status);
        }
      }); //geocoder.geocode()
      }      
  } //showPosition

});
</script>
<script>
  function getsubcat(catvalue){
    if(catvalue==1){
     $('#othersubcat').show();
     $('#subcatfff').hide();
   }else{
    $('#othersubcat').hide();
    $('#subcatfff').show();
    $('#othsubcat').val(' ');
    $.ajax({
      url:'<?=site_url("user/getsubcatbycatid")?>',
      type:'POST',
      dataType:'html',
      data:{catg:catvalue}
    })
    .done(function(e) {
      console.log(e);
      $("#wsubcats").html(e);
    });
  }
}
</script>
<script>
 $("#comemail").change(function(){
  var eemail = $("#comemail").val();
  var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
  if (!filter.test(eemail)) {
    $('#mailiderror').show();
    $("#comemail").val(' ');
  } else {
    $('#mailiderror').hide(); 
    return true;
  }
});
</script>
<script>
// Wait for the DOM to be ready
$(function() {
  // Initialize form validation on the registration form.
  // It has the name attribute "registration"
  $("form[name='registration_business']").validate({
    // Specify validation rules
    rules: {
      // The key name on the left side is the name attribute
      // of an input field. Validation rules are defined
      // on the right side
      frm[busi_classi]: "required",
      lastname: "required",
      email: {
        required: true,
        // Specify that email should be validated
        // by the built-in "email" rule
        email: true
      },
      password: {
        required: true,
        minlength: 5
      }
    },
    // Specify validation error messages
    messages: {
      firstname: "Please enter your firstname",
      lastname: "Please enter your lastname",
      password: {
        required: "Please provide a password",
        minlength: "Your password must be at least 5 characters long"
      },
      email: "Please enter a valid email address"
    },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
      form.submit();
    }
  });
});

</script>