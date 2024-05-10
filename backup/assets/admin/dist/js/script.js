var baseUrl = $('#baseUrl').val();

$(document).ready(function() {
	intel();
	validation();
	datepick();
	selectfun();
	summereditor();
	$('.datatable1').DataTable();
});

function datepick() {
	var d = new Date();
	$('.datepicker').datepicker({
		autoclose: true,
		todayBtn:  1,
		todayHighlight: true,
		format: 'dd-mm-yyyy',
		startDate: d.getFullYear()+'-'+d.getMonth()+'-'+d.getDate()
	});
}

function intel() {
	$('.input-phone').intlInputPhone({ preferred_country: ['in','gb'] });
}

function validation() {
	$.validate({
		modules : 'security, file, html5',
		onModulesLoaded : function() {
			var optionalConfig = {
				fontSize: '10pt',
				padding: '3px',
				bad : 'Very bad',
				weak : 'Weak',
				good : 'Good',
				strong : 'Strong',
				width : '100%'
			};
			$('input[type="password"].validate_password').displayPasswordStrength(optionalConfig);
		}
	});
}

function summereditor() {
	$(".summernote").summernote({
		height: 300,
		minHeight: null,
		maxHeight: null,
		focus: false,
		codemirror: {
			theme: 'default'
		}
	});
}

function selectfun() {
	$('.select2').select2();
}

function alert_func(data) {
	swal({title: data[0], type: data[1], confirmButtonColor: data[2]});
}

function confirm_yes(msg, ptype, okclose, btn, colors) {
	if (typeof btn === "undefined" || btn === null) { 
		btn = ['Yes','No']; 
	}
	if (typeof colors === "undefined" || colors === null) { 
		colors = ['#A5DC86','#DD6B55']; 
	}
	if (typeof okclose === "undefined" || okclose === null) { 
		okclose = false; 
	} else {
		okclose = true; 
	}
	swal({
		title: msg,
		type: ptype,
		showCancelButton: true,
		confirmButtonColor: colors[0],
		cancelButtonColor: colors[1],
		confirmButtonText: btn[0],
		cancelButtonText: btn[1],
		closeOnConfirm: okclose,
		closeOnCancel: true
	}, function(isConfirm){
		if (isConfirm) {
			return true;
		} else {
			return false
		}
	});
}

$('#add-more-image').on('click', function(event) {
	event.preventDefault();
	$('#image-group').append('<div class="fileinput fileinput-new" data-provides="fileinput"><div class="fileinput-new thumbnail" style="width: 200px; height: 150px;"><img src="'+baseUrl+'dist/images/noimage.jpg" alt=""></div><div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div><div><span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span><input type="file" name="images[]" accept="images/*" required=""></span><a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Remove</a><span class="btn btn-danger delete-image-input">&times;</span></div></div>');
});
$(document).on('click', '.delete-image-input', function(event) {
	$(this).closest('.fileinput').remove();
});

/*$(document).ready(function() {
	$("#product-images").fileinput({
		showCaption: false,
		dropZoneEnabled: true,
		allowedFileExtensions: ["jpg", "png", "gif"]
	});
});*/

/*$(document).ready(function() {
	App.init();
	tinymce.init({
		selector: '.myeditor',
		theme: 'modern',
		plugins: 'print preview fullpage powerpaste searchreplace autolink directionality advcode visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount tinymcespellchecker a11ychecker imagetools mediaembed  linkchecker contextmenu colorpicker textpattern help',
		toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat',
		image_advtab: true,
		style_formats: [
			{title: 'Bold text', inline: 'b'},
			{title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
			{title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
			{title: 'Example 1', inline: 'span', classes: 'example1'},
			{title: 'Example 2', inline: 'span', classes: 'example2'},
			{title: 'Table styles'},
			{title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
		]
	});
});*/
