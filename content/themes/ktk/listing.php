<main class="main-one" id="main-one">
    <div class="container">
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
                        if ($userrl == 1 || $userrl == 2 || $userrl == 3) {
                            ?>
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
                    <?php
                    if ($this->session->flashdata('success')) {
                        ?>
                        <div class="alert alert-success alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <?php echo $this->session->flashdata('success'); ?>
                        </div>
                        <?php
                    }
                    if ($this->session->flashdata('error')) {
                        ?>
                        <div class="alert alert-danger alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <?php echo $this->session->flashdata('error'); ?>
                        </div>
                        <?php
                    }
                    $err = validation_errors();
                    if ($err) {
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
                            <h1>My Listing</h1>
                            <!-- Card Start -->
                            <?php if (is_array($listings) && count($listings) > 0) {
                                foreach ($listings as $lst) {
                                    $cat = $this->db->get_where('category', array('id' => $lst->category))->row();
                                    $con = $this->db->get_where('country', array('id' => $lst->country))->row();

                                    ?>
                                    <div class="card">
                                        <div class="row ">
                                            <div class="col-md-7 px-3">
                                                <div class="card-block px-6">
                                                    <h3 class="card-title"><strong>Company : </strong> <?= $lst->title ?> </h3>
                                                    <p class="card-text"><strong>Business Classification :
                                                        </strong><?= $cat->name ?></p>
                                                    <p class="card-text"><strong>Keywords : </strong><?= $lst->keywords ?></p>
                                                    <p class="card-text"><strong>Address :
                                                        </strong><?= $lst->street_addr . ',' . $lst->city . ',' . $con->name ?></p>
                                                    <p class="card-text"><strong>Website : </strong><?= $lst->website ?></p>
                                                    <p class="card-text"><strong>Email : </strong><?= $lst->email ?></p>
                                                    <p class="card-text"><strong>Phone : </strong><?= $lst->phone ?></p>

                                                    <br>
                                                    <a href="<?= site_url('update-list/' . $lst->id) ?>"
                                                        class="mt-auto btn">Edit</a>
                                                    <a href="<?= site_url('remove-list/' . $lst->id) ?>"
                                                        class="mt-auto btn">Delete</a>
                                                </div>
                                            </div>
                                            <!-- Carousel start -->
                                            <div class="col-md-5">
                                                <div class="imgpadd">
                                                    <?php if ($lst->images == '') { ?>
                                                        <img class="d-block"
                                                            src="https://www.onlinelogomaker.com/blog/wp-content/uploads/2018/01/education-logo-design-1.jpg"
                                                            alt="" width="100%">
                                                    <?php } else { ?>
                                                        <img class="d-block"
                                                            src="<?= site_url('assets/images/directory/' . $lst->images) ?>" alt=""
                                                            style="max-width:100%;">
                                                    <?php } ?>
                                                </div>
                                            </div>
                                            <!-- End of carousel -->
                                        </div>
                                    </div>
                                <?php }
                            } ?>
                            <!-- End of card -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>