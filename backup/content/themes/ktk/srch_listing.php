<main class="main-one" id="main-one" > 

	<div class="container">

		<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="122" height="109" viewBox="0 0 122 109">

			<defs>

				<style>

					.cls-1 {

						fill: red;

					}



					.cls-2 {

						filter: url(#Rectangle_22);

					}



					.cls-3 {

						filter: url(#Rectangle_21);

					}



					.cls-4 {

						filter: url(#Rectangle_20);

					}

				</style>

				<filter id="Rectangle_20" x="64" y="14" width="58" height="58" filterUnits="userSpaceOnUse">

					<feOffset input="SourceAlpha"/>

					<feGaussianBlur stdDeviation="3" result="blur"/>

					<feFlood flood-opacity="0.239"/>

					<feComposite operator="in" in2="blur"/>

					<feComposite in="SourceGraphic"/>

				</filter>

				<filter id="Rectangle_21" x="0" y="0" width="72" height="72" filterUnits="userSpaceOnUse">

					<feOffset input="SourceAlpha"/>

					<feGaussianBlur stdDeviation="3" result="blur-2"/>

					<feFlood flood-opacity="0.239"/>

					<feComposite operator="in" in2="blur-2"/>

					<feComposite in="SourceGraphic"/>

				</filter>

				<filter id="Rectangle_22" x="29" y="64" width="43" height="45" filterUnits="userSpaceOnUse">

					<feOffset input="SourceAlpha"/>

					<feGaussianBlur stdDeviation="3" result="blur-3"/>

					<feFlood flood-opacity="0.239"/>

					<feComposite operator="in" in2="blur-3"/>

					<feComposite in="SourceGraphic"/>

				</filter>

			</defs>

			<g id="Group_351" data-name="Group 351" transform="translate(-98 -288)">

				<g class="cls-4" transform="matrix(1, 0, 0, 1, 98, 288)">

					<rect id="Rectangle_20-2" data-name="Rectangle 20" class="cls-1" width="40" height="40" rx="10" transform="translate(73 23)"/>

				</g>

				<g class="cls-3" transform="matrix(1, 0, 0, 1, 98, 288)">

					<rect id="Rectangle_21-2" data-name="Rectangle 21" class="cls-1" width="54" height="54" rx="10" transform="translate(9 9)"/>

				</g>

				<g class="cls-2" transform="matrix(1, 0, 0, 1, 98, 288)">

					<rect id="Rectangle_22-2" data-name="Rectangle 22" class="cls-1" width="25" height="27" rx="4" transform="translate(38 73)"/>

				</g>

			</g>

		</svg>

		<div class="bootstrap snippets bootdey">

			<div class="row">

				<?php if(is_array($businesslist) && count($businesslist)>0){

					foreach ($businesslist as $buslist) {

						$cat=$this->db->get_where('category',array('id'=>$buslist->category))->row();

						$rev=$this->db->get_where('user_listreview',array('business_id'=>$buslist->id))->num_rows();

						$con=$this->db->get_where('country',array('id'=>$buslist->country))->row();

						?>

						<div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">

							<div class="s-box">

								<div class="s-img"> 

									<?php if($buslist->images!=''){ ?>

										<img src="<?=site_url('assets/images/directory/'.$buslist->images)?>"/>

									<?php }else{ ?>

										<img src="<?=site_url('assets/images/profile/ser_demo.png')?>"/>

									<?php } ?>

									<span><?=$cat->name?></span>

								</div>

								<div class="s-text">
									<div class="text-area-h">

									<h4><?=$buslist->title?></h4>

									<?php $rating= $this->Master_model->businessRating($buslist->id);

									if($rating > 0){ 

									?>

									<h5>Total no. of reviews (<?=$rev?>)</h5>

									<div class="businessRating">

										<?php for($k=0; $k<5; $k++){?>

										<?php if($k<$rating){?>

										<span class="fa fa-star checked"></span>

										<?php }else{ ?>

										

										<span class="fa fa-star "></span>



										<?php } } ?>

									</div>

								<?php } else{?>

									<h5>No rating</h5>

								<?php } ?>

									<p><?=$buslist->street_addr.','.$buslist->city.','.$con->name?></p>

									<p><?=$buslist->city?>,<?=$con->name?></p>

									<p><?=$buslist->website?></p>

									<p><?=$buslist->email?></p>

									<p><?=$buslist->phone?></p>
								</div>

									<div class="s-btn">

										<a href="javascript:void(0);" onclick="getreviews('<?=$buslist->id?>')" role="button" class="btn js__p_start"><i class="fa fa-commenting"></i> Reviews</a> 

										<a href="javascript:void(0);" onclick="setvalue('<?=$buslist->id?>')" class="btn btn-1 js__p_another_start"><i class="fa fa-comments"></i> Message</a>

									</div>

								</div>

							</div>

						</div>

					<?php } } else{ ?>

						<div class="col-lg-12 col-md-12 col-xs-12">

							<div class="text-center">

								<h3>No Business Found</h3>

								<p><a href="<?=site_url()?>" class="btn btn-warning">Back to Homepage</a></p>

								<img src="<?=site_url('assets/images/directory/no-data.png')?>">



							</div>

						</div>

					<?php } ?>

				</div>

			</div>

		</div>

		<!--REview Modal -->

		<div class="popup js__popup js__slide_top">

			<a href="#" class="p_close js__p_close" title="Close">

				X

			</a>

			<div class="p_content">

				<div class="review_section">

					<div class="review_head">

						<div class="row">

							<div class="col-lg-5 col-md-12">

								<h2>Reviews <span><button id="review-add-btn" aria-label="add review" title="Add Review"></button></span></h2>

							</div>

							<div class="col-lg-7 col-md-12 sortpnl">

								<h2>Sort By: 

								<button  aria-label="add review" title="Add Review" onclick="getordreview('new')" class="btnmodal">Newest</button>

								<button  aria-label="add review" onclick="getordreview('high')" title="Add Review" class="btnmodal">Highest</button>

								<button  aria-label="add review" onclick="getordreview('low')" title="Add Review" class="btnmodal">Lowest</button></span>

								</h2>

								<input type="hidden" value="" id="revieworder">

							</div>

						</div>

						

					</h2>

					</div>

					<p id="msgrev"></p>

					<input type="hidden" id="reviewmessageid" value="">

					<div class="review_body reviewPnl">

					

					</div>

					<div id="modal" role="dialog" aria-modal="true" aria-labelledby="add-review-header" class="">

						<button class="close-btn" aria-label="close" title="Close">x</button>

						<div id="review-form-container">

							<h2 id="add-review-header">Add Review</h2>

							<form id="review-form" action="javascript:void(0)" method="post">

								<div class="fieldset">

									<label for="reviewName">Name</label>



									<input type="hidden" value="" id="listingid">

									<input type="hidden" value="<?=$udetail->user_id?>" id="rvuserid">

									<input name="reviewName" id="reviewName" required="">

								</div>

								<div class="fieldset">

									<label>Rating</label>

									<div class="rate">

										<input type="radio" id="star5" name="rate" value="5" onkeydown="navRadioGroup(event)" onfocus="setFocus(event)" required="">

										<label for="star5" title="5 stars">5 stars</label>

										<input type="radio" id="star4" name="rate" value="4" onkeydown="navRadioGroup(event)">

										<label for="star4" title="4 stars">4 stars</label>

										<input type="radio" id="star3" name="rate" value="3" onkeydown="navRadioGroup(event)">

										<label for="star3" title="3 stars">3 stars</label>

										<input type="radio" id="star2" name="rate" value="2" onkeydown="navRadioGroup(event)">

										<label for="star2" title="2 stars">2 stars</label>

										<input type="radio" id="star1" name="https://codepen.io/pen/rate" value="1" onkeydown="navRadioGroup(event)" onfocus="setFocus(event)">

										<label for="star1" title="1 star">1 star</label>

									</div>

								</div>

								<div class="fieldset">

									<label for="reviewName">Subject</label>

									<input name="reviewSubject" id="reviewSubject" required="">

								</div>

								<div class="fieldset">

									<label for="reviewComments">Comments</label>

									<textarea name="reviewComments" id="reviewComments" cols="20" rows="5"  required=""></textarea>

								</div>

								<div class="fieldset right">

									<button id="submit-review-btn" onclick="reviewsubmit()">Submit</button>

								</div>

							</form>

						</div>

					</div>

					<div class="modal-overlay"></div> 

				</div> <!--Review Section ends here-->

			</div>

		</div>



		<div class="popup js__another_popup js__slide_top">

			<a href="#" class="p_close js__p_close" title="Close">

				X

			</a>

			<div class="p_content">

				<div id="fh5co-main">

					<div class="fh5co-narrow-content animate-box fadeInLeft animated" data-animate-effect="fadeInLeft">		

						<div class="row">

							<div class="col-md-12">

								<h1>Send a Message</h1> 

							</div>

						</div>

						<br /><br />

						<p id="messhow"></p>

						<form action="javascript:void(0);" onsubmit="messagesubmit()" id="messageForm" method="post">

							<div class="row">

								<div class="col-md-12">

									<div class="form-group">

										<input type="hidden" value="" id="listmsgid">

										<input type="text" id="msgname" class="form-control" placeholder="Name" required="">

									</div>

									<div class="form-group">

										<input type="text" id="msgEmail" class="form-control" placeholder="Email" required="">

									</div>

									<div class="form-group">

										<input type="text" id="msgphone" class="form-control" placeholder="Phone" required="">

									</div>

									<div class="form-group">

										<textarea  id="msgmessage" cols="30" rows="7" class="form-control" placeholder="Message" required=""></textarea>

									</div>

									<div class="form-group">

										<button type="submit" class="btn btn-primary btn-md">Send Message</button>

									</div>

								</div>



							</div>

						</form>

					</div>

				</div>

			</div>

		</div>

		

		<div class="p_body js__p_body js__fadeout"></div>

	</main>

	<script type="text/javascript">

		$(function() {

			$(".js__p_start, .js__p_another_start, .js__p_responseowner_start").simplePopup();

		});

		

	</script>

	<script>

		 function setvalue(listid){

		 	$("#listmsgid").val(listid);

		}

	</script>

	<script>

		function getreviews(reviewlistid){

		$('.reviewPnl').empty();

		$("#listingid").val(reviewlistid);

		 $("#reviewmessageid").val(reviewlistid);

		 var reviewmsglistid = $("#reviewmessageid").val();

		 var list="";

		<?php if(isprologin()){ ?>

			var ownerid = "<?php echo userid2();?>";

		<?php } ?>

    	$.ajax({

		type: "POST", 

		url:  '<?=site_url("welcome/get_moreReview")?>',  

		data: {reviewmsglistid:reviewmsglistid}, 

		dataType : 'json',

		beforeSend: function(){

		},success: function(response){

			console.log(response);



  					if(response.res.length > 0){ 





  						for(var i=0;i<response.res.length;i++){ 

  					            

  							list += '<div class="blog-card"><div class="description">';							

							list += '<h1>'+response.res[i].subject+'</h1>';

							for(var j=0;j<5;j++)

							{

							if(j<response.res[i].rating)

							{

							list += '<span class="fa fa-star checked"></span>';	

							}else{

								list += '<span class="fa fa-star"></span>';	

							}

							}

							list += '<br><h2>'+response.res[i].username+'</h2>';

							list += '<p>'+response.res[i].comments+'</p>';

							if(response.res[i].response_text.trim()!=''){

							list +='<h4>Response from the owner<span class="smallfornt">'+response.restime+'</span></h4>';

							list += '<p>'+response.res[i].response_text+'</p>';

							}

							if(response.res[i].userid==ownerid){ 

							list += '<a href="javascript:void(0);" role="button" onclick="replybutton()" class="btn btn-2 btn-warning">Reply</a><input type="hidden" id="rvmsgid" value="'+response.res[i].id+'">';

							list += '<div class="msgBox"><p id="getrplyshow"></p><div class="form-group"><textarea class="form-control" id="responsetext"></textarea></div><div class="form-group"><button class="btn btn-primary" onclick="resposeback()">Submit</button></div></div>';

							 } 

							list +='</div></div><br>'; 

					} }else{

						list += '<div class="blog-card"><div class="description">No reviews yet</div></div>';

						

					}

					$('.review_body').append(list);

				}

			});



		}



	</script>

		<script>

		function getordreview(revieword){

		$("#revieworder").val(revieword);

		 var revieword = $("#revieworder").val();

		 var businessid = $("#listingid").val();

		 <?php if(isprologin()){ ?>

			var ownerid = "<?php echo userid2();?>";

		<?php } ?>

		 var listt="";

    	$.ajax({

		type: "POST", 

		url:  '<?=site_url("welcome/get_moreReviewbyOrder")?>',  

		data: {revieword:revieword,businessid:businessid}, 

		dataType : 'json',

		beforeSend: function(){

		},

    

  	success: function(responseorder){	

  					if(responseorder.res.length > 0){ 

  						for(var i=0;i<responseorder.res.length;i++){ 

  					            

  							listt += '<div class="blog-card"><div class="description">';							

							listt += '<h1>'+responseorder.res[i].subject+'</h1>';

							for(var j=0;j<5;j++)

							{

							if(j<responseorder.res[i].rating)

							{

							listt += '<span class="fa fa-star checked"></span>';	

							}else{

							listt += '<span class="fa fa-star"></span>';	

							}

							}

							listt += '<br><h2>'+responseorder.res[i].username+'</h2>';

							listt += '<p>'+responseorder.res[i].comments+'</p>';

							if(responseorder.res[i].response_text.trim()!=''){

							listt +='<h4>Response from the owner<span class="smallfornt">'+responseorder.restime+'</span></h4>';

							listt += '<p>'+responseorder.res[i].response_text+'</p>';

							}

							if(responseorder.res[i].userid==ownerid){ 

							listt += '<a href="javascript:void(0);" role="button" onclick="replybutton()" class="btn btn-2 btn-warning">Reply</a><input type="hidden" id="rvmsgid" value="'+responseorder.res[i].id+'">';

							listt += '<div class="msgBox"><p id="getrplyshow"></p><div class="form-group"><textarea class="form-control"></textarea></div><div class="form-group"><button class="btn btn-primary" onclick="resposeback()">Submit</button></div></div>';

							 } 

							listt +='</div></div><br>'; 

						} 

					}else{

						listt += '<div class="blog-card"><div class="description">No reviews yet</div></div>';

					}

					$('.review_body').html(listt);

				}

			});



		}

function resposeback(){

	  var responsetext = document.getElementById('responsetext').value;

	  var reviewid= $("#rvmsgid").val();



           $.ajax({

             url: '<?=site_url("welcome/replytextfromOwner")?>',

             type: 'POST',

             dataType: 'html',

             data: {responsetext:responsetext,reviewid:reviewid},

           })

           .done(function(e){

             if(e==1){

              $('#getrplyshow').html('<p style="color:green">Replied Successfully.</p>');

              $('#responsetext').val('');

            }

            else{

             $('#getrplyshow').html('<p style="color:green">Error</p>');

           }

         });

         

}

	</script>

	<script>

//Reviews



let focusedElementBeforeModal;

var modal = document.getElementById('modal');

var modalOverlay = document.querySelector('.modal-overlay');



window.onload = () => {

	var addReview = document.getElementById('review-add-btn');

	addReview.id = 'review-add-btn';

	addReview.innerHTML = '<i class="fa fa-pencil"></i> Write a Review';

	addReview.setAttribute('aria-label', 'add review');

	addReview.title = 'Add Review';

	addReview.addEventListener('click', openModal);

 // addReview.click();

} 



var openModal = () => {

  // Save current focus

  focusedElementBeforeModal = document.activeElement;



  // Listen for and trap the keyboard

  modal.addEventListener('keydown', trapTabKey);



  // Listen for indicators to close the modal

  modalOverlay.addEventListener('click', closeModal);

  // Close btn

  var closeBtn = document.querySelector('.close-btn');

  closeBtn.addEventListener('click', closeModal);



  // submit form

  var form = document.getElementById('review-form');

  form.addEventListener('submit', submitAddReview, false);



  // Find all focusable children

  var focusableElementsString = 'a[href], area[href], input:not([disabled]), select:not([disabled]), textarea:not([disabled]), button:not([disabled]), iframe, object, embed, [tabindex="0"], [contenteditable]';

  var focusableElements = modal.querySelectorAll(focusableElementsString);

  // Convert NodeList to Array

  focusableElements = Array.prototype.slice.call(focusableElements);



  var firstTabStop = focusableElements[0];

  var lastTabStop = focusableElements[focusableElements.length - 1];



  // Show the modal and overlay

  modal.classList.add('show');

  modalOverlay.classList.add('show');



  // Focus first child

  // firstTabStop.focus();

  var reviewName = document.getElementById('reviewName');

  reviewName.focus();



  function trapTabKey(e) {

    // Check for TAB key press

    if (e.keyCode === 9) {



      // SHIFT + TAB

      if (e.shiftKey) {

      	if (document.activeElement === firstTabStop) {

      		e.preventDefault();

      		lastTabStop.focus();

      	}



      // TAB

  } else {

  	if (document.activeElement === lastTabStop) {

  		e.preventDefault();

  		firstTabStop.focus();

  	}

  }

}



    // ESCAPE

    if (e.keyCode === 27) {

    	closeModal();

    }

}

};



var submitAddReview = (e) => {

  // console.log(e);

  console.log('Form subbmitted!');

  e.preventDefault();

  closeModal();

};



var closeModal = () => {

  // Hide the modal and overlay

  modal.classList.remove('show');

  modalOverlay.classList.remove('show');



  var form = document.getElementById('review-form');

  form.reset();

  // Set focus back to element that had it before the modal was opened

  focusedElementBeforeModal.focus();

};



var setFocus = (evt) => {

	var rateRadios = document.getElementsByName('rate');

	var rateRadiosArr = Array.from(rateRadios);

	var anyChecked = rateRadiosArr.some(radio => { return radio.checked === true; });

  // console.log('anyChecked', anyChecked);

  if (!anyChecked) {

  	var star1 = document.getElementById('star1');

  	star1.focus();

    // star1.checked = true;

}

};



var navRadioGroup = (evt) => {

  // console.log('key', evt.key, 'code', evt.code, 'which', evt.which);

  // console.log(evt);

  

  var star1 = document.getElementById('star1');  

  var star2 = document.getElementById('star2');  

  var star3 = document.getElementById('star3');  

  var star4 = document.getElementById('star4');  

  var star5 = document.getElementById('star5');  



  if (['ArrowRight', 'ArrowLeft', 'ArrowDown', 'ArrowUp'].includes(evt.key)) {

  	evt.preventDefault();

    // console.log('attempting return');

    if (evt.key === 'ArrowRight' || evt.key === 'ArrowDown') {

    	switch(evt.target.id) {

    		case 'star1':

    		star2.focus();

    		star2.checked = true;

    		break;

    		case 'star2':

    		star3.focus();

    		star3.checked = true;

    		break;

    		case 'star3':

    		star4.focus();

    		star4.checked = true;

    		break;

    		case 'star4':

    		star5.focus();

    		star5.checked = true;

    		break;

    		case 'star5':

    		star1.focus();

    		star1.checked = true;

    		break;

    	}

    } else if (evt.key === 'ArrowLeft' || evt.key === 'ArrowUp') {

    	switch(evt.target.id) {

    		case 'star1':

    		star5.focus();

    		star5.checked = true;

    		break;

    		case 'star2':

    		star1.focus();

    		star1.checked = true;

    		break;

    		case 'star3':

    		star2.focus();

    		star2.checked = true;

    		break;

    		case 'star4':

    		star3.focus();

    		star3.checked = true;

    		break;

    		case 'star5':

    		star4.focus();

    		star4.checked = true;

    		break;

    	}

    }

}

};

</script>

 <script>

  function reviewsubmit()

  {

  	var rstar = $("input[type='radio'][name='rate']:checked").val();

  	var rname = $("input[name=reviewName]").val();

  	var ruserid = $("#rvuserid").val();

  	var rlistid = $("#listingid").val();

  	var rvsub = $("#reviewSubject").val();

  	var rcmnts= $("#reviewComments").val();

    $.ajax({

      url: '<?=site_url("welcome/getreviewsubmit")?>',

      type: 'POST',

      dataType: 'html',

      data: {rstar:rstar,rname:rname,ruserid:ruserid,rlistid:rlistid,rvsub:rvsub,rcmnts:rcmnts},

    })

    .done(function(e){

      if(e==0){

       $('#msgrev').html('<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><b>Some error has occured !!</b></div>');

     }

     else{

      $('#msgrev').html('<div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><b>Thank You For your review..</b></div>');

      $("#review-form")[0].reset();

    }

  });



  }

 

</script>

<script>

  function messagesubmit()

  {

  	var mname = $("#msgname").val();

  	var mlistid = $("#listmsgid").val();

  	var muserid = $("#rvuserid").val();

  	var memail = $("#msgEmail").val();

  	var mphone = $("#msgphone").val();

  	var mcmnts= $("#msgmessage").val();

    $.ajax({

      url: '<?=site_url("welcome/getmsgsubmit")?>',

      type: 'POST',

      dataType: 'html',

      data: {mname:mname,muserid:muserid,mlistid:mlistid,memail:memail,mphone:mphone,mcmnts:mcmnts},

    })

    .done(function(e){

      if(e==0){

       $('#messhow').html('<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><b>Some error has occured !!</b></div>');

     }

     else{

      $('#messhow').html('<div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><b>Thank You For your Message..We will get back to you..</b></div>');

      $("#messageForm")[0].reset();

    }

  });



  }

  function replybutton(){

  	$('.msgBox').slideToggle()

  }

 

</script>