<style>
    .tablefontsmall td,
    .tablefontsmall th {
        font-size: 13px;
    }

    .tablefontsmall .btn-sm {
        font-size: 10px;
    }
</style>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Order Details</h3>
                </div>
                <div class="card-body">

                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered tablefontsmall">
                            <tr>
                                <th width="50px">SL No.</th>
                                <th>Details</th>
                                <th>Price Details</th>
                                <th>Category</th>
                                <th>Brand Name</th>
                                <th>Order Status</th>
                                <th width="80px">Order Date</th>
                            </tr>
                            <?php
                            if (is_array($ordrs) && count($ordrs) > 0) {
                                $i = 1;
                                foreach ($ordrs as $ord_v) {
                                    $mcatt = $this->Master_model->getSingleRow('id', $ord_v->category, 'mrkt_category');
                                    $primg = $this->Master_model->getSingleRow('productId', $ord_v->productId, 'product_images');

                                    $shaddr = $this->Master_model->getSingleRow('order_id', $ord_v->orderid, 'customer_shipping_addrs');

                                    $baddr = $this->Master_model->getSingleRow('order_id', $ord_v->orderid, 'customer_billing_addrs');

                                    ?>
                                    <tr>
                                        <td><?= $i ?></td>
                                        <td><img src="<?= site_url('assets/images/products/' . @$primg->productImage) ?>"
                                                width="80px" onerror="this.src='<?= site_url('assets/images/no-image.png'); ?>';">
                                            <p>prcode: <?= @$ord_v->prcode ?><br>
                                                <?= @$ord_v->productName ?></p>
                                            <p> Qty: <?= @$ord_v->quantity ?></p>
                                        </td>
                                        <td>
                                            <p>Offer Price: <?= $ord_v->offprice ?> USD<br>
                                                Actual Price: <?= $ord_v->maxPrice ?> USD<br>
                                                Disc %: <?= $ord_v->disc_percent ?></p>
                                        </td>
                                        <td><?= @$mcatt->name ?></td>
                                        <td>
                                            <?php $brand_name = $this->db->query("SELECT * FROM product_brand WHERE id = '".$ord_v->brand_name."'")->row();
                                            echo @$brand_name->brand_name;
                                            ?>
                                        </td>
                                        <td><?= @$ord_v->order_status ?></td>
                                        <td><?= date('d M Y', strtotime($ord_v->order_date)) ?></td>
                                    </tr>
                                    <?php
                                    $i++;
                                }
                            }
                            ?>
                            <tr>
                                <th colspan="2">Billing Address</th>
                                <th colspan="2">Shipping Address</th>
                                <th colspan="2">Payment Information</th>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <?php if ($ord_v->billing_addr == 1) { ?>
                                        <p><?= $baddr->billing_fname . ' ' . $baddr->billing_lname ?></p>
                                        <p><?= $baddr->billing_address ?></p>
                                        <p><?= $baddr->billing_city . ',' . $baddr->billing_state . ',' . $baddr->billing_country . ',' . $baddr->billing_zip ?>
                                        </p>
                                        <p>Phone: <?= $baddr->billing_phone ?></p>
                                        <p>Email: <?= $baddr->billing_email ?></p>
                                    <?php } ?>
                                </td>
                                <td colspan="2">
                                    <?php if ($ord_v->shipping_addr == 1) { ?>
                                        <p><?= $shaddr->shipping_fname . ' ' . $shaddr->shipping_lname ?></p>
                                        <p><?= $shaddr->shipping_address ?></p>
                                        <p><?= $shaddr->shipping_city . ',' . $shaddr->shipping_state . ',' . $shaddr->shipping_country . ',' . $shaddr->shipping_zip ?>
                                        </p>
                                        <p>Phone: <?= $shaddr->shipping_phone ?></p>
                                        <p>Email: <?= $shaddr->shipping_email ?></p>
                                    <?php } ?>
                                </td>
                                <td colspan="3">
                                    <b>Total Paid :</b> <?= $payInfo->payment_gross ?> USD<br>
                                    <b>Transaction Date:</b> <?= date('m-d-Y', strtotime($payInfo->date)) ?><br>
                                    <b>Transaction ID:</b> <?= $payInfo->txn_id ?><br>
                                    <b>Order ID:</b> <?= $payInfo->order_id ?>
                                </td>
                            </tr>

                        </table>
                        <a class="btn btn-success text-right" href="<?= admin_url('products/transactions') ?>">Back to
                            Order lists</a>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
    </div>
</section>