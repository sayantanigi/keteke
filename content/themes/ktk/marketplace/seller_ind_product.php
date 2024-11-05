<div class="breadcrumb-area pt-10 pb-10 border-bottom mb-40">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-content">
                    <ul>
                    <li class="has-child"><a href="<?=site_url()?>">Home </a></li>
                    <li>Seller Dashboard</li>
                    </ul>
                </div>
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
                        <?php $this->load->front_view('marketplace/mrkt_sidebar',$this->data); ?>
                    </div>
                    <div class="col-lg-9 col-12">
                        <?php if($this -> session -> flashdata('success')) { ?>
                        <div class="alert alert-success alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <?php echo $this->session->flashdata('success');  $this->session->unset_userdata('success'); ?>
                        </div>
                        <?php }
                        if($this -> session -> flashdata('error')) { ?>
                        <div class="alert alert-danger alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <?php echo $this->session->flashdata('error');  $this->session->unset_userdata('error'); ?>
                        </div>
                        <?php }
                        $err = validation_errors();
                        if($err) { ?>
                        <div class="alert alert-warning alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <?php echo $err; ?>
                        </div>
                        <?php
                        }
                        ?>
                        <div class="tab-content" id="myaccountContent">
                            <div class="tab-pane fade show active" id="address-edit" role="tabpanel">
                                <div class="myaccount-content">
                                    <div class="account-details-form">
                                        <form action="javascript:void(0);">
                                            <div class="row">
                                                <div class="col-lg-6 col-12 mb-30">
                                                    <label>Select Category</label>
                                                    <select class="form-control" name="frm[category]">
                                                        <option value="">Select</option>
                                                        <?php if(is_array($mcategoty) && count($mcategoty)>0) {
                                                            foreach ($mcategoty as $mcat) { ?>
                                                            <option value="<?=$mcat->id?>" <?php if($mindprdct->category==$mcat->id){echo"selected";} ?>><?=$mcat->name?></option>
                                                        <?php } } ?>
                                                    </select>
                                                </div>
                                                <?php if($mindprdct->category=="2") { ?>
                                                <div class="col-lg-6 col-12 mb-30" id="clothmenu" >
                                                    <label>Product Sub category</label>
                                                    <select class="form-control" name="frm[prsubmenuId]">
                                                        <option value="">Select</option>
                                                        <?php if(is_array($mcatsubmenu) && count($mcatsubmenu)>0){
                                                        foreach ($mcatsubmenu as $msub) { ?>
                                                        <option value="<?=$msub->submenuId?>" <?php if($msub->submenuId==$mindprdct->prsubmenuId){echo "selected";} ?>><?=$msub->name?></option>
                                                        <?php } } ?>
                                                    </select>
                                                </div>
                                                <?php } ?>
                                                <div class="col-lg-6 col-12 mb-30">
                                                    <label>Product Name</label>
                                                    <input placeholder="Product Name" name="frm[productName]" value="<?=$mindprdct->productName?>" type="text">
                                                </div>
                                                <div class="col-lg-6 col-12 mb-30">
                                                    <label>Product Code</label>
                                                    <input placeholder="Product Code" name="frm[prcode]" value="<?=$mindprdct->prcode?>" type="text">
                                                </div>
                                                <div class="col-lg-6 col-12 mb-30">
                                                    <label>Regular Price</label>
                                                    <input placeholder="Regular Price" name="frm[maxPrice]" value="<?=$mindprdct->maxPrice?>" type="number">
                                                </div>
                                                <div class="col-lg-6 col-12 mb-30">
                                                    <label>Discount %</label>
                                                    <input placeholder="Discount %" onkeyup="fetchprice()" id="disc_percent" name="frm[disc_percent]" value="<?=$mindprdct->disc_percent?>" type="number">
                                                </div>
                                                <div class="col-lg-6 col-12 mb-30">
                                                    <label>Offered Price</label>
                                                    <input placeholder="Offered Price" name="frm[offprice]" value="<?=$mindprdct->offprice?>" type="number">
                                                </div>
                                                <div class="col-lg-12 col-12 mb-30">
                                                    <label>Short Description</label>
                                                    <textarea class="form-control" name="frm[description]"><?=$mindprdct->description?></textarea>
                                                </div>
                                                <div class="col-lg-6 col-12 mb-30">
                                                    <label>Brand Nme</label>
                                                    <input placeholder="Brand Name" name="frm[brand_name]" type="text" value="<?=$mindprdct->brand_name?>">
                                                </div>
                                                <div class="col-lg-6 col-12 mb-30">
                                                    <label>Shipping Charges</label>
                                                    <input placeholder="Shipping Charges" name="frm[shipping_charge]" type="text" value="<?=$mindprdct->shipping_charge?>">
                                                </div>
                                                <div class="col-lg-12 col-12 mb-30">
                                                    <label>Uploaded Product Images</label><br>
                                                    <?php foreach ($mindprdctimg as $mprdimg) { ?>
                                                    <div class="boxuploadImg">
                                                        <img src="<?=site_url('assets/images/products/'.$mprdimg->productImage)?>" class="img-responsive">
                                                    </div>
                                                    <?php } ?>
                                                </div>
                                                <div class="col-lg-12 col-12 mb-30">
                                                    <button class="save-change-btn" onclick="goBack()">Back</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>