<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
   <head>
      <meta charset="UTF-8">
      <meta content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0; name='viewport'"/>
      <meta name="viewport" content="width=device-width" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <link rel="stylesheet" type="text/css" href="<?=site_url()?>fassets/css/fontfamily.css">
      <link rel="stylesheet" type="text/css" href="<?=site_url()?>fassets/css/style.css">
      <link rel="stylesheet" href="<?=site_url()?>fassets/css/select2.css" rel="stylesheet" />
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <link
         rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css"
         />
      <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
      <!--- marketplace csss ---------->
      <link rel="stylesheet" href="<?=site_url()?>fassets/marketplace/css/vendors.css" rel="stylesheet" />
      <link rel="stylesheet" href="<?=site_url()?>fassets/marketplace/css/style.css" rel="stylesheet" />
      <!--- end marketplace csss ---------->
      <script>
         $( window ).on( "load", function() {
           $("#loader").fadeOut();
         });
         function goBack() {
          window.history.back();
        }
      </script>
      <title><?=$title?> </title>
      <style>
         #logo-sec{
         display:none;
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
            <div class="head-bar" >
               <div class="row">
                  <div class="col-xs-6 icon" onclick="open_mobile_nav();">
                     <svg xmlns="http://www.w3.org/2000/svg" width="28.37" height="17.346" viewBox="0 0 28.37 17.346">
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
                        <g  id="Group_215" data-name="Group 215" transform="translate(-22.5 -27.5)">
                           <line id="Line_11" data-name="Line 11" class="cls-1" x2="26.37" transform="translate(23.5 36.173)"/>
                           <line id="Line_12" data-name="Line 12" class="cls-1" x2="11.024" transform="translate(23.5 43.846)"/>
                           <line id="Line_13" data-name="Line 13" class="cls-1" x2="17.722" transform="translate(23.5 28.5)"/>
                        </g>
                     </svg>
                  </div>
                  <div class="col-sx-3 col-sm-3 col-md-3 col-xl-3 col-lg-3 logo">
                     <a href="<?php echo base_url('shop');?>">
                     <img src="<?=site_url()?>fassets/images/logos/headertransparentlogo.png" class="logo-main" id="logo-main"></a>
                     <a href="<?php echo base_url('shop');?>">
                     <img src="<?=site_url()?>fassets/images/logos/headertransparentlogo.png" height="40px" id="logo-sec" class="logo-sec"></a>
                  </div>
                  <div class="col-9 col-sx-9 col-sm-9 col-md-9 col-xl-9 col-lg-9 right">
                     <div class="head-bar-nav">
                        <ul>
                            <?php
                         $cartItems = $this->cart->contents();
                        if($cartItems){
                        $total  = count($cartItems);
                        }
                $userrl=userrole();
                if($userrl==1 || $userrl==2) { ?>
               <li class="black"><a href="<?=site_url()?>"> Home </a></li>
                <li class="black"><a href="<?=site_url('shop')?>"><i class="fa fa-shopping-bag" aria-hidden="true"></i> Marketplace </a></li>
                <li class="black"><a href="<?=site_url('myprofile')?>"><i class="fa fa-user" aria-hidden="true"></i>  My Dashboard</a></li>
                <li class="black"><a href="<?=site_url('list-your-business')?>"> List your business</a></li>
                <a href="javascript:void(0)" id="search-overlay-trigger" class="roundclass">
                  <li class=""><i class="icon-search"></i></li>
                </a>
                <a href="<?=site_url('shop/pr_cart')?>" class="small-cart-trigger roundclass">
                  <li class="black">
                    <i class="icon-shopping-cart"></i>
                    <span class="cart-counter"><?=$total?></span>
                  </li>
                </a>
              <?php } elseif($userrl==3) { ?>
               <li class="black"> <a href="<?=site_url()?>">Home </a></li>
              <li class="black"><a href="<?=site_url('shop')?>"><i class="fa fa-shopping-bag" aria-hidden="true"></i> Marketplace </a></li>
              <li class="black"><a href="<?=site_url('seller-dashboard')?>"><i class="fa fa-user" aria-hidden="true"></i> My Dashboard</a></li>
              <li class="black"><a href="<?=site_url('signout')?>"> Signout </a></li>
              <a href="javascript:void(0)" id="search-overlay-trigger" class="roundclass">
                  <li class=""><i class="icon-search"></i></li>
                </a>
                <a href="<?=site_url('shop/pr_cart')?>" class="small-cart-trigger roundclass">
                  <li class="black">
                    <i class="icon-shopping-cart"></i>
                    <span class="cart-counter"><?=$total?></span>
                  </li>
                </a>
               <?php } elseif($userrl==4) { ?>
               <li class="black"><a href="<?=site_url()?>"> Home </a></li>
                <li class="black"><a href="<?=site_url('shop')?>"><i class="fa fa-shopping-bag" aria-hidden="true"></i> Marketplace </a></li>
                <li class="black"><a href="<?=site_url('userdashboard')?>"><i class="fa fa-user" aria-hidden="true"></i> My Dashboard</a></li>
                <li class="black"><a href="<?=site_url('signout')?>"> Signout </a></li>
                <a href="javascript:void(0)" id="search-overlay-trigger" class="roundclass">
                  <li class=""><i class="icon-search"></i></li>
                </a>
                <a href="<?=site_url('shop/pr_cart')?>" class="small-cart-trigger roundclass">
                  <li class="black">
                    <i class="icon-shopping-cart"></i>
                    <span class="cart-counter"><?=$total?></span>
                  </li>
                </a>
              <?php }elseif($userrl==0) { ?>
               <li class="black"><a href="<?=site_url()?>"> Home </a></li>
                <li class="black"><a href="<?=site_url('shop')?>"><i class="fa fa-shopping-bag" aria-hidden="true"></i> Marketplace </a></li>
                <li class="black"><a href="<?=site_url('login')?>"> Login/Signup </a></li>
                <li class="black"><a href="<?=site_url('list-your-business')?>"> List your business</a></li>
                <a href="javascript:void(0)" id="search-overlay-trigger" class="roundclass">
                  <li class=""><i class="icon-search"></i></li>
                </a>
                <a href="<?=site_url('shop/pr_cart')?>" class="small-cart-trigger roundclass">
                  <li class="black">
                    <i class="icon-shopping-cart"></i>
                    <span class="cart-counter"><?=$total?></span>
                  </li>
                </a>
              <?php } ?>
                           
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </header>
         <nav class="mobile-nav animate__animated" id="nav-mobile">
            <div class="close-button nirmala" onclick="close_mobile_nav();">Close</div>
            <a href="../keteke">
            <img src="<?=site_url()?>fassets/images/logos/whitecolor.png" class="mobile-nav-img nirmala"></a>
            <ul class="nirmala-light">
                  <li><a href="<?=site_url('login')?>"> Login</a> </li>
                  <li><a href="<?=site_url('signup')?>"> Signup </a></li>
                  <li><a href="<?=site_url('list-your-business')?>"> List your business </a></li>
                  <li><a href="#"> Get Coupons </a></li>
            </ul>
         </nav>
         <div class="marketplacenav">
            <div class="container">
               <div class="row">
                  <div class="col-lg-12">
                     <!--====================  navigation top search ====================-->
                     <div class="navigation-top-search-area">
                        <span class="categorybtn">
                          <a href="#"><img src="<?=site_url('fassets/marketplace/img/keteke-icon.png')?>"></a>
                        </span>
                        <div class=" align-items-left">
                           <div class="sidebarnav">
                              <!-- navigation section -->
                              <div class="main-menu main-menu--separate d-none d-lg-block">
                                 <nav>
                                    <ul>
                                       <li class="menu-item-has-children">
                                          <a href="<?=site_url('products')?>">clothing</a>
                                          <ul class="sub-menu">
                                             <li><a href="#">Men</a>
                                                <ul class="sub-menu">
                                                    <li><a href="#">Shirt</a></li>
                                                    <li><a href="#">T-Shirt</a></li>
                                                    <li><a href="#">Watches</a></li>
                                                </ul>
                                             </li>
                                             <li><a href="#">Women</a></li>
                                             <li><a href="#">Child</a></li>
                                          </ul>
                                       </li>
                                       <li class="menu-item-has-children">
                                          <a href="#"> consumer electronics</a>
                                          <ul class="sub-menu">
                                             <li><a href="#">Mobile Phones</a></li>
                                             <li><a href="#">Televisions</a></li>
                                          </ul>
                                       </li>
                                       <li>
                                          <a href="#">household goods</a>
                                       </li>
                                       <li>
                                          <a href="#">health and beauty</a>
                                       </li>
                                       <li>
                                          <a href="#"> baby products</a>
                                       </li>
                                       <!-- <li class="menu-item-has-children"><a href="#">SHOP</a>
                                          <ul class="mega-menu four-column">
                                            <li><a href="#">Shop Grid</a>
                                              <ul>
                                                <li><a href="#">shop 3 column</a></li>
                                                <li><a href="#">shop 4 column</a></li>
                                                <li><a href="#">shop left sidebar</a></li>
                                                <li><a href="#">shop right sidebar</a></li>
                                          
                                              </ul>
                                            </li>
                                            <li><a href="#">Shop List</a>
                                              <ul>
                                                <li><a href="#">shop List</a></li>
                                                <li><a href="#">shop List Left Sidebar</a></li>
                                                <li><a href="#">shop List Right Sidebar</a></li>
                                              </ul>
                                            </li>
                                            <li><a href="#">Single Product</a>
                                              <ul>
                                                <li><a href="#">Single Product</a></li>
                                                <li><a href="#">Single Product variable</a></li>
                                                <li><a href="#">Single Product affiliate</a></li>
                                                <li><a href="#">Single Product group</a></li>
                                                <li><a href="#">Tab Style 2</a></li>
                                                <li><a href="#">Tab Style 3</a></li>
                                          
                                              </ul>
                                            </li>
                                            <li><a href="#">Single Product</a>
                                              <ul>
                                                <li><a href="#">Gallery Left</a></li>
                                                <li><a href="#">Gallery Right</a></li>
                                                <li><a href="#">Sticky Left</a></li>
                                                <li><a href="#">Sticky Right</a></li>
                                                <li><a href="#">Slider Box</a></li>
                                              </ul>
                                            </li>
                                            <li class="megamenu-banner d-none d-lg-block mt-30 w-100">
                                              <a href="shop-left-sidebar.html" class="mb-0">
                                                <img src="assets/img/banners/img-bottom-menu.jpg" class="img-fluid" alt="">
                                              </a>
                                            </li>
                                          </ul>
                                          </li> -->
                                    </ul>
                                 </nav>
                              </div>
                              <!-- end of navigation section -->
                              <!-- Mobile Menu -->
                              <div class="mobile-menu-wrapper d-block d-lg-none pt-15">
                                 <div class="mobile-menu"></div>
                              </div>
                           </div>
                           <!-- <div class="col-6 col-md-2 text-right order-2">
                              <div class="search-icon d-inline-block mr-40 mr-xxs-20">
                                 <a href="javascript:void(0)" id="search-overlay-trigger">
                                 <i class="icon-search"></i>
                                 </a>
                              </div>
                              <div class="header-cart-icon d-inline-block">
                                 <a href="<?=site_url('shop/pr_cart'); ?>"  class="small-cart-trigger">
                                 <i class="icon-shopping-cart"></i>
                                 <span class="cart-counter">2</span>
                                 </a>
                              </div>
                           </div> -->
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
                     <a href="<?php echo base_url();?>">
                     <img src="<?=site_url()?>fassets/images/logos/headertransparentlogo.png" width="60%;">
                     </a>
                     <div class="social-one">
                        <a href="<?=theme_option('insta')?>" class="fa fa-instagram"></a>
                        <a href="<?=theme_option('twitter')?>" class="fa fa-twitter"></a>
                        <a href="<?=theme_option('facebook')?>" class="fa fa-facebook"></a>
                     </div>
                  </div>
                  <div class="col-xs-12 col-sm-4 col-md-4 col-xl-3 col-lg-3">
                     <h3 class="nirmala-regular-lt"> Information </h3>
                     <p class="nirmala-regular-lt">
                        <a href="<?=site_url('about')?>">About us</a><br>
                        <a href="<?=site_url('reach')?>">Reach us</a><br>
                        <a href="<?=site_url('list-your-business')?>">List your Business</a>
                     </p>
                  </div>
                  <div class="col-xs-12 col-sm-4 col-md-4 col-xl-3 col-lg-3">
                     <h3 class="nirmala-regular-lt"><a href="<?php echo base_url();?>reach">
                        Contact</a> 
                     </h3>
                     <p class="nirmala-regular-lt">
                        <a href="tel:<?=theme_option('phone')?>"><?=theme_option('phone')?></a><br>
                        <a href ="mailto:<?=theme_option('email')?>"><?=theme_option('email')?></a>
                     </p>
                  </div>
                  <div class="col-xs-12 col-sm-4 col-md-4 col-xl-3 col-lg-3">
                     <h3 class="nirmala-regular-lt"> Subscribe </h3>
                     <form class="subscription-form" action="javascript:void(0);" onsubmit="getsubscribe()" method="post">
                        <div id="getshow"></div>
                        <div class="subscription-form-item">
                           <img src="<?=site_url()?>fassets/images/icon/email-icon.png" style="width:18px;height:14px; margin:5px;">
                           <input class="nirmala-light" type="email" placeholder="Email" id="sub-mail">
                        </div>
                        <div class="subscription-form-item-sub nirmala-light">
                           <input type="submit" value="Submit">
                        </div>
                     </form>
                  </div>
               </div>
               <div class="copyright mirmala-semilight">
                  <span style="word-wrap: break-word;">@ 2020 Copyright Keteke. All Rights Reserved </span>
                  <a href="<?=site_url('privacy-policy')?>"><span class="nirmala-bold red" style="word-wrap: break-word;" > &bull;Privacy Policy</span></a>
                  <a href="<?=site_url('terms')?>">
                  <span class="nirmala-bold red" style="word-wrap: break-word;"> &bull;Terms</span>
                  </a>
               </div>
            </div>
         </footer>
         <!----end footer part -->
      </div>
      <script src="<?=site_url()?>fassets/js/login-signup.js"></script>
      <script src="<?=site_url()?>fassets/js/sticky.js"></script>
      <script src="<?=site_url()?>fassets/js/mobile.js"></script>
      <script src="<?=site_url()?>fassets/marketplace/js/vendors.js"></script>
      <script src="<?=site_url()?>fassets/marketplace/js/active.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
      <script>
         function getsubscribe()
         {
           var email = document.getElementById('sub-mail').value;
           $.ajax({
             url: '<?=site_url("welcome/newsletter")?>',
             type: 'POST',
             dataType: 'html',
             data: {email:email},
           })
           .done(function(e){
             if(e==1){
              $('#getshow').html('<div class="alert alert-danger"><b>Already Subscribed !!</b></div>');
              $('#sub-mail').val('');
            }
            else{
             $('#getshow').html('<div class="alert alert-success"><b>Thank You For Subsciption</b></div>');
           }
         });
         
         }
         $('.select2').select2();
        $(".categorybtn" ).click(function() {
          $(".sidebarnav").toggle();
        });

         function updateCartItem(obj, rowid){
           $.get("<?= base_url('shop/updateItemQty/')?>",
            {rowid:rowid, qty:obj.value},
             function(resp){
               if(resp){
                 location.reload();
               }else{
                 alert('Cart update failed, please try again.');
               }
           });
         }
      </script>
   </body>
</html>