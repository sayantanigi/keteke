<div class="breadcrumb-area pt-10 pb-10 border-bottom mb-40">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!--=======  breadcrumb content  =======-->
                <div class="breadcrumb-content">
                    <ul>
                        <li class="has-child"><a href="<?= site_url() ?>">Home </a></li>
                        <li>Seller Dashboard</li>
                    </ul>
                </div>
                <!--=======  End of breadcrumb content  =======-->
            </div>
        </div>
    </div>
</div>
<div class="page-section pb-40">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-lg-3 col-12">
                        <?php
                        $this->load->front_view('marketplace/mrkt_sidebar', $this->data);
                        ?>
                    </div>
                    <div class="col-lg-9 col-12">
                        <?php if ($this->session->flashdata('success')) { ?>
                        <div class="alert alert-success alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <?php echo $this->session->flashdata('success'); unset($_SESSION['success']); ?>
                        </div>
                        <?php }
                        if ($this->session->flashdata('error')) { ?>
                        <div class="alert alert-danger alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <?php echo $this->session->flashdata('error'); unset($_SESSION['error']);?>
                        </div>
                        <?php
                        }
                        $err = validation_errors();
                        if ($err) { ?>
                        <div class="alert alert-warning alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <?php echo $err; ?>
                        </div>
                        <?php } ?>
                        <div class="tab-content" id="myaccountContent">
                            <!-- Single Tab Content Start -->
                            <div class="tab-pane fade show active" id="address-edit" role="tabpanel">
                                <div class="myaccount-content">
                                    <h3>Add New Product</h3>
                                    <div class="account-details-form">
                                        <form action="<?= site_url('add-product') ?>" method="post"
                                            enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-lg-6 col-12 mb-30">
                                                    <label>Select Product Category <span class="red">*</span></label>
                                                    <select class="form-control" name="frm[category]" onchange="getSubMenu($(this).val())" required>
                                                        <option value="">Select</option>
                                                        <?php
                                                        if (is_array($mcategoty) && count($mcategoty) > 0) {
                                                        foreach ($mcategoty as $mcat) { ?>
                                                        <option value="<?= $mcat->id ?>"><?= $mcat->name ?></option>
                                                        <?php } } ?>
                                                    </select>
                                                </div>
                                                <div class="col-lg-6 col-12 mb-30" id="clothmenu" style="display: none;">
                                                    <label>Product Sub category</label>
                                                    <select class="form-control" name="frm[prsubmenuId]" id="sub_cat">
                                                        <option value="">Select</option>
                                                        <?php if (is_array($mcatsubmenu) && count($mcatsubmenu) > 0) {
                                                        foreach ($mcatsubmenu as $msub) { ?>
                                                        <option value="<?= $msub->submenuId ?>"><?= $msub->name ?> </option>
                                                        <?php } } ?>
                                                    </select>
                                                </div>
                                                <div class="col-lg-6 col-12 mb-30">
                                                    <label>Product Name<span class="red">&nbsp; *</span></label>
                                                    <input placeholder="Product Name" name="frm[productName]"
                                                        type="text">
                                                </div>
                                                <div class="col-lg-6 col-12 mb-30">
                                                    <label>Product Code<span class="red">&nbsp; *</span></label>
                                                    <input placeholder="Product Code" name="frm[prcode]" type="text">
                                                </div>
                                                <div class="col-lg-6 col-12 mb-30">
                                                    <label>Product Type</label>
                                                    <input placeholder="Product Type" name="frm[product_type]"
                                                        type="text">
                                                </div>
                                                <div class="col-lg-6 col-12 mb-30">
                                                    <label>Brand/Vendor Name</label>
                                                    <input placeholder="Brand Name" name="frm[brand_name]" type="text">
                                                </div>
                                                <div class="col-lg-6 col-12 mb-30">
                                                    <label>Regular Price($)<span class="red">&nbsp; *</span></label>
                                                    <input placeholder="Regular Price" id="maxPrice" name="frm[maxPrice]" type="number">
                                                </div>
                                                <div class="col-lg-6 col-12 mb-30">
                                                    <label>Discount %</label>
                                                    <input placeholder="Discount %" id="disc_percent" name="frm[disc_percent]" type="number">
                                                </div>
                                                <div class="col-lg-6 col-12 mb-30">
                                                    <label>Offered Price($)<span class="red">&nbsp; *</span></label>
                                                    <input placeholder="Offered Price" name="frm[offprice]" type="number" id="offedprice" readonly>
                                                </div>
                                                <div class="col-lg-6 col-12 mb-30">
                                                    <label>SKU<span class="red">&nbsp; *</span></label>
                                                    <input placeholder="Add unique identifier for the product"
                                                        name="frm[sku]" type="text">
                                                </div>
                                                <div class="col-lg-6 col-12 mb-30">
                                                    <label>Inventory</label>
                                                    <input placeholder="Inventory" name="frm[inventory]" type="text">
                                                </div>
                                                <div class="col-lg-6 col-12 mb-30">
                                                    <label>Collections</label>
                                                    <input placeholder="Collections" name="frm[collections]"
                                                        type="text">
                                                </div>
                                                <div class="col-lg-6 col-12 mb-30">
                                                    <label>Tags</label>
                                                    <input placeholder="Tags" name="frm[tags]" type="text">
                                                </div>
                                                <div class="col-lg-12 col-12 mb-30">
                                                    <label>Shipping Information</label>
                                                    <textarea class="form-control" name="frm[shipping_info]"></textarea>
                                                </div>
                                                <div class="col-lg-12 col-12 mb-30">
                                                    <label>Short Description</label>
                                                    <textarea class="form-control" name="frm[description]"></textarea>
                                                </div>
                                                <div class="col-lg-6 col-12 mb-30">
                                                    <label>Shipping Charges</label>
                                                    <input placeholder="Shipping Charges" name="frm[shipping_charge]"
                                                        type="text">
                                                </div>
                                                <div class="col-lg-6 col-12 mb-30 tagfullwidth">
                                                    <label>Variants</label>
                                                    <input placeholder="Enter Variants using TAB" name="frm[variants]"
                                                        type="text" data-role="tagsinput" class="form-control">
                                                </div>
                                                <div class="col-lg-12 col-12 mb-30">
                                                    <label>SEO Title</label>
                                                    <input placeholder="SEO Title" name="frm[seo_title]" type="text">
                                                </div>
                                                <div class="col-lg-12 col-12 mb-30">
                                                    <label>SEO Meta Description</label>
                                                    <input placeholder="SEO Meta Description" name="frm[seo_descr]"
                                                        type="text">
                                                </div>
                                                <div class="col-lg-6 col-12 mb-30">
                                                    <label>Upload Product Images(1000*1000)</label>
                                                    <input type="file" name="files[]" multiple>
                                                </div>
                                                <div class="col-lg-12 col-12 mb-30">
                                                    <label>Return Or Cancel within days</label>
                                                    <input placeholder="return day" name="frm[return_day]" min="1"
                                                        type="number">
                                                </div>
                                                <div class="col-lg-12 col-12 mb-30">
                                                    <button class="save-change-btn" type="submit">Upload
                                                        Product</button>
                                                    <button class="save-change-btn" onclick="goBack()">Cancel</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Single Tab Content End -->
                        </div>
                    </div>
                    <!-- My Account Tab Content End -->
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$('#maxPrice').keyup(function() {
    var regPrice = parseFloat($("#maxPrice").val());
    var dprcnt = parseFloat($("#disc_percent").val());
    if($('#disc_percent').val() != "") {
        var offprc = (regPrice * dprcnt) / 100;
        var discprc = regPrice - offprc;
        $("#offedprice").val(discprc.toFixed(1));
    } else {
        $("#offedprice").val(regPrice.toFixed(1));
    }
})
$('#disc_percent').keyup(function() {
    var regPrice = $("#maxPrice").val();
    var dprcnt = $("#disc_percent").val();
    if($('#disc_percent').val() != "") {
        var offprc = (regPrice * dprcnt) / 100;
        var discprc = regPrice - offprc;
        $("#offedprice").val(discprc.toFixed(1));
    } else {
        $("#offedprice").val(regPrice.toFixed(1));
    }
})

function getSubMenu(cat_id) {
    $.ajax({
        url: "<?= base_url('Shop/get_sub_cat') ?>",
        type: "POST",
        data: {cat_id: cat_id},
        success: function(data) {
            if(data != "") {
                $('#clothmenu').show();
                $('#sub_cat').html(data);
            } else {
                $('#clothmenu').hide();
            }
        }
    });
}
</script>