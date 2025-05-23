<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Edit </h3>
                    </div>
                    <form action="<?= admin_url('products/editproduct/' . @$product->productId) ?>" method="post"
                        enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="form-row row">
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label>Select Category</label>
                                        <select class="form-control" name="frm[category]" id="category" required>
                                            <option value="">Select Category</option>
                                            <?php if (is_array($mcategoty) && count($mcategoty) > 0) {
                                            foreach ($mcategoty as $mcat) { ?>
                                            <option value="<?= $mcat->id ?>" <?php if ($product->category == $mcat->id) { echo "selected"; } ?>><?= $mcat->name ?> </option>
                                            <?php } } ?>
                                        </select>
                                        <input type="hidden" id="cat_id" value="<?= $product->category?>">
                                    </div>
                                </div>
                                <?php $getsubcatdata = $this->db->query("SELECT * FROM marketplace_submenu WHERE cat_id = '".$product->category."' AND status = '1'")->result_array(); ?>
                                <div class="col-lg-6 col-12" id="subcategoryblock" style="display: <?php if(!empty($getsubcatdata)) {echo "block"; } else {echo "none"; }?>">
                                    <div class="form-group">
                                        <label>Sub Category</label>
                                        <select class="form-control" name="frm[prsubmenuId]" id="prsubmenuId">
                                        <option value="">Select Sub Category</option>
                                        <?php
                                        foreach($getsubcatdata as $key) {?>
                                        <option value="<?= $key['submenuId']; ?>" <?php if($key['submenuId'] == $product->prsubmenuId) {echo "selected"; }?>><?php echo $key['name'];?></option>
                                        <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label>Product Name</label>
                                        <input placeholder="Product Name" value="<?= $product->productName ?>" class="form-control" name="frm[productName]" type="text" required>
                                    </div>
                                </div>
                                <!-- <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label>Product Code</label>
                                        <input class="form-control" placeholder="Product Code" name="frm[prcode]" value="<?= $product->prcode ?>" type="text">
                                    </div>
                                </div> -->
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label>Product Type</label>
                                        <input class="form-control" placeholder="Product Type" name="frm[product_type]" value="<?= $product->product_type ?>" type="text">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label>Brand/Vendor Name</label>
                                        <!-- <input class="form-control" placeholder="Brand Name" name="frm[brand_name]" value="<?= $product->brand_name ?>" type="text"> -->
                                        <select class="form-control" name="frm[brand_name]" required>
                                            <option value="">Select</option>
                                            <?php if (is_array($brandList) && count($brandList) > 0) {
                                            foreach ($brandList as $brand) { ?>
                                            <option value="<?= $brand->id ?>" <?php if ($product->brand_name == $brand->id) { echo "selected"; } ?>><?= $brand->brand_name ?> </option>
                                            <?php } } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label>Regular Price</label>
                                        <input class="form-control" placeholder="Regular Price" name="frm[maxPrice]" value="<?= $product->maxPrice ?>" id="maxPrice" type="number" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label>Discount %</label>
                                        <input class="form-control" placeholder="Discount %" name="frm[disc_percent]" value="<?= $product->disc_percent ?>" id="disc_percent" type="number" onkeyup="fetchprice()">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label>Offered Price</label>
                                        <input class="form-control" placeholder="Offred Price" name="frm[offprice]" value="<?= $product->offprice ?>" id="offedprice" type="number" readonly required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label>SKU</label>
                                        <input class="form-control" placeholder="SKU" name="frm[sku]" value="<?= $product->sku ?>" type="text">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label>Inventory</label>
                                        <input class="form-control" placeholder="Inventory" value="<?= $product->inventory ?>" name="frm[inventory]" type="text">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label>Collections</label>
                                        <input class="form-control" placeholder="Collections" value="<?= $product->collections ?>" name="frm[collections]" type="text">
                                    </div>
                                </div>
                                <!-- <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label>SKU</label>
                                        <input class="form-control" placeholder="SKU" name="frm[sku]" value="<?= $product->sku ?>" type="text" >
                                    </div>
                                </div> -->
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label>Tags</label>
                                        <input class="form-control" placeholder="Tags" value="<?= $product->tags ?>" name="frm[tags]" type="text">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label>Shipping Charges($)</label>
                                        <input class="form-control" placeholder="Shipping Charges" name="frm[shipping_charge]" type="text" value="<?= $product->shipping_charge ?>">
                                    </div>
                                </div>
                                <!--  <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label>Variants</label>
                                        <input  class="form-control" placeholder="Enter Variants using TAB" name="frm[variants]" type="text" value="<?= $product->variants ?>"  data-role="tagsinput">
                                    </div>
                                </div> -->
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label>SEO Title</label>
                                        <input class="form-control" placeholder="SEO Title"
                                            value="<?= $product->seo_title ?>" name="frm[seo_title]" type="text">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label>SEO Meta Description</label>
                                        <input class="form-control" placeholder="SEO Meta Description" value="<?= $product->seo_descr ?>" name="frm[seo_descr]" type="text">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label>Return Or Cancel within days</label>
                                        <input class="form-control" placeholder="return day" name="frm[return_day]" value="<?= $product->return_day ?>" min="1" type="number">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label>Upload Product Images</label><br>
                                        <input type="file" name="files[]" class="form-control" multiple><br />
                                        <?php foreach ($mindprdctimg as $mprdimg) { ?>
                                            <div class="boxuploadImg">
                                                <img src="<?= site_url('assets/images/products/' . $mprdimg->productImage) ?>" class="img-responsive">
                                                <a href="<?= admin_url('products/delete_productImg/' . $mprdimg->productImageId . '/' . $product->productId) ?>" onclick="return confirm('Are you sure want to delete')" class="deleteimg"><i class="fa fa-trash" area-hidden="true"> </i>Delete</a>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label>Shipping Information</label>
                                        <textarea class="form-control" name="frm[shipping_info]"><?= $product->shipping_info ?></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label>Short Description</label>
                                        <textarea class="form-control" name="frm[description]"><?= $product->description ?></textarea>
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

<script>
function fetchprice() {
    var regPrice = $("#maxPrice").val();
    var dprcnt = $("#disc_percent").val();
    var offprc = (regPrice-(dprcnt/100) * regPrice);
    //var discprc = Math.round(regPrice - offprc);
    $("#offedprice").val(offprc);
}
$('#category').on('change', function() {
    var cat_id = $(this).val();
    $.ajax({
        type: "POST",
        url: "<?= site_url('admin/products/getmrktsubcategory') ?>",
        data: { cat_id: cat_id }, // Sending the category ID
        success: function(response) {
            if (response && response.length > 0) {
                $("#subcategoryblock").show();
                $("#prsubmenuId").html(response);
                $("#prsubmenuId").prop('required', true);
            } else {
                $("#subcategoryblock").hide();
                $("#prsubmenuId").prop('required', false);
            }
        },
        error: function(xhr, status, error) {
            // Handle any errors
            console.error(error);
        }
    });
});
</script>