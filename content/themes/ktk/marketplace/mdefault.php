<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0; name='viewport'" />
    <meta name="viewport" content="width=device-width" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="<?= site_url('fassets/images/favicon.png') ?>">
    <link rel="stylesheet" type="text/css" href="<?= site_url() ?>fassets/css/fontfamily.css">
    <link rel="stylesheet" type="text/css" href="<?= site_url() ?>fassets/css/style.css">
    <link rel="stylesheet" href="<?= site_url() ?>fassets/css/select2.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link href="<?= site_url() ?>fassets/marketplace/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <!--- marketplace csss ---------->
    <link rel="stylesheet" href="<?= site_url() ?>fassets/marketplace/css/vendors.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?= site_url() ?>fassets/marketplace/css/style.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?= site_url() ?>fassets/marketplace/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?= site_url() ?>fassets/marketplace/css/bootstrap-tagsinput.css" rel="stylesheet" />
    <!--- end marketplace csss ---------->
    <script>
        $(window).on("load", function () {
            $("#loader").fadeOut();
        });
        function goBack() {
            window.history.back();
        }
    </script>
    <title><?= $title ?> </title>
    <style>
        #logo-sec {
            display: none;
        }
    </style>
</head>
<body class="noselect ostop">
    <div class="pre-loader" id="loader">
        <div class="loder">
            <h3 style="color:white;">Loading....</h3>
        </div>
    </div>
    <div class="complete bg">
        <header id="head-bar">
            <div class="container">
                <div class="head-bar">
                    <div class="row">
                        <div class="col-xs-6 icon" onclick="open_mobile_nav();">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28.37" height="17.346"
                                viewBox="0 0 28.37 17.346">
                                <defs>
                                    <style>
                                        .cls-1 {
                                            fill: none;
                                            stroke: red;
                                            stroke-linecap: round;
                                            stroke-width: 2px;
                                        }
                                    </style>
                                </defs>
                                <g id="Group_215" data-name="Group 215" transform="translate(-22.5 -27.5)">
                                    <line id="Line_11" data-name="Line 11" class="cls-1" x2="26.37" transform="translate(23.5 36.173)" />
                                    <line id="Line_12" data-name="Line 12" class="cls-1" x2="11.024" transform="translate(23.5 43.846)" />
                                    <line id="Line_13" data-name="Line 13" class="cls-1" x2="17.722" transform="translate(23.5 28.5)" />
                                </g>
                            </svg>
                        </div>
                        <div class="col-sx-3 col-sm-3 col-md-3 col-xl-3 col-lg-3 logo">
                            <a href="<?php echo base_url(); ?>">
                                <img src="<?= site_url() ?>fassets/images/logos/headertransparentlogo.png"
                                    class="logo-main" id="logo-main"></a>
                            <a href="<?php echo base_url(); ?>">
                                <img src="<?= site_url() ?>fassets/images/logos/headertransparentlogo.png" height="40px"
                                    id="logo-sec" class="logo-sec"></a>
                        </div>
                        <div class="col-12 col-sx-9 col-sm-9 col-md-9 col-xl-9 col-lg-9 right">
                            <?php
                            // $cartItems = $this->cart->contents();
                            // if ($cartItems) {
                            //     $total = count($cartItems);
                            // } else {
                            //     $total = 0;
                            // }
                            $cartItems = $this->db->query("SELECT * FROM add_to_cart WHERE session_id = '".$this->session->userdata('session_id')."'")->result_array();
                            if ($cartItems) {
                                $total = count($cartItems);
                            } else {
                                $total = 0;
                            }
                            ?>
                            <div class="head-bar-nav">
                                <ul>
                                    <?php
                                    $userrl = userrole();
                                    $user = userid2();
                                    $ud = $this->db->get_where('user_accounts', array('user_id' => $user))->row();
                                    if ($userrl == 1 || $userrl == 2) {
                                        ?>
                                        <li class="black"><a href="<?= site_url('shop') ?>"> Home </a></li>
                                        <!-- <li class="black"><a href="<?= site_url('shop') ?>"><i class="fa fa-shopping-bag" aria-hidden="true"></i> Marketplace </a></li> -->
                                        <li class="black dorpmenu"><a href="<?= site_url('myprofile') ?>"><i
                                                    class="fa fa-user" aria-hidden="true"></i> <?= $ud->user_fname." ".$ud->user_lname ?><span
                                                    class="caret"></span></a>
                                            <ul class="dropdownmenu">
                                                <li><a href="<?= site_url('signout') ?>">Logout</a></li>
                                            </ul>
                                        </li>
                                        <li class="black"><a href="<?= site_url('list-your-business') ?>"> List your
                                                business</a></li>
                                    <?php } elseif ($userrl == 3) { ?>
                                        <li class="black"> <a href="<?= site_url('shop') ?>">Home </a></li>
                                        <li class="black"><a href="<?= site_url('list-your-business') ?>"> List your
                                                business</a></li>
                                        <li class="black"><a href="<?= site_url('seller-dashboard') ?>"><i
                                                    class="fa fa-shopping-bag" aria-hidden="true"></i> Sell My Product </a>
                                        </li>
                                        <li class="black dorpmenu"><a href="<?= site_url('seller-dashboard') ?>"><i
                                                    class="fa fa-user" aria-hidden="true"></i> <?= $ud->user_fname." ".$ud->user_lname ?><span
                                                    class="caret"></span></a>
                                            <ul class="dropdownmenu">
                                                <li><a href="<?= site_url('signout') ?>">Logout</a></li>
                                            </ul>
                                        </li>
                                        <!-- <li class="black"><a href="<?= site_url('signout') ?>"> Signout </a></li> -->
                                    <?php } elseif ($userrl == 4) { ?>
                                        <li class="black"><a href="<?= site_url('shop') ?>"> Home </a></li>
                                        <!-- <li class="black"><a href="<?= site_url('shop') ?>"><i class="fa fa-shopping-bag" aria-hidden="true"></i> Marketplace </a></li> -->
                                        <li class="black dorpmenu"><a href="<?= site_url('userdashboard') ?>"><i
                                                    class="fa fa-user" aria-hidden="true"></i> <?= $ud->user_fname." ".$ud->user_lname ?><span
                                                    class="caret"></span></a>
                                            <ul class="dropdownmenu">
                                                <li><a href="<?= site_url('signout') ?>">Logout</a></li>
                                            </ul>
                                        </li>
                                        <li class="black"><a href="<?= site_url('signout') ?>"> Signout </a></li>
                                    <?php } elseif ($userrl == 0) { ?>
                                        <li class="black"><a href="<?= site_url('shop') ?>"> Home </a></li>
                                        <li class="black"><a href="<?= site_url('login') ?>"> Login/Signup </a></li>
                                        <!-- <li class="black"><a href="<?= site_url('shop') ?>"><i class="fa fa-shopping-bag" aria-hidden="true"></i> Marketplace </a></li> -->
                                        <li class="black"><a href="<?= site_url('list-your-business') ?>"> List your
                                                business</a></li>
                                    <?php } ?>
                                </ul>
                            </div>
                            <div class="cleafix"></div>
                            <div class="top-menumarketplace">
                                <ul class="marketList">
                                    <li>
                                        <div class="searchpnl-m">
                                            <form action="<?= site_url('search') ?>" method="GET">
                                                <input type="text" name="prdname" class="srchBox-m"
                                                    placeholder="Search for items or search">
                                                <button class="srchbtn-m" type="submit"><i
                                                        class="icon-search"></i></button>
                                            </form>
                                        </div>
                                    </li>
                                    <li>
                                        <a href="<?= site_url('shop/pr_cart') ?>" class="cartmenuM">
                                            <i class="icon-shopping-cart"></i><span><?= $total ?></span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <nav class="mobile-nav animate__animated" id="nav-mobile">
            <div class="close-button nirmala" onclick="close_mobile_nav();">Close</div>
            <a href="../keteke">
                <img src="<?= site_url() ?>fassets/images/logos/whitecolor.png" class="mobile-nav-img nirmala"></a>
            <ul class="nirmala-light">
                <li><a href="<?= site_url('login') ?>"> Login</a> </li>
                <li><a href="<?= site_url('signup') ?>"> Signup </a></li>
                <li><a href="<?= site_url('list-your-business') ?>"> List your business </a></li>
                <li><a href="#"> Get Coupons </a></li>
            </ul>
        </nav>
        <div class="marketplacenav">
            <div class="container" style="max-width: fit-content;">
                <div class="row">
                    <div class="col-lg-12">
                        <!--====================  navigation top search ====================-->
                        <div class="navigation-top-search-area mt-md-25 mt-sm-25">
                            <div class="row align-items-left">
                                <div class="col-12 col-md-12 order-lg-2">
                                    <!-- navigation section -->
                                    <div class="main-menu main-menu--separate d-none d-lg-block">
                                        <nav>
                                            <ul>
                                            <?php
                                            $mgtcat = $this->db->get_where('mrkt_category', array('status' => 1))->result();
                                            if (is_array($mgtcat) && count($mgtcat) > 0) {
                                                foreach ($mgtcat as $mgc) {
                                                    $submenu = $this->db->get_where('marketplace_submenu', array('cat_id' => $mgc->id, 'status' => 1))->result(); ?>
                                                    <li <?php if (count($submenu) > 0) { ?> class="menu-item-has-children" <?php } ?>>
                                                        <a href="<?= base_url('products') . '?catId=' . base64_encode($mgc->id) ?>"><?= $mgc->name ?></a>
                                                        <?php if (count($submenu) > 0) { ?>
                                                            <ul class="sub-menu">
                                                                <?php foreach ($submenu as $smenu) { ?>
                                                                    <li><a href="<?= base_url('shop/prsub_list') . '?subcatid=' . base64_encode($smenu->submenuId) ?>"><?= $smenu->name ?></a></li>
                                                                <?php } ?>
                                                            </ul>
                                                        <?php } ?>
                                                    </li>
                                            <?php } } ?>
                                            </ul>
                                        </nav>
                                    </div>
                                    <!-- end of navigation section -->
                                    <!-- Mobile Menu -->
                                    <div class="mobile-menu-wrapper d-block d-lg-none pt-15">
                                        <div class="mobile-menu"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--====================  End of navigation top search  ====================-->
                    </div>
                </div>
            </div>
        </div>
        <div class="search-overlay" id="search-overlay">
            <a href="javascript:void(0)" class="close-search-overlay" id="close-search-overlay">
                <i class="ion-ios-close-empty"></i>
            </a>
            <!--=======  search form  =======-->
            <div class="search-form">
                <form action="#">
                    <input type="search" placeholder="Search entire store here ...">
                    <button type="submit"><i class="icon-search"></i></button>
                </form>
            </div>
            <!--=======  End of search form  =======-->
        </div>
        <?php $this->load->front_view($load); ?>
        <footer class="foot">
            <div class="container">
                <div class="row  contact-item">
                    <div class=" col-xs-12 col-sm-4 col-md-4 col-xl-3 col-lg-3 logo-foot">
                        <a href="<?php echo base_url(); ?>">
                            <img src="<?= site_url() ?>fassets/images/logos/headertransparentlogo.png" width="60%;">
                        </a>
                        <div class="social-one">
                            <a href="<?= theme_option('insta') ?>" class="fa fa-instagram"></a>
                            <a href="<?= theme_option('twitter') ?>" class="fa fa-twitter"></a>
                            <a href="<?= theme_option('facebook') ?>" class="fa fa-facebook"></a>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-4 col-xl-3 col-lg-3">
                        <h3 class="nirmala-regular-lt"> Information </h3>
                        <p class="nirmala-regular-lt">
                            <a href="<?= site_url('about') ?>">About us</a><br>
                            <a href="<?= site_url('reach') ?>">Reach us</a><br>
                            <a href="<?= site_url('list-your-business') ?>">List your Business</a>
                        </p>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-4 col-xl-3 col-lg-3">
                        <h3 class="nirmala-regular-lt"><a href="<?php echo base_url(); ?>reach">
                                Contact</a>
                        </h3>
                        <p class="nirmala-regular-lt">
                            <a href="tel:<?= theme_option('phone') ?>"><?= theme_option('phone') ?></a><br>
                            <a href="mailto:<?= theme_option('email') ?>"><?= theme_option('email') ?></a>
                        </p>
                        <a href="https://www.freecounterstat.com" title="visitor counter script">
                            <img class="counterwidth"
                                src="https://counter10.stat.ovh/private/freecounterstat.php?c=xkun6ugmt9tqt3z242k7c99g84wddk1c"
                                border="0" title="visitor counter script" alt="visitor counter script">
                        </a>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-4 col-xl-3 col-lg-3">
                        <h3 class="nirmala-regular-lt"> Subscribe </h3>
                        <form class="subscription-form" action="javascript:void(0);" onsubmit="getsubscribe()"
                            method="post">
                            <div id="getshow"></div>
                            <div class="subscription-form-item">
                                <img src="<?= site_url() ?>fassets/images/icon/email-icon.png"
                                    style="width:18px;height:14px; margin:5px;">
                                <input class="nirmala-light" type="email" placeholder="Email" id="sub-mail" required>
                            </div>
                            <div class="subscription-form-item-sub nirmala-light">
                                <input type="submit" value="Submit">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="copyright mirmala-semilight">
                    <span style="word-wrap: break-word;">@ 2020 Copyright Keteke. All Rights Reserved </span>
                    <a href="<?= site_url('privacy-policy') ?>"><span class="nirmala-bold red"
                            style="word-wrap: break-word;"> &bull;Privacy Policy</span></a>
                    <a href="<?= site_url('terms') ?>">
                        <span class="nirmala-bold red" style="word-wrap: break-word;"> &bull;Terms</span>
                    </a>
                </div>
            </div>
        </footer>
        <!----end footer part -->
    </div>
    <script src="<?= site_url() ?>fassets/js/login-signup.js"></script>
    <script src="<?= site_url() ?>fassets/js/sticky.js"></script>
    <script src="<?= site_url() ?>fassets/js/mobile.js"></script>
    <script src="<?= site_url() ?>fassets/marketplace/js/vendors.js"></script>
    <script src="<?= site_url() ?>fassets/marketplace/js/active.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <!-- <script src="<?= site_url() ?>fassets/marketplace/js/shieldui-all.min.js"></script> -->
    <script src="<?= site_url() ?>fassets/marketplace/sweetalert/sweetalert.min.js"></script>
    <script src="<?= site_url() ?>fassets/marketplace/sweetalert/jquery.sweet-alert.custom.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/plug-ins/1.10.22/sorting/datetime-moment.js">
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?= site_url() ?>fassets/marketplace/js/bootstrap-tagsinput.js"></script>
    <script>
        $(document).ready(function () {
            $('#ex').DataTable();
        });
    </script>
    <script>
        function getsubscribe() {
            var email = document.getElementById('sub-mail').value;
            $.ajax({
                url: '<?= site_url("welcome/newsletter") ?>',
                type: 'POST',
                dataType: 'html',
                data: { email: email },
            })
                .done(function (e) {
                    if (e == 1) {
                        $('#getshow').html('<div class="alert alert-danger"><b>Already Subscribed !!</b></div>');
                        $('#sub-mail').val('');
                    }
                    else {
                        $('#getshow').html('<div class="alert alert-success"><b>Thank You For Subsciption</b></div>');
                    }
                });
        }
        $('.select2').select2();
        $(".categorybtn").click(function () {
            $(".sidebarnav").toggle();
        });
    </script>
    <script>
        function productreviewsubmit() {
            var rstar = $("input[type='radio'][name='rating']:checked").val();
            var rname = $("#prname").val();
            var ruserid = $("#userreviewid").val();
            var rprdid = $("#rvproductid").val();
            var rvsub = $("#prubject").val();
            var rcmnts = $("#pryour_review").val();
            $.ajax({
                url: '<?= site_url("shop/getproductreviewsubmit") ?>',
                type: 'POST',
                dataType: 'html',
                data: { rstar: rstar, rname: rname, ruserid: ruserid, rprdid: rprdid, rvsub: rvsub, rcmnts: rcmnts },
            })
                .done(function (e) {
                    if (e == 0) {
                        $('#msgprrev').html('<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><b>Some error has occured !!</b></div>');
                    }
                    else {
                        $('#msgprrev').html('<div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><b>Thank You For your review..</b></div>');
                        $("#pr-reviewform")[0].reset();
                        $("#ratingdiv").load(window.location.href + " #ratingdiv");
                    }
                });
        }
    </script>
    <script>
        //$('.pro-qty').append('<a href="#" class="inc qty-btn">+</a>');
        //$('.pro-qty').append('<a href="#" class= "dec qty-btn">-</a>');
        // $('.qty-btn').on('click', function (e) {
        //     e.preventDefault();
        //     var $button = $(this);
        //     var oldValue = $button.parent().find('input').val();
        //     if ($button.hasClass('inc')) {
        //         var newVal = parseFloat(oldValue) + 1;
        //     } else {
        //         // Don't allow decrementing below zero
        //         if (oldValue > 1) {
        //             var newVal = parseFloat(oldValue) - 1;
        //         } else {
        //             newVal = 1;
        //         }
        //     }
        //     $button.parent().find('.qtyval').val(newVal);
        //     //var cartIdd = $(e).parent().parent('input').val();
        //     var cartIdd = $button.parent().find('.cartrowId').val()
        //     var siteURL = '<?php echo base_url("shop/updateItemQty"); ?>';
        //     $.ajax({
        //         url: siteURL,
        //         type: 'POST',
        //         dataType: 'json',
        //         data: {
        //             rowid: String(cartIdd),
        //             qty: String(newVal),
        //         },
        //         success: function (data) {
        //             if (data == '1') {
        //                 window.location.reload();
        //             }
        //         }
        //     });
        // });
        $(document).ready(function () {
            $("#pquant").keypress(function (e) {
                if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57 || e.which > 0)) {
                    return false;
                }
            })
        });
    </script>
    <script>
        function clear_cart() {
            swal({
                title: 'Are you sure?',
                text: 'Do you really want to clear cart?',
                imageUrl: "<?= site_url('assets/images/delete-icon.png') ?>",
                imageHeight: 90,
                imageWidth: 65,
                showCancelButton: true,
                confirmButtonColor: '#A5DC86',
                cancelButtonColor: '#DD6B55',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
                closeOnConfirm: true,
                closeOnCancel: true
            }, function (isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        url: "<?php echo base_url('shop/clearCart'); ?>",
                        method: "POST",
                        dataType: "JSON",
                        success: function (data) {
                            if (data == 0) {
                                window.location.reload();
                            }
                        }
                    });
                }
            });
        }
    </script>
    <script type="text/javascript">
        jQuery(function ($) {
            $("#chart").shieldChart({
                theme: "bootstrap",
                exportOptions: {
                    image: false,
                    print: false
                },
                seriesSettings: {
                    bar: {
                        stackMode: "normal"
                    }
                },
                axisX: {
                    categoricalValues: [
                        "Jan", "Feb", "Mar", "Apr", "May", "Jun", "July", "Aug", "Sep", "Oct", "Nov", "Dec"
                    ]
                },
                primaryHeader: {
                    text: "Keteke"
                },
                dataSeries: [{
                    seriesType: "bar",
                    collectionAlias: "Total Sale",
                    data: [40, 32, 34, 36, 45, 33, 34, 75, 85, 150, 55, 20]
                }]
            });
        });
    </script>
    <style>
        text tspan {
            display: none;
        }
        g text tspan {
            display: block;
        }
    </style>
</body>
<script>
    function getsubmenu(prcategory) {
        if (prcategory == 2) {
            $("#clothmenu").css("display", "block")
        }
    }
</script>
</html>