<div class="breadcrumb-area pt-10 pb-10 border-bottom mb-40">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-content">
                    <h2>Shop</h2>
                    <ul>
                        <li class="has-child"><a href="<?= site_url() ?>">Home</a></li>
                        <li>Shop</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="page-section pb-40 pt-40">
    <div class="container">
        <div class="row shop-product-wrap grid four-column mb-10">
            <?php if (is_array($produclist) && count($produclist) > 0) {
            foreach ($produclist as $prs) {
                $primgs = $this->Master_model->getSingleRow('productId', $prs->productId, 'product_images');
                $rating = $this->Master_model->productRating($prs->productId);
                ?>
                <div class="col-12 col-lg-3 col-md-6 col-sm-6 mb-20">
                    <!--=======  grid view product  =======-->
                    <div class="single-slider-product grid-view-product">
                        <div class="single-slider-product__image">
                            <a href="<?= site_url('product-details/' . $prs->slug) ?>">
                                <img src="<?= site_url('assets/images/products/' . $primgs->productImage) ?>" class="img-fluid" alt="">
                            </a>
                            <?php if ($prs->disc_percent != '') { ?><span class="discount-label discount-label--red">-<?= $prs->disc_percent ?>%</span><?php } ?>
                        </div>
                        <div class="single-slider-product__content">
                            <p class="product-title"><a href="#"><?= $prs->productName ?></a></p>
                            <div class="rating">
                                <?php for ($j = 0; $j < 5; $j++) {
                                if ($j < $rating) { ?>
                                <i class="ion-android-star active"></i>
                                <?php } else { ?>
                                <i class="ion-android-star"></i>
                                <?php }
                                } ?>
                            </div>
                            <p class="product-price"><span class="discounted-price">$<?= $prs->offprice ?></span> <span class="main-price discounted">$<?= $prs->maxPrice ?></span></p>
                            <form method="post" action="<?= site_url('shop/addtocart') ?>">
                                <!-- <input type="hidden" value="<?= $prs->productId; ?>" name="product_id">
                                <input type="hidden" value="<?= $prs->productName; ?>" name="product_name">
                                <input type="hidden" value="<?= $prs->offprice ?>" name="price">
                                <input type="hidden" value="<?= $primgs->productImage ?>" name="image"> -->
                                <input type="hidden" value="<?= $prs->productId; ?>" name="product_id">
                                <input type="hidden" value="<?= $prs->productName; ?>" name="product_name">
                                <input type="hidden" value="<?= $prs->maxPrice; ?>" name="maxPrice">
                                <input type="hidden" value="<?= $prs->offprice; ?>" name="offprice">
                                <input type="hidden" value="<?= $prs->maxPrice - $prs->offprice; ?>" name="disc_percent">
                                <input type="hidden" value="<?= $primgs->productImage; ?>" name="image">
                                <input type="hidden" value="<?= $user_id ?>" name="userids">
                                <input type="hidden" value="<?= $this->session->userdata('session_id') ?>" name="session_id">
                                <span class="cart-icon"><button type="submit" class="btn btn-primary"><i class="icon-shopping-cart"></i></button></span>
                            </form>
                        </div>
                    </div>
                </div>
            <?php }
            } ?>
        </div>
    </div>
</div>
<style>
.single-slider-product__image {height: 230px !important;}
.single-slider-product__image img {height: 230px !important;}
</style>