<style>
    .tablefontsmall td,
    .tablefontsmall th {
        font-size: 13px;
    }

    .tablefontsmall .btn-sm {
        font-size: 10px;
    }
</style>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Products List</h3>
                </div>
                <div class="card-body">
                    <a href="<?= admin_url('products/add/') ?>" class="btn btn-info btn-sm float-right"><i class="fa fa-plus"></i> Add product</a>
                    <div class="box-body">
                        <table id="ex" class="table table-bordered tablefontsmall">
                            <thead>
                                <tr>
                                    <th>SL No.</th>
                                    <th>Details</th>
                                    <th>Price Details</th>
                                    <th>Category</th>
                                    <th>Brand Name</th>
                                    <th>Prefer List</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th width="80px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (is_array($products) && count($products) > 0) {
                                $i = 1;
                                foreach ($products as $products_v) {
                                    $mcatt = $this->Master_model->getSingleRow('id', $products_v->category, 'mrkt_category');
                                    $primg = $this->Master_model->getSingleRow('productId', $products_v->productId, 'product_images');
                                    ?>
                                <tr>
                                    <td><?= $i ?></td>
                                    <td><img src="<?= site_url('assets/images/products/' . @$primg->productImage) ?>" width="80px" onerror="this.src='<?= site_url('assets/images/no-image.png'); ?>';">
                                        <p>prcode: <?= @$products_v->prcode ?><br> <?= @$products_v->productName ?></p>
                                    </td>
                                    <td>
                                        <p>Offer Price:$<?= $products_v->offprice ?><br>Actual Price:$<?= $products_v->maxPrice ?><br>Disc %: <?= $products_v->disc_percent ?></p>
                                    </td>
                                    <td><?= @$mcatt->name ?></td>
                                    <td>
                                        <?php
                                        $brandName = $this->db->query("SELECT * FROM product_brand WHERE id = '".$products_v->brand_name."'")->row();
                                        echo $brandName->brand_name;
                                        ?>
                                    </td>
                                    <td>
                                        <?php if ($products_v->prefer_list == 1) { ?>
                                        <a href="<?= admin_url('products/PreferDeactivate/' . $products_v->productId) ?>"><span class="badge bg-green">Yes</span></a>
                                        <?php } else { ?>
                                        <a href="<?= admin_url('products/PreferActivate/' . $products_v->productId) ?>"><span class="badge bg-red">No</span></a>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?php if ($products_v->status == 1) { ?>
                                        <a href="<?= admin_url('products/deactivate/' . $products_v->productId) ?>"><span class="badge bg-green">Active</span></a>
                                        <?php } else { ?>
                                        <a href="<?= admin_url('products/activate/' . $products_v->productId) ?>"><span class="badge bg-red">Inactive</span></a>
                                        <?php } ?>
                                    </td>
                                    <td><?= date('d M Y', strtotime($products_v->created)) ?></td>
                                    <td>
                                        <div class="action-button">
                                            <a href="<?= admin_url('products/editproduct/' . $products_v->productId) ?>" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>
                                            <a href="<?= admin_url('products/delete/' . $products_v->productId) ?>" class="btn btn-secondary btn-sm"><i class="fa fa-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                <?php $i++; } } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="box-footer clearfix">
                    <?= @$paginate ?>
                </div>
            </div>
        </div>
    </div>
</section>