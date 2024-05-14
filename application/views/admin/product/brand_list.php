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
                    <h3 class="card-title">Product Brand List</h3>
                </div>
                <div class="card-body">
                    <a href="<?= admin_url('products/add_brand/') ?>" class="btn btn-info btn-sm float-right"><i class="fa fa-plus"></i> Add Brand</a>
                    <div class="box-body">
                        <table id="ex" class="table table-bordered tablefontsmall">
                            <thead>
                                <tr>
                                    <th>SL No.</th>
                                    <th>Brand Image</th>
                                    <th>Brand Name</th>
                                    <th>Status</th>
                                    <th width="80px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                               if (!empty($brandList)) {
                                $i = 1;
                                foreach ($brandList as $brandList_v) { ?>
                                <tr>
                                    <td><?= $i ?></td>
                                    <td><img src="<?= site_url('assets/images/products/brand/' . @$brandList_v['brand_image']) ?>" width="80px" onerror="this.src='<?= site_url('assets/images/no-image.png'); ?>';"></td>
                                    <td><?= @$brandList_v['brand_name'] ?></td>
                                    <td>
                                        <?php if ($brandList_v['status'] == 1) { ?>
                                        <a href="<?= admin_url('products/change_status_brand/' . $brandList_v['id']) ?>"><span class="badge bg-green">Active</span></a>
                                        <?php } else { ?>
                                        <a href="<?= admin_url('products/change_status_brand/' . $brandList_v['id']) ?>"><span class="badge bg-red">Inactive</span></a>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <div class="action-button">
                                            <a href="<?= admin_url('products/edit_brand/' . $brandList_v['id']) ?>" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>
                                            <a href="<?= admin_url('products/delete_brand/' . $brandList_v['id']) ?>" class="btn btn-secondary btn-sm"><i class="fa fa-trash"></i></a>
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