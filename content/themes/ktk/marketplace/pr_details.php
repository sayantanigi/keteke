<div class="breadcrumb-area pt-10 pb-10 border-bottom mb-40">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!--=======  breadcrumb content  =======-->

                <div class="breadcrumb-content">
                    <h2>Product Details </h2>
                    <ul>
                        <li class="has-child"><a href="<?= site_url('') ?>">Home</a></li>
                        <li class="has-child"><a href="<?= site_url('shop') ?>">Shop</a></li>
                        <li>
                            <?php
                            $cat_name = $this->db->query("SELECT * FROM mrkt_category WHERE id = '".@$prodetail->category."'")->row();
                            ?>
                            <a href="<?= site_url('products?catId='.base64_encode($cat_name->id)) ?>"><?= $cat_name->name?></a>
                        </li>
                    </ul>
                </div>

                <!--=======  End of breadcrumb content  =======-->
            </div>
        </div>
    </div>
</div>

<div class="product-details-area mb-40">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mb-md-30 mb-sm-25">
                <!--=======  product details slider  =======-->
                <!--=======  big image slider  =======-->
                <div class="big-image-slider-wrapper big-image-slider-wrapper--change-cursor">
                    <div class="ht-slick-slider big-image-slider99" data-slick-setting='{
                  "slidesToShow": 1,
                  "slidesToScroll": 1,
                  "dots": false,
                  "autoplay": false,
                  "autoplaySpeed": 5000,
                  "speed": 1000
                  }' data-slick-responsive='[
                  {"breakpoint":1501, "settings": {"slidesToShow": 1} },
                  {"breakpoint":1199, "settings": {"slidesToShow": 1} },
                  {"breakpoint":991, "settings": {"slidesToShow": 1} },
                  {"breakpoint":767, "settings": {"slidesToShow": 1} },
                  {"breakpoint":575, "settings": {"slidesToShow": 1} },
                  {"breakpoint":479, "settings": {"slidesToShow": 1} }
                  ]'>
                        <!--=======  big image slider single item  =======-->
                        <?php foreach ($primgs as $pimg) { ?>
                            <div class="big-image-slider-single-item">
                                <img src="<?= site_url('assets/images/products/' . $pimg->productImage) ?>" class="img-fluid"
                                    alt="">
                            </div>
                        <?php } ?>
                        <!--=======  End of big image slider single item  =======-->

                    </div>
                </div>
                <!--=======  End of big image slider  =======-->
                <!--=======  small image slider  =======-->
                <div class="small-image-slider-wrapper small-image-slider-wrapper--quickview">
                    <div class="ht-slick-slider small-image-slider" data-slick-setting='{
                  "slidesToShow": 4,
                  "slidesToScroll": 1,
                  "dots": false,
                  "autoplay": false,
                  "autoplaySpeed": 5000,
                  "speed": 1000,
                  "asNavFor": ".big-image-slider99",
                  "focusOnSelect": true,
                  "arrows": true,
                  "prevArrow": {"buttonClass": "slick-prev", "iconClass": "ion-ios-arrow-left" },
                  "nextArrow": {"buttonClass": "slick-next", "iconClass": "ion-ios-arrow-right" }
                  }' data-slick-responsive='[
                  {"breakpoint":1501, "settings": {"slidesToShow": 4} },
                  {"breakpoint":1199, "settings": {"slidesToShow": 4} },
                  {"breakpoint":991, "settings": {"slidesToShow": 4} },
                  {"breakpoint":767, "settings": {"slidesToShow": 4} },
                  {"breakpoint":575, "settings": {"slidesToShow": 3} },
                  {"breakpoint":479, "settings": {"slidesToShow": 2} }
                  ]'>
                        <!--=======  small image slider single item  =======-->
                        <?php foreach ($primgs as $pimgg) { ?>
                            <div class="small-image-slider-single-item">
                                <img src="<?= site_url('assets/images/products/' . $pimgg->productImage) ?>" class="img-fluid"
                                    alt="">
                            </div>
                        <?php } ?>
                        <!--=======  End of small image slider single item  =======-->
                        <!--=======  small image slider single item  =======-->


                    </div>
                </div>
                <!--=======  End of small image slider  =======-->
                <!--=======  End of product details slider  =======-->
            </div>
            <div class="col-lg-6">
                <!--=======  product details content  =======-->
                <div class="product-detail-content">
                    <!-- <div class="tags mb-5">
                  <span class="tag-title">Tags:</span>
                  <ul class="tag-list">
                     <li><a href="#">Plant</a>,</li>
                     <li><a href="#">Garden</a></li>
                  </ul>
               </div> -->
                    <h3 class="product-details-title mb-15"><?= $prodetail->productName ?></h3>
                    <div class="rating d-inline-block mr-15">
                        <?php $rating = $this->Master_model->productRating($prodetail->productId);
                        for ($j = 0; $j < 5; $j++) { ?>
                            <?php if ($j < $rating) { ?>
                                <i class="ion-android-star active"></i>
                            <?php } else { ?>
                                <i class="ion-android-star"></i>
                            <?php }
                        } ?>
                    </div>
                    <div class="review-links d-inline-block">
                        <p class="fs-14">(<?php echo $this->Master_model->productRating($prodetail->productId); ?>
                            Review)</p>
                    </div>
                    <p class="product-price product-price--big mb-10"><span
                            class="discounted-price">$<?= $prodetail->offprice ?>.00</span> <span
                            class="main-price discounted">$<?= $prodetail->maxPrice ?>.00</span></p>
                    <div class="product-info-block mb-30">
                        <!-- <div class="single-info">
                     <span class="title">Ex Tax:</span>
                     <span class="value">$95.00</span>
                  </div> -->
                        <div class="single-info">
                            <span class="title">Brand:</span>
                            <?php
                            $brand_name = $this->db->query("SELECT * FROM product_brand WHERE id = '".$prodetail->brand_name."'")->row();
                            ?>
                            <span class="value"><a href="#"><?= $brand_name->brand_name ?></a></span>
                        </div>
                        <div class="single-info">
                            <span class="title">Product Code:</span>
                            <span class="value"><?= $prodetail->prcode ?></span>
                        </div>
                        <!-- <div class="single-info">
                     <span class="title">Availability:</span>
                     <span class="value stock-red">In stock</span>
                  </div> -->
                    </div>
                    <div class="product-short-desc mb-25">
                        <p><?= $prodetail->description ?></p>
                    </div>
                    <div class="quantity mb-20">
                        <span class="quantity-title mr-20">Qty</span>
                        <div class="pro-qty mr-15 mb-lg-20 mb-md-20 mb-sm-20">
                            <input type="text" value="1">
                        </div>
                        <form method="post" action="<?= site_url('shop/addtocart') ?>">
                            <input type="hidden" value="<?= $prodetail->productId; ?>" name="product_id">
                            <input type="hidden" value="<?= $prodetail->productName; ?>" name="product_name">
                            <input type="hidden" value="<?= $prodetail->offprice ?>" name="price">
                            <input type="hidden" value="<?= $primgs[0]->productImage ?>" name="image">
                            <button type="submit" class="theme-button product-cart-button">+ Add to Cart</button>
                        </form>
                        <!-- <a class="theme-button product-cart-button" href="<?= site_url('shop/pr_cart') ?>">+ Add to Cart</a> -->
                    </div>

                    <!-- <div class="compare-button d-inline-block mr-40">
                  <a href="#"><i class="icon-sliders"></i> Compare This Product</a>
               </div>
               <div class="wishlist-button d-inline-block">
                  <a href="#"><i class="icon-heart"></i> Add to Wishlist</a>
               </div>-->

                </div>
                <!--=======  End of product details content  =======-->
            </div>
        </div>
    </div>
