<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Edit Brand</h3>
                    </div>
                    <form action="<?= admin_url('products/edit_brand/'.@$getbrand->id) ?>" method="post" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="form-row row">
                                <div class="col-lg-5 col-12">
                                    <div class="form-group">
                                        <label>Brand Name</label>
                                        <input placeholder="Brand Name" class="form-control" name="brand_name" type="text" value="<?= @$getbrand->brand_name?>" required>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-12">
                                    <div class="form-group">
                                        <label>Upload Brand Images</label><br>
                                        <input type="file" name="brand_image" class="form-control" style="padding: 3px;">
                                        <!-- <img src="<?= site_url('assets/images/products/brand/' . $getbrand->brand_image) ?>" class="img-responsive" style=""> -->
                                    </div>
                                </div>
                                <div class="col-lg-2 col-12">
                                    <div class="form-group">
                                        <?php if(!empty($getbrand->brand_image)) { ?>
                                        <img src="<?= site_url('assets/images/products/brand/' . $getbrand->brand_image) ?>" class="img-responsive" style="width: 110px; border: 1px solid; margin-top: 10px;">
                                        <?php } else { ?>
                                        <img src="<?= site_url('assets/images/no-image.png') ?>" class="img-responsive" style="width: 110px; border: 1px solid; margin-top: 10px;">
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="button" onclick="goBack()" class="btn btn-danger">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>