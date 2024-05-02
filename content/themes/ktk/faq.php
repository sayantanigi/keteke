<div id="page-title" class="page-title text-center pt-11">
   <div class="container">
      <div class="h-100">
         <h1 class="mb-0 letter-spacing-50" data-animate="fadeInDown">
            Frequently Asked Questions
         </h1>
         <ul class="breadcrumb justify-content-center" data-animate="fadeInUp">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><span>FAQs</span></li>
         </ul>
      </div>
   </div>
</div>
<div id="wrapper-content" class="wrapper-content py-3">
<div class="container">
<div id="section-accordion" class="faqs mb-11">
   <div class="container">
      <div class="row">
         <div class="col-md-8 offset-md-2">
            <div class="accordion accordion-style-02" id="accordionExample-01">
               <?php if(is_array($faq) && count($faq)>0){
                  $i=0;
               foreach ($faq as $faqs) {
                  $i++;
                    ?>

               <div class="card">
                  <a href="#collapse<?=$i?>-01" class="card-header d-flex align-items-center text-decoration-none" data-toggle="collapse" <?php if($i==1){?>aria-expanded="true"<?php } else{?> aria-expanded="false" <?php } ?> aria-controls="collapse<?=$i?>-01" id="heading<?=$i?>-01">
                  <span class="card-title mb-0 text-dark font-weight-semibold font-size-lg pl-0 pr-5">
                  <?=$faqs->title?>
                  </span>
                  <span class="dynamic-icon"></span>
                  </a>
                  <div id="collapse<?=$i?>-01" class="collapse <?php if($i==1){?>show<?php } else{ } ?>" aria-labelledby="heading<?=$i?>-01" data-parent="#accordionExample-01">
                     <div class="card-body">
                       <?=$faqs->description?>
                     </div>
                  </div>
               </div>
            <?php } } ?>
        
            </div>
         </div>
      </div>
   </div>
</div>

<div class="text-center pb-5">
<div class="mb-6">
<h4 class="mb-1">Join Us Today and Get More Profit From Your Business</h4>
<p class="mb-0 font-size-md">The easiest way to get more interest in your place</p>
</div>
<a href="<?=site_url('create-listing')?>" class="button button--large button--primary">Get Start Now!</a>
</div>
</div>
</div>