</div>
<div class="product-description-review-area mb-20">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!--=======  product description review container  =======-->
                <div class="tab-slider-wrapper product-description-review-container">
                    <nav>
                        <div class="nav nav-tabs justify-content-center" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="description-tab" data-toggle="tab"
                                href="#product-description" role="tab" aria-selected="true">Description</a>
                            <a class="nav-item nav-link" id="review-tab" data-toggle="tab" href="#review" role="tab"
                                aria-selected="false">Review</a>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="product-description" role="tabpanel"
                            aria-labelledby="description-tab">
                            <!--=======  product description  =======-->
                            <div class="product-description">
                                <p><?= $prodetail->description ?></p>
                            </div>
                            <!--=======  End of product description  =======-->
                        </div>
                        <div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">
                            <!--=======  review content  =======-->
                            <div class="product-ratting-wrap">
                                <div class="pro-avg-ratting">
                                    <h4><?php echo $this->Master_model->productRating($prodetail->productId); ?>
                                        <span>(Overall)</span></h4>
                                </div>
                                <div class="rattings-wrapper" id="ratingdiv">
                                    <?php if (is_array($prdreview) && count($prdreview) > 0) {
                                        foreach ($prdreview as $prview) { ?>
                                            <div class="sin-rattings">
                                                <div class="ratting-author">
                                                    <h3><?= $prview->name ?></h3>
                                                    <div class="ratting-star">
                                                        <?php for ($i = 0; $i < 5; $i++) {
                                                            if ($i < $prview->rating) { ?>
                                                                <i class="fa fa-star checked"></i>
                                                            <?php } else { ?>
                                                                <i class="fa fa-star"></i>
                                                            <?php }
                                                        } ?>
                                                        <span>(<?= $prview->rating ?>)</span>
                                                    </div>
                                                </div>
                                                <p><?= $prview->message ?>
                                                </p>
                                            </div>
                                        <?php }
                                    } ?>
                                </div>
                                <div class="ratting-form-wrapper fix" id="reviewform">
                                    <?php
                                    //$userrol = userrole();
                                    //if ($userrol == 4) {
                                    if(!empty($this->session->userdata('userids'))) { ?>
                                        <h3>Add your Comments</h3>
                                        <p id="msgprrev"></p>
                                        <form action="javascript:void(0)" id="pr-reviewform"
                                            onsubmit="productreviewsubmit()" method="post">
                                            <div class="ratting-form row">
                                                <div class="col-12 mb-15">
                                                    <div class="media">
                                                        <label>Rating</label>
                                                        <fieldset class="rating">
                                                            <input type="radio" id="star5" name="rating" value="5" /><label
                                                                class="full" for="star5" title="5 stars"></label>

                                                            <input type="radio" id="star4" name="rating" value="4" /><label
                                                                class="full" for="star4" title="4 stars"></label>

                                                            <input type="radio" id="star3" name="rating" value="3" /><label
                                                                class="full" for="star3" title="3 stars"></label>

                                                            <input type="radio" id="star2" name="rating" value="2" /><label
                                                                class="full" for="star2" title=" 2 stars"></label>

                                                            <input type="radio" id="star1" name="rating" value="1" /><label
                                                                class="full" for="star1" title=" 1 star"></label>

                                                        </fieldset>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12 mb-15">
                                                    <label for="name">Name:</label>
                                                    <input type="hidden" id="rvproductid"
                                                        value="<?= $prodetail->productId ?>">
                                                    <input type="hidden" id="userreviewid" value="<?= $udetail->user_id ?>">
                                                    <input id="prname" placeholder="Name" type="text">
                                                </div>
                                                <div class="col-md-6 col-12 mb-15">
                                                    <label for="subject">Subject:</label>
                                                    <input id="prubject" placeholder="Subject" type="text">
                                                </div>
                                                <div class="col-12 mb-15">
                                                    <label for="your-review">Your Review:</label>
                                                    <textarea name="review" id="pryour_review"
                                                        placeholder="Write a review"></textarea>
                                                </div>
                                                <div class="col-12">
                                                    <input value="add review" type="submit">
                                                </div>
                                            </div>
                                        </form>
                                    <?php } else { ?>
                                        <h3 class="text-red">Please Signin to Comment </h3>
                                    <?php } ?>
                                </div>
                            </div>
                            <!--=======  End of review content  =======-->
                        </div>
                    </div>
                </div>
                <!--=======  End of product description review container  =======-->
            </div>
        </div>
    </div>
</div>