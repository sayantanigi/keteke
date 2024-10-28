<div class="hero-slider-area mb-40">
    <!--=======  hero slider wrapper  =======-->
    <div class="hero-slider-wrapper">
        <div class="ht-slick-slider" data-slick-setting='{
         "slidesToShow": 1,
         "slidesToScroll": 1,
         "arrows": false,
         "dots": true,
         "autoplay": true,
         "autoplaySpeed": 5000,
         "speed": 1000,
         "fade": true
         }' data-slick-responsive='[
         {"breakpoint":1501, "settings": {"slidesToShow": 1} },
         {"breakpoint":1199, "settings": {"slidesToShow": 1} },
         {"breakpoint":991, "settings": {"slidesToShow": 1} },
         {"breakpoint":767, "settings": {"slidesToShow": 1} },
         {"breakpoint":575, "settings": {"slidesToShow": 1} },
         {"breakpoint":479, "settings": {"slidesToShow": 1} }
         ]'>
        <?php if (is_array($banners) && count($banners) > 0) {
            foreach ($banners as $banv) { ?>
            <div class="single-slider-item">
                <div class="hero-slider-item-wrapper hero-slider-item-wrapper--fullwidth hero-slider-item-wrapper--bg-move hero-slider-bg-13" style="background-image: url(assets/images/banner/<?= $banv->image ?>);">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="hero-slider-content">
                                    <p class="slider-title slider-title--big-bold mb-4"><?= $banv->banner_text ?></p>
                                    <a class="theme-button hero-slider-button" href="<?= $banv->link ?>">Shopping Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php } } ?>
        </div>
    </div>
</div>
<div class="split-banner-area mb-40 mb-sm-30">
    <div class="container">
        <div class="row row-5">
        <?php if (is_array($advs) && count($advs) > 0) {
        foreach ($advs as $advsv) { ?>
            <div class="col-md-6 mb-sm-10">
                <div class="single-split-banner">
                    <div class="single-split-banner__image">
                        <a href="<?= $advsv->link ?>">
                            <img src="<?= site_url('assets/images/banner/' . $advsv->image) ?>" class="img-fluid" alt="">
                            <div class="single-split-banner__image__content">
                                <p class="split-banner-title split-banner-title--light"><?= $advsv->banner_text ?></p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        <?php } } ?>
        </div>
    </div>
</div>
<div class="container">
    <div class="row shop-product-wrap grid four-column mb-10">
        <?php if (is_array($produclist) && count($produclist) > 0) {
            foreach ($produclist as $prs) {
                $primgs = $this->db->get_where('product_images', array('productId' => $prs->productId))->row();
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
                                <i class="ion-android-star active"></i>
                                <i class="ion-android-star active"></i>
                                <i class="ion-android-star active"></i>
                                <i class="ion-android-star active"></i>
                                <i class="ion-android-star"></i>
                            </div>
                            <p class="product-price">
                                <span class="discounted-price">$<?= $prs->offprice ?></span>
                                <span class="main-price discounted">$<?= $prs->maxPrice ?></span>
                            </p>
                            <form method="post" action="<?= site_url('shop/addtocart') ?>">
                                <input type="hidden" value="<?= $prs->productId; ?>" name="product_id">
                                <input type="hidden" value="<?= $prs->productName; ?>" name="product_name">
                                <input type="hidden" value="<?= $prs->maxPrice; ?>" name="maxPrice">
                                <input type="hidden" value="<?= $prs->offprice; ?>" name="offprice">
                                <input type="hidden" value="<?= $prs->maxPrice - $prs->offprice; ?>" name="disc_percent">
                                <input type="hidden" value="<?= $primgs->productImage; ?>" name="image">
                                <input type="hidden" value="<?= $user_id ?>" name="userids">
                                <input type="hidden" value="<?= session_id() ?>" name="session_id">
                                <span class="cart-icon"><button type="submit" class="btn btn-primary"><i class="icon-shopping-cart"></i></button></span>
                            </form>
                        </div>
                    </div>
                </div>
            <?php }
        } ?>
    </div>
</div>
<!-- <div class="split-banner-area mb-40 mb-sm-30">
    <div class="container">
        <div class="row row-5">
            <?php if (is_array($advs) && count($advs) > 0) {
            foreach ($advs as $advsv2) { ?>
            <div class="col-md-6 mb-sm-10">
                <div class="single-split-banner">
                    <div class="single-split-banner__image">
                        <a href="<?= $advsv2->link ?>">
                            <img src="<?= site_url('assets/images/banner/' . $advsv2->image) ?>" class="img-fluid" alt="">
                            <div class="single-split-banner__image__content">
                                <p class="split-banner-title split-banner-title--bold"><?= $advsv2->banner_text ?></p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <?php } } ?>
        </div>
    </div>
</div> -->
<style>
.login-warning{display: none; }
</style>
<script>
$('.login-alert').click(function(){
    $('.login-warning').show();
})
</script>