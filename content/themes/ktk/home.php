<main class="main-one" id="main-one">
    <section class="container">
        <div class="home-part-one">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-xl-6 col-lg-6 search">
                    <form action="<?= site_url('service-list'); ?>" method="post">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="50"
                            height="60" viewBox="0 0 122 109">
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
                                <filter id="Rectangle_20" x="64" y="14" width="58" height="58"
                                    filterUnits="userSpaceOnUse">
                                    <feOffset input="SourceAlpha" />
                                    <feGaussianBlur stdDeviation="3" result="blur" />
                                    <feFlood flood-opacity="0.239" />
                                    <feComposite operator="in" in2="blur" />
                                    <feComposite in="SourceGraphic" />
                                </filter>
                                <filter id="Rectangle_21" x="0" y="0" width="72" height="72"
                                    filterUnits="userSpaceOnUse">
                                    <feOffset input="SourceAlpha" />
                                    <feGaussianBlur stdDeviation="3" result="blur-2" />
                                    <feFlood flood-opacity="0.239" />
                                    <feComposite operator="in" in2="blur-2" />
                                    <feComposite in="SourceGraphic" />
                                </filter>
                                <filter id="Rectangle_22" x="29" y="64" width="43" height="45"
                                    filterUnits="userSpaceOnUse">
                                    <feOffset input="SourceAlpha" />
                                    <feGaussianBlur stdDeviation="3" result="blur-3" />
                                    <feFlood flood-opacity="0.239" />
                                    <feComposite operator="in" in2="blur-3" />
                                    <feComposite in="SourceGraphic" />
                                </filter>
                            </defs>
                            <g id="Group_351" data-name="Group 351" transform="translate(-98 -288)">
                                <g class="cls-4" transform="matrix(1, 0, 0, 1, 98, 288)">
                                    <rect id="Rectangle_20-2" data-name="Rectangle 20" class="cls-1" width="40"
                                        height="40" rx="10" transform="translate(73 23)" />
                                </g>
                                <g class="cls-3" transform="matrix(1, 0, 0, 1, 98, 288)">
                                    <rect id="Rectangle_21-2" data-name="Rectangle 21" class="cls-1" width="54"
                                        height="54" rx="10" transform="translate(9 9)" />
                                </g>
                                <g class="cls-2" transform="matrix(1, 0, 0, 1, 98, 288)">
                                    <rect id="Rectangle_22-2" data-name="Rectangle 22" class="cls-1" width="25"
                                        height="27" rx="4" transform="translate(38 73)" />
                                </g>
                            </g>
                        </svg>
                        <h1 class="main-page-phrase-mobile">
                            Connecting you with African/Diasporan businesses and Social life.
                            Explore and experience black excellence.
                            <br>
                        </h1>
                        <div class="home-form formFieldBox">
                            <label>Your Location</label>
                            <div class="input-group"><i class="fa fa-map-marker"></i>
                                <input type="text" name="location" id="location" value="<?= @$loc ?>" placeholder="Location..." />
                                <input type="hidden" id="search_lat" name="s_lat" value="<?= @$lat ?>">
                                <input type="hidden" id="search_lon" name="s_lon" value="<?= @$lon ?>">
                            </div>
                        </div>
                        <div class="home-form selectsearch formFieldBox ">
                            <label>Type of business</label>
                            <div class="input-group"><i class="fa fa-search"></i>
                                <select class="select2 choose-option" data-live-search="true" name="sr_category"
                                    required>
                                    <option value="">Choose</option>
                                    <?php if (is_array($category) && count($category) > 0) {
                                        foreach ($category as $cat) { ?>
                                            <option value="<?= $cat->id ?>"><?= $cat->name ?></option>
                                        <?php }
                                    } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-item-submit homesubmit">
                            <input class="nirmala-semilight " name="search" type="submit" />
                        </div>
                    </form>
                </div>
                <div class="col-6 search-opp-display">
                    <img src="<?= site_url() ?>fassets/images/svg%20items/Group%2047.svg">
                </div>
            </div>
        </div>
    </section>
    <section class="coupon-searched">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-xl-8 col-lg-8 ">
                    <div class="coupons">
                        <h2 class=" red">
                            Coupons<br>
                            <span class=" black">We got you the best offers!</span>
                        </h2>
                        <ul>
                        <?php if (is_array($coupons) && count($coupons) > 0) {
                            foreach ($coupons as $coup) { ?>
                            <li> <img src="<?= site_url('assets/images/coupons/' . $coup->coupon_img) ?>" style="width:100%;"></li>
                        <?php } } ?>
                        </ul>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-xl-4 col-lg-4 ">
                    <div class="most-searched-section">
                        <h2 class=" red"><span class="glyphicon glyphicon-search red search-icon"></span>Most popular searched</h2>
                        <ul class="frontbtns">
                            <li> Room for Rent</li>
                            <li> Clothing </li>
                            <li> Restaurants </li>
                            <li> Social Events </li>
                            <li> Worship </li>
                            <li> Professional Groups</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="in-area-most-popular-search">
        <div class=" container">
            <h1 class=" red">Popular at your place</h1>
            <div class="row">
                <?php
                if(!empty($chlist)) {
                foreach ($chlist as $list) {
                    $cat = $this->db->get_where('category', array('id' => $list['busi_classi']))->row();
                    if(!empty($list['images']) && file_exists('assets/images/directory/'.$list['images'])) {
                        $image = base_url().'assets/images/directory/'.$list['images'];
                    } else {
                        $image = base_url().'assets/images/no-image.png';
                    }
                ?>
                <div class="col-6 col-lg-3 col-md-3 col-xs-4  text-center">
                    <div class="iamps-item">
                        <img src="<?= @$image ?>" style="width:100%; height: 210px">
                        <div class="iamps-detail">
                            <h2 class=""><?= $list['title'] ?></h2>
                            <p class=""><?= $cat->name ?> <br> <?= round($list['distance'], 0) ?> meter</p>
                        </div>
                    </div>
                </div>
                <?php } } else { ?>
                <p class="">No listing found</p>
                <?php } ?>
            </div>
            <p class="iamps-more red">More > </p>
        </div>
    </section>
</main>
<style>
.most-searched-section{ padding: 2px 15px !important;}
</style>
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
</script>
<script>
    $(document).ready(function () {
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
</script>