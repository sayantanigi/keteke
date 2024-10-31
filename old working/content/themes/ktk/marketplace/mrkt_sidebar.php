<div class="myaccount-tab-menu nav" role="tablist">
           <a href="<?=site_url('seller-dashboard')?>" <?php if($load=='marketplace/seller_dashboard'){ ?>class="active" <?php } ?> ><i class="fa fa-dashboard"></i>
           Dashboard</a>
           <a href="<?=site_url('seller-customers')?>" <?php if($load=='marketplace/seller_view_customers'){ ?>class="active" <?php } ?> ><i class="fa fa-user"></i>
           Manage Accounts</a>
           
           <a href="<?=site_url('abandoned-checkouts')?>" <?php if($load=='marketplace/seller_abadoned_checkout'){ ?>class="active" <?php } ?> ><i class="fa fa-product-hunt"></i>
           Abandoned checkouts</a>
           <a href="<?=site_url('draft-orders')?>" <?php if($load=='marketplace/draft_orders_list'){ ?>class="active" <?php } ?> ><i class="fa fa-dropbox"></i>
           Draft Orders</a>
           <a href="<?=site_url('seller-orders')?>" <?php if($load=='marketplace/seller_orders'){ ?>class="active" <?php } ?>  ><i class="fa fa-cart-arrow-down"></i> Order List</a>
           <a href="<?=site_url('view-products')?>" <?php if($load=='marketplace/seller_view_product') {?>class="active" <?php } ?>  ><i class="fa fa-shopping-bag" aria-hidden="true"></i> Product List</a>

           <a href="<?=site_url('add-product')?>" <?php if($load=='marketplace/seller_add_product') {?>class="active" <?php } ?> ><i class="fa fa-shopping-bag" aria-hidden="true"></i> Add New Product</a>

           <a href="<?=site_url('account-settings')?>" <?php if($load=='marketplace/seller_acc_settings') {?>class="active" <?php } ?> ><i class="fa fa-user"></i> Account Settings</a>

           <a href="<?=site_url('signout')?>"><i class="fa fa-sign-out"></i> Logout</a>
         </div>