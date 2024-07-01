<main class="main-one" id="main-one">
    <section class="container">
        <div class="home-part-one" style="z-index: 5;">
            <div class="row" style="max-height:560px;">
                <div class="col-sm-12 col-md-12 col-xl-6 col-lg-6 search">
                    <form>
                        <h1 style="font-size:4rem;font-weight:bolder;color:red;"><?= $aboutcms->title ?></h1>
                        <h1 class="nirmala-bold" style="padding:10px 0;">
                            <?= $aboutcms->meta_title ?>
                        </h1>
                        <p style="font-size:1.65rem;" class="nirmala-light">
                            <?= $aboutcms->description ?>
                        </p>
                        <div class="mt-5"><a href="<?= site_url('reach') ?>" class="final-but ">Contact Us </a></div>
                    </form>
                </div>
                <div class="col-6 search-opp-display">
                    <img src="<?= site_url() ?>fassets/images/svg%20items/Group%2047.svg">
                </div>
            </div>
        </div>
    </section>
    <section class="container">
        <div class="home-part-one mb-5" style="z-index: 5;">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-xl-12 col-lg-12">
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="nirmala-bold" style="padding:10px 0;">
                                <?= $whycms->title ?>
                            </h1>
                            <h1 style="font-size:4rem;font-weight:bolder;color:red;"> <?= $whycms->meta_title ?></h1>

                            <p style="font-size:1.65rem;" class="nirmala-light">
                                <?= $whycms->description ?>
                            </p>
                            <div class="row ">
                                <div class="col-sm-12 col-md-12 col-xl-6 col-lg-6">
                                    <div class="cusbox c-2">
                                        <div class="cuscontent">
                                            <h1>- 01</h1>
                                            <h2><?= theme_option1('hth1') ?></h2>
                                            <svg height="10" width="100%">
                                                <line x1="0" y1="0" x2="50" y2="0"
                                                    style="stroke:rgb(255,0,0);stroke-width:8" /> Sorry, your browser
                                                does not support inline SVG.
                                            </svg>
                                            <p style="font-weight:1.6rem;"><?= theme_option1('hd1') ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 col-xl-6 col-lg-6">
                                    <div class="cusbox c-1">
                                        <div class="cuscontent">
                                            <h1>- 02</h1>
                                            <h2><?= theme_option1('hth2') ?></h2>
                                            <svg height="10" width="100%">
                                                <line x1="0" y1="0" x2="50" y2="0"
                                                    style="stroke:rgb(255,255,255);stroke-width:8" /> Sorry, your
                                                browser does not support inline SVG.
                                            </svg>
                                            <p style="font-weight:1.6rem;"><?= theme_option1('hd2') ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 col-xl-6 col-lg-6">
                                    <div class="cusbox c-1">
                                        <div class="cuscontent">
                                            <h1>- 03</h1>
                                            <h2><?= theme_option1('hth3') ?></h2>
                                            <svg height="10" width="100%">
                                                <line x1="0" y1="0" x2="50" y2="0"
                                                    style="stroke:rgb(255,255,255);stroke-width:8" /> Sorry, your
                                                browser does not support inline SVG.
                                            </svg>
                                            <p style="font-weight:1.6rem;"><?= theme_option1('hd3') ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 col-xl-6 col-lg-6">
                                    <div class="cusbox c-2">
                                        <div class="cuscontent">
                                            <h1>- 04</h1>
                                            <h2><?= theme_option1('hth4') ?></h2>
                                            <svg height="10" width="100%">
                                                <line x1="0" y1="0" x2="50" y2="0"
                                                    style="stroke:rgb(255,0,0);stroke-width:8" /> Sorry, your browser
                                                does not support inline SVG.
                                            </svg>
                                            <p style="font-weight:1.6rem;"><?= theme_option1('hd4') ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>
</main>