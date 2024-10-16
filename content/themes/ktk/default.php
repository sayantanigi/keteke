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
    <link rel="stylesheet" type="text/css" href="<?= site_url() ?>fassets/css/dashboard.css">
    <link rel="stylesheet" type="text/css" href="<?= site_url() ?>fassets/css/jquery.popup.css">
    <link rel="stylesheet" href="<?= site_url() ?>fassets/css/select2.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= site_url() ?>fassets/css/bootstrap-fileinput.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="<?= site_url() ?>fassets/css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="<?= site_url() ?>fassets/js/jquery.popup.js"></script>
    <script src="<?= site_url() ?>fassets/js/bootstrap-fileinput.js" type="text/javascript"></script>
    <!--  <script src="https://raw.githubusercontent.com/select2/select2/develop/dist/js/select2.full.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>> -->
    <script>
        $(window).on("load", function () {
            $("#loader").fadeOut();
        });
    </script>
    <title><?= $title ?></title>
    <style>
        #logo-sec {display: none;}
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
            <div class="head-bar pl-0 pr-0">
                <div class="container">
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
                                <img src="<?= site_url() ?>fassets/images/logos/headertransparentlogo.png" class="logo-main" id="logo-main">
                            </a>
                            <a href="<?php echo base_url(); ?>">
                                <img src="<?= site_url() ?>fassets/images/logos/headertransparentlogo.png" height="40px" id="logo-sec" class="logo-sec">
                            </a>
                        </div>
                        <div class="col-12 col-sx-9 col-sm-9 col-md-9 col-xl-9 col-lg-9 right">
                            <div class="head-bar-nav">
                                <ul>
                                    <?php
                                    $userrl = userrole();
                                    $user = userid2();
                                    $ud = $this->db->get_where('user_accounts', array('user_id' => $user))->row();
                                    if ($userrl == 1 || $userrl == 2) { ?>
                                        <li class="black"><a href="<?= site_url() ?>"> Home </a></li>
                                        <li class="black dorpmenu"><a href="<?= site_url('myprofile') ?>"><i class="fa fa-user" aria-hidden="true"></i> <?= $ud->user_fname." ".$ud->user_lname ?> <span class="caret"></span></a>
                                            <ul class="dropdownmenu">
                                                <li><a href="<?= site_url('signout') ?>">Signout</a></li>
                                            </ul>
                                        </li>
                                        <li class="black"><a href="<?= site_url('list-your-business') ?>"> List your business</a></li>
                                        <li class="black"> <a href="<?= site_url('shop') ?>"><i class="fa fa-shopping-bag"></i> Marketplace </a></li>
                                        <!--  <li class="black"><a href="<?= site_url('signout') ?>"> Signout </a></li> -->
                                    <?php } elseif ($userrl == 3) { ?>
                                        <li class="black"><a href="<?= site_url() ?>"> Home </a></li>
                                        <li class="black"><a href="<?= site_url('list-your-business') ?>"> List your business</a></li>
                                        <!-- <li class="black"><a href="<?= site_url('userdashboard') ?>"><i class="fa fa-user" aria-hidden="true"></i> My Dashboard</a></li> -->
                                        <li class="black dorpmenu"><a href="<?= site_url('seller-dashboard') ?>"><i class="fa fa-user" aria-hidden="true"></i><?= $ud->user_fname." ".$ud->user_lname ?> <span class="caret"></span></a>
                                            <ul class="dropdownmenu">
                                                <li><a href="<?= site_url('signout') ?>">Signout</a></li>
                                            </ul>
                                        </li>
                                        <li class="black"><a href="<?= site_url('shop') ?>"><i class="fa fa-shopping-bag"></i> Marketplace </a></li>
                                    <?php } elseif ($userrl == 4) { ?>
                                        <li class="black"><a href="<?= site_url() ?>"> Home </a></li>
                                        <li class="black dorpmenu"><a href="<?= site_url('userdashboard') ?>"><i class="fa fa-user" aria-hidden="true"></i><?= $ud->user_fname." ".$ud->user_lname ?> <span class="caret"></span></a>
                                            <ul class="dropdownmenu">
                                                <li><a href="<?= site_url('signout') ?>">Signout</a></li>
                                            </ul>
                                        </li>
                                        <li class="black"><a href="<?= site_url('shop') ?>"><i class="fa fa-shopping-bag"></i>Marketplace </a></li>
                                    <?php } elseif ($userrl == 0) { ?>
                                        <li class="black"><a href="<?= site_url('login') ?>"> Login/Sign up </a></li>
                                        <li class="black"><a href="<?= site_url('list-your-business') ?>"> List your business</a></li>
                                        <li class="black"><a href="<?= site_url('shop') ?>"><i class="fa fa-shopping-bag"></i>Marketplace </a></li>
                                    <?php } ?>
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
                <a href="<?= site_url('login') ?>">
                    <li> Login/Sign up </li>
                </a>
                <a href="<?= site_url('list-your-business') ?>">
                    <li> List your business</li>
                </a>
                <a href="<?= site_url('shop') ?>">
                    <li> Marketplace </li>
                </a>
            </ul>
        </nav>
        <?php $this->load->front_view($load); ?>
        <!----start footer part -->
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
                            <a href="<?= site_url('list-your-business') ?>">List your business</a>
                        </p>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-4 col-xl-3 col-lg-3">
                        <h3 class="nirmala-regular-lt"><a href="<?php echo base_url(); ?>reach">
                                Contact</a> </h3>
                        <p class="nirmala-regular-lt">
                            <a href="tel:<?= theme_option('phone') ?>"><?= theme_option('phone') ?></a><br>
                            <a href="mailto:<?= theme_option('email') ?>"><?= theme_option('email') ?></a>
                        </p>
                        <p>
                            <a href="https://www.freecounterstat.com" title="visitor counter script">
                                <img class="counterwidth" src="https://counter10.stat.ovh/private/freecounterstat.php?c=xkun6ugmt9tqt3z242k7c99g84wddk1c" border="0" title="visitor counter script" alt="visitor counter script">
                            </a>
                        </p>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-4 col-xl-3 col-lg-3">
                        <h3 class="nirmala-regular-lt"> Subscribe </h3>
                        <form class="subscription-form" action="javascript:void(0);" onsubmit="getsubscribe()"
                            method="post">
                            <div id="getshow"></div>
                            <div class="subscription-form-item">
                                <img src="<?= site_url() ?>fassets/images/icon/email-icon.png">
                                <input class="nirmala-light" type="email" placeholder="Email" id="sub-mail" required>
                            </div>
                            <div class="subscription-form-item-sub nirmala-light">
                                <input type="submit" value="Submit">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="copyright mirmala-semilight">
                    <span>@ 2020 Copyright Keteke. All Rights Reserved </span>
                    <a href="<?= site_url('privacy-policy') ?>"><span class="nirmala-bold red"> &bull;Privacy
                            Policy</span></a>
                    <a href="<?= site_url('terms') ?>">
                        <span class="nirmala-bold red"> &bull;Terms</span>
                    </a>
                </div>
            </div>
        </footer>
        <!----end footer part -->
    </div>
    <script src="<?= site_url() ?>fassets/js/login-signup.js"></script>
    <script src="<?= site_url() ?>fassets/js/sticky.js"></script>
    <script src="<?= site_url() ?>fassets/js/mobile.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script> -->
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
    </script>
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
    <script>
        $(".choose-option").select2({
            tags: true
        });
    </script>
</body>
</html>