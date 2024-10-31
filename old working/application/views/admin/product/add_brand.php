<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Add Brand</h3>
                    </div>
                    <form action="<?= admin_url('products/add_brand/') ?>" method="post" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="form-row row">
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label>Brand Name</label>
                                        <input placeholder="Brand Name" class="form-control" name="brand_name" type="text" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label>Upload Brand Images</label><br>
                                        <input type="file" name="brand_image" required class="form-control" style="padding: 3px;">
                                        <?php if (!empty($mindprdctimg)) {
                                            foreach ($mindprdctimg as $mprdimg) { ?>
                                                <div class="boxuploadImg">
                                                    <img src="<?= site_url('assets/images/products/' . $mprdimg->productImage) ?>" class="img-responsive">
                                                    <a href="<?= site_url('shop/delete_productImg/' . $mprdimg->productImageId . '/' . @$product->productId) ?>" onclick="return confirm('Are you sure want to delete')" class="deleteimg"><i class="fa fa-trash" area-hidden="true"></i>Delete</a>
                                                </div>
                                            <?php }
                                        } ?>
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