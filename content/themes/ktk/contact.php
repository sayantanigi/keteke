<main class="main-one" id="main-one"> 
        <section class="container">
          <div class="home-part-one">
            <div class="row">
              <div class="col-sm-12 col-md-12 col-xl-6 col-lg-6 search">
                <form> 
                  <h1 class="contactfont">We'd love to hear from you</h1>
                  <h1 class="nirmala-bold pt-4 pb-4">
                    Just say a hello.
                  </h1>
                  <p class="nirmala-light">
                    Feel free to get in touch with us.<br>
                    We are always here to help our people.</p>
                  <br>
                  <h2 class="nirmala-light">Need help?</h2>
                  <h4  class="nirmala-light contactinfo text-danger"><i class="fa fa-envelope"></i> &nbsp; <?=theme_option('email')?></h4>
                  <br>
                  <h2 class="nirmala-light">Feel like talking!</h2>
                  <h4 class="nirmala-light contactinfo text-danger"><i class="fa fa-phone"></i> &nbsp; <?=theme_option('phone')?></h4><br>
                  <a href="<?=theme_option('insta')?>" class="red fa fa-instagram"></a>
                  <a href="<?=theme_option('twitter')?>" class="red fa fa-twitter"></a>
                  <a href="<?=theme_option('facebook')?>" class="red fa fa-facebook"></a>
                </form>
              </div>
              <div class="col-sm-12 col-md-12 col-xl-6 col-lg-6">
                <div class="row">
                  <div class="col-md-8 offset-md-2">
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
                      <div class="alert alert-danger alert-dismissible">
                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                          <?php echo $this -> session -> flashdata('error'); ?>
                      </div>
                      <?php
                  }
                  $err = validation_errors();
                  if($err){
                      ?>
                      <div class="alert alert-warning alert-dismissible">
                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                          <?php echo $err; ?>
                      </div>
                      <?php
                  }
                  ?>
                </div>
              </div>
                <div class="dline reachbox">

                  <form action="<?=site_url('reach')?>" method="post">
                    <h2 clas="nirmala-light" style="color:red"> Drop a line</h2>
                    <input type="text" name="frm[name]" placeholder="Fullname" required> 
                    <input type="email" name="frm[email]" placeholder="Email" required=""> 
                    <input type="text" name="frm[subject]" placeholder="Subject">
                    <textarea rows="6" name="frm[message]" placeholder="Message..">  </textarea><br>
                    <input type="submit" value="Send Message">
                    <input type="submit" onclick="goBack()" value="Cancel">
                  </form>
                </div>
              </div>
            </div>
          </div>
        </section>
      </main>
      <section>
        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d117086.1432907867!2d87.26601343598631!3d23.4985993018649!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sin!4v1632132541962!5m2!1sen!2sin" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
      </section>