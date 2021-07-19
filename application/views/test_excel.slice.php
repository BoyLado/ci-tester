@extends('template.layout')

@section('page_content')

<form id="form_application_customers" enctype="multipart/form-data">
	<input type="hidden" id="txt_csrf" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
	<label>File:</label>
	<input type="file" id="file_application_customers" name="file_application_customers" required>
	<button type="submit">Upload</button>
</form>

<input type="hidden" id="txt_base_url" value="<?php echo base_url(); ?>">

@endsection

@section('js_plugins')
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
@endsection

@section('custom_scripts')
<script type="text/javascript">
	$(document).ready(function(){
		$('#form_application_customers').on('submit',function(e){
			e.preventDefault();
			upload_file.upload_application_customers(this);
		});

		$('#file_application_customers').on('change',function(){
			upload_file.returnSheets(this);
		});
	});
	const upload_file = (function(){

		let thisUploadFile = {};

		let baseUrl = $('#txt_base_url').val();

		thisUploadFile.returnSheets = function(thisInput)
		{
			var fileName = thisInput.files[0].name;

			// alert(fileName);
			let formData = new FormData();
			formData.set('testexcel',thisInput.files[0],fileName);
			
			$.ajax({
				url : `${baseUrl}test-return-sheets`,
				method : 'POST',
				dataType: 'json',
				processData: false, // important
				contentType: false, // important
				data : formData,
				success : function(result)
				{
					console.log(result);
					//thisForm.reset(); //reset same form
				}
			});
		}

		thisUploadFile.upload_application_customers = function(thisForm)
		{
			$.ajax({
				url : `${baseUrl}test-upload-excel`,
				method : 'POST',
				dataType: 'json',
				processData: false, // important
				contentType: false, // important
				data : new FormData(thisForm),
				success : function(result)
				{
					console.log(result);
					thisForm.reset(); //reset same form
				}
			});
		}

		return thisUploadFile;

	})();
</script>
@endsection