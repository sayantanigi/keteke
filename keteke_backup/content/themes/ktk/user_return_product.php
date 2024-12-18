<main class="main-one" id="main-one" > 

  <div class="container">
    
    <div class="bootstrap snippets bootdey">
      <div class="row">
        <div class="profile-nav col-md-3">
    <?php
          $this->load->front_view('user_sidebar',$this->data);
           ?>
        </div>
<div class="profile-info col-md-9">
  <div class="panel-body bio-graph-info">
    <h1>Order Return</h1>
    <!-- Single Tab Content Start -->
    <div class="myaccount-content">

              <?php 
                if($this -> session -> flashdata('success')){
              ?>
              <div class="alert alert-success alert-dismissible">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <?php echo $this -> session -> flashdata('success'); ?>
              </div>
              <?php
          }
          if($this -> session -> flashdata('error')){
              ?>
              <div class="alert alert-primary alert-dismissible">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <?php echo $this -> session -> flashdata('error'); ?>
              </div>
              <?php
          }
              ?>
              <form class="animate__animated animate__backInRight" action="<?=site_url('user/return_order_success/'.$orderId)?>" method="POST">
                  <h5>Return Product</h5>
                  <div class="">
                    <input type="text" class="form-control"  readonly value="<?=$product->productName?>" required>
                  </div>
                   <h5>Reason why you want to return order</h5>
                  <div class="">
                    <textarea name="return_reason" class="form-control" rows="6"></textarea>
                  </div>
                  <div class="form-item-submit">
                    <input type="submit" value="Return" name="submit">
                  </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>