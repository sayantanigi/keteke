<main class="main-one" id="main-one">
    <div class="container">
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="122" height="109"
            viewBox="0 0 122 109">
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
                    <feOffset input="SourceAlpha" />
                    <feGaussianBlur stdDeviation="3" result="blur" />
                    <feFlood flood-opacity="0.239" />
                    <feComposite operator="in" in2="blur" />
                    <feComposite in="SourceGraphic" />
                </filter>
                <filter id="Rectangle_21" x="0" y="0" width="72" height="72" filterUnits="userSpaceOnUse">
                    <feOffset input="SourceAlpha" />
                    <feGaussianBlur stdDeviation="3" result="blur-2" />
                    <feFlood flood-opacity="0.239" />
                    <feComposite operator="in" in2="blur-2" />
                    <feComposite in="SourceGraphic" />
                </filter>
                <filter id="Rectangle_22" x="29" y="64" width="43" height="45" filterUnits="userSpaceOnUse">
                    <feOffset input="SourceAlpha" />
                    <feGaussianBlur stdDeviation="3" result="blur-3" />
                    <feFlood flood-opacity="0.239" />
                    <feComposite operator="in" in2="blur-3" />
                    <feComposite in="SourceGraphic" />
                </filter>
            </defs>
            <g id="Group_351" data-name="Group 351" transform="translate(-98 -288)">
                <g class="cls-4" transform="matrix(1, 0, 0, 1, 98, 288)">
                    <rect id="Rectangle_20-2" data-name="Rectangle 20" class="cls-1" width="40" height="40" rx="10"
                        transform="translate(73 23)" />
                </g>
                <g class="cls-3" transform="matrix(1, 0, 0, 1, 98, 288)">
                    <rect id="Rectangle_21-2" data-name="Rectangle 21" class="cls-1" width="54" height="54" rx="10"
                        transform="translate(9 9)" />
                </g>
                <g class="cls-2" transform="matrix(1, 0, 0, 1, 98, 288)">
                    <rect id="Rectangle_22-2" data-name="Rectangle 22" class="cls-1" width="25" height="27" rx="4"
                        transform="translate(38 73)" />
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
                                if (isprologin()) {
                                    $user = userid2();
                                    $udetail = $this->db->get_where('user_accounts', array('user_id' => $user))->row();
                                }
                                if ($udetail->image == '') { ?>
                                    <img src="<?= site_url('assets/images/profile/user.png') ?>" alt="">
                                <?php } else { ?>
                                    <img src="<?= site_url('assets/images/profile/' . $udetail->image) ?>" alt="">
                                <?php } ?>
                            </a>
                            <h1><?= $udetail->user_fname . ' ' . $udetail->user_lname ?></h1>
                            <p><?= $udetail->user_emailid ?></p>
                        </div>
                        <?php
                        $userrl = userrole();
                        if ($userrl == 1 || $userrl == 2 || $userrl == 3) { ?>
                        <ul class="nav nav-pills nav-stacked">
                            <!-- <li <?php if ($load == 'search_history') { ?> class="active" <?php } ?>>
                                <a href="<?= site_url('user/search_history') ?>" id="business-but"> Search History</a>
                            </li> -->
                            <li <?php if ($load == 'profile') { ?> class="active" <?php } ?>>
                                <a href="<?= site_url('myprofile') ?>" class="dash-bots" id="profile-but"> Edit
                                    Profile</a>
                            </li>
                            <li <?php if ($load == 'listing_create') { ?> class="active" <?php } ?>>
                                <a href="<?= site_url('list-your-business') ?>" class="dash-bots" id="profile-but"> List
                                    your business</a>
                            </li>
                            <li <?php if ($load == 'listing') { ?> class="active" <?php } ?>>
                                <a href="<?= site_url('mylistings') ?>" class="dash-bots" id="profile-but"> My business
                                    listings</a>
                            </li>
                            <li <?php if ($load == 'change_pass') { ?> class="active" <?php } ?>>
                                <a href="<?= site_url('change-password') ?>" class="dash-bots" id="profile-but"> Change
                                    Password</a>
                            </li>
                            <li><a href="<?= site_url('signout') ?>" class="dash-bots" id="profile-but"> Signout</a></li>
                        </ul>
                        <?php } else { ?>
                        <ul class="nav nav-pills nav-stacked">
                            <li <?php if ($load == 'search_history') { ?> class="active" <?php } ?>>
                                <a href="<?= site_url('user/search_history') ?>" id="business-but"> Search History</a>
                            </li>
                            <li <?php if ($load == 'user_orders') { ?> class="active" <?php } ?>>
                                <a href="<?= site_url('user/userorders') ?>" id="business-but"> My Orders</a>
                            </li>
                            <li <?php if ($load == 'profile') { ?> class="active" <?php } ?>>
                                <a href="<?= site_url('myprofile') ?>" class="dash-bots" id="profile-but"> Edit
                                    Profile</a>
                            </li>
                            <li <?php if ($load == 'change_pass') { ?> class="active" <?php } ?>>
                                <a href="<?= site_url('change-password') ?>" class="dash-bots" id="profile-but"> Change
                                    Password</a>
                            </li>
                            <li><a href="<?= site_url('signout') ?>" class="dash-bots" id="profile-but"> Signout</a></li>
                        </ul>
                        <?php } ?>
                    </div>
                </div>
                <div class="profile-info col-md-9">
                    <?php if ($this->session->flashdata('success')) { ?>
                    <div class="alert alert-success alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <?php
                        echo $this->session->flashdata('success');
                        $this->session->unset_userdata('success');
                        ?>
                    </div>
                    <?php }
                    if ($this->session->flashdata('error')) { ?>
                    <div class="alert alert-danger alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <?php
                        echo $this->session->flashdata('error');
                        $this->session->unset_userdata('error');
                        ?>
                    </div>
                    <?php }
                    $err = validation_errors();
                    if ($err) { ?>
                    <div class="alert alert-warning alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <?php echo $err; ?>
                    </div>
                    <?php } ?>
                    <div class="panel">
                        <div class="panel-body bio-graph-info">
                            <h1>Update Business Information</h1>
                            <form class="dash-form" action="<?= site_url('update-list/' . $view_ad->id) ?>" role="form" enctype="multipart/form-data" method="post">
                                <div class="dash-form-item-full">
                                    <b>Business Name:<span class="red">&nbsp; *</span></b>
                                    <input type="text" name="frm[title]" required value="<?= $view_ad->title ?>">
                                </div>
                                <div class="dash-form-item-full">
                                    <div class="dash-form-item-half">
                                        <b class="tooltipicon">Business Classification: <span class="tooltiptext"> Choose from the list below </span><span class="red">&nbsp; *</span></b>
                                        <!-- <input type="text" name="frm[busi_classi]" required> -->
                                        <select name="frm[category]" required id="bus_category">
                                            <option value="">Choose an option</option>
                                            <?php if (is_array($category) && count($category) > 0) {
                                            foreach ($category as $cat) { ?>
                                            <option value="<?= $cat->id ?>" <?php if ($view_ad->category == $cat->id) { echo "selected"; } ?>><?= $cat->name ?> </option>
                                            <?php } } ?>
                                        </select>
                                    </div>
                                    <?php $getsubcatdata = $this->db->query("SELECT * FROM listing_category WHERE catid = '".$view_ad->category."' AND status = '1'")->result_array();?>
                                    <div class="dash-form-item-half secondhalfbox other_classi" style="display: <?php if(!empty($getsubcatdata)) {echo "block"; } else {echo "none"; }?>">
                                        <b>Mention Classification:<span class="red">&nbsp; *</span></b>
                                        <select name="frm[other_classi]" id="other_classi">
                                        <option value="">Select Sub Category</option>
                                        <?php
                                        foreach($getsubcatdata as $key) { ?>
                                        <option value="<?= $key['id']; ?>" <?php if($key['id'] == $view_ad->other_classi) {echo "selected"; }?>><?php echo $key['name'];?></option>
                                        <?php } ?>
                                        </select>
                                    </div>

                                    <div class="dash-form-item-half secondhalfbox" required>
                                        <b>Keywords:<span class="red">&nbsp; *</span></b>
                                        <input type="text" name="frm[keywords]" value="<?= $view_ad->keywords ?>">
                                    </div>
                                </div>
                                <div class="dash-form-item-full">
                                    <div class="dash-form-item-half">
                                        <b>Street Address<span class="red">&nbsp; *</span></b>
                                        <input type="text" name="frm[street_addr]" id="location" value="<?= $view_ad->street_addr ?>" required>
                                        <input type="hidden" id="search_lat" name="frm[lati]" value="<?= $view_ad->lati ?>">
                                        <input type="hidden" id="search_lon" name="frm[longi]" value="<?= $view_ad->longi ?>">
                                    </div>
                                    <div class="dash-form-item-half secondhalfbox">
                                        <b>City of business:<span class="red">&nbsp; *</span></b>
                                        <input type="text" name="frm[city]" value="<?= $view_ad->city ?>" required>
                                    </div>
                                </div>
                                <div class="dash-form-item-full">
                                    <div class="dash-form-item-half">
                                        <b>Country: <span class="red">&nbsp; *</span></b>
                                        <select name="frm[country]" required>
                                            <?php if (is_array($countries) && count($countries) > 0) {
                                            foreach ($countries as $cntry) { ?>
                                            <option value="<?= $cntry->id ?>" <?php if ($view_ad->country == $cntry->id) { echo "selected"; } ?>><?= $cntry->name ?> </option>
                                            <?php } } ?>
                                        </select>
                                    </div>
                                    <div class="dash-form-item-half secondhalfbox">
                                        <b>Website URL (If Available):</b>
                                        <input type="url" name="frm[website]" value="<?= $view_ad->website ?>">
                                    </div>
                                </div>
                                <div class="dash-form-item-full">
                                    <div class="dash-form-item-half">
                                        <b>Company Email:<span class="red">&nbsp; *</span></b>
                                        <input type="email" name="frm[email]" value="<?= $view_ad->email ?>" required>
                                    </div>
                                    <div class="dash-form-item-half">
                                        <b>Company Phone number:<span class="red">&nbsp; *</span></b>
                                        <input type="text" name="frm[phone]" value="<?= $view_ad->phone ?>" required maxlength="10">
                                    </div>
                                </div>
                                <div class="dash-form-item-full">
                                    <div class="dash-form-item-half">
                                        <b>Facebook Link:</b>
                                        <input type="url" name="frm[fblink]" value="<?= $view_ad->fblink ?>">
                                    </div>
                                    <div class="dash-form-item-half">
                                        <b>Twitter Link:</b>
                                        <input type="url" name="frm[twlink]" value="<?= $view_ad->twlink ?>">
                                    </div>
                                </div>
                                <div class="dash-form-item-full" style="padding-bottom:20px;">
                                    <b>Company Logo: </b><br><br>
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                            <?php if ($view_ad->images == "") { ?>
                                            <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
                                            <?php } else { ?>
                                            <img src="<?= site_url('assets/images/directory/' . $view_ad->images) ?>" alt="" />
                                            <?php } ?>
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                                        <div>
                                            <span class="btn default btn-file"> <span class="browsfle"> Browse Image </span>
                                                <div class="clearfix"></div>
                                                <input type="file" name="blogo" onchange='readURL(this);' style="margin-left:20px;" id="profile-img" accept="image/*">
                                            </span>
                                            <div class="clearfix"></div>
                                            <div class="btnlist">
                                                <span class="fileinput-exists btn"> Change </span>
                                                <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="submit" value="Update">
                                <input type="submit" onclick="goBack()" value="Cancel">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCtg6oeRPEkRL9_CE-us3QdvXjupbgG14A&libraries=places&callback=initMap"></script>
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
$(document).ready(function () {
    /*if($('#bus_category').val() == '1') {
        $('.other_classi').show();
        $('#other_classi').prop('required', true);
    } else {
        $('.other_classi').hide();
        $('#other_classi').prop('required', false);
        $('#other_classi').val('');
    }*/
    var location = {
        latitude: '',
        longitude: ''
    };
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    }
    else {
        //latitudeAndLongitude.innerHTML="Geolocation is not supported by this browser.";
        //
    }
    function showPosition(position) {
        location.latitude = position.coords.latitude;
        location.longitude = position.coords.longitude;
        //latitudeAndLongitude.innerHTML="Latitude: " + position.coords.latitude +
        "<br>Longitude: " + position.coords.longitude;
        var geocoder = new google.maps.Geocoder();
        var latLng = new google.maps.LatLng(location.latitude, location.longitude);
        $('#search_lat').val(location.latitude);
        $('#search_lon').val(location.longitude);
        if (geocoder) {
            geocoder.geocode({ 'latLng': latLng }, function (results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    console.log(results);
                    $('#location').val(results[0].formatted_address);
                }
                else {
                    $('#location').html('Geocoding failed: ' + status);
                    console.log("Geocoding failed: " + status);
                }
            }); //geocoder.geocode()
        }
    } //showPosition
});
function getsubcat(catval) {
    var catg = document.getElementById('cateid').value;
    if (catg == 5) {
        $('#othersubcat').show();
        $('#subcatfff').hide();
    } else {
        $('#othersubcat').hide();
        $('#subcatfff').show();
        $('#othsubcat').val(' ');
        $.ajax({
            url: '<?= site_url("user/getsubcatbycatid") ?>',
            type: 'POST',
            dataType: 'html',
            data: { catg: catg }
        })
        .done(function (e) {
            console.log(e);
            $("#wsubcats").html(e);
        });
    }
}
/*$('#bus_category').change(function() {
    if($('#bus_category').val() == '1') {
        $('.other_classi').show();
        $('#other_classi').prop('required', true);
    } else {
        $('.other_classi').hide();
        $('#other_classi').prop('required', false);
        $('#other_classi').val('');
    }
})*/

$('#bus_category').on('change', function() {
    var cat_id = $(this).val();
    $.ajax({
        type: "POST",
        url: "<?= site_url('user/getsubcategory') ?>",
        data: { cat_id: cat_id }, // Sending the category ID
        success: function(response) {
            if (response && response.length > 0) {
                $('.other_classi').show();
                $("#other_classi").html(response);
                $("#other_classi").prop('required', true);
            } else {
                $('.other_classi').hide();
                $('#other_classi').prop('required', false);
                $('#other_classi').val('');
            }
        },
        error: function(xhr, status, error) {
            // Handle any errors
            console.error(error);
        }
    });
});
</script>