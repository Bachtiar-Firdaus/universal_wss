
<!--  content -->
<div class="content-wrapper">
	<div class="row">
		<div class="col-xs-12" style="width: 100%;">
			<div class="box">
				<div class="box-header">
				</div>
				<!-- /.box-header -->
				<div class="box-body">

					<section class="container-fluid" style="overflow-y: auto; overflow-x: scroll;">
						<div class="dropdown">
							
    						<h2 class="text-center"><b>ACTIVITIES</b></h2>

    						<button class="btn" onclick="add()"><i class="glyphicon glyphicon-plus"></i>Tambah</button>
							<button class="btn btn-custome1" id="btnn2" onclick="reload_table()"><i
									class="glyphicon glyphicon-refresh"></i> REFRESH</button>
						</div> <br />

						<table id="table" class="table  table-hover display nowrap" cellspacing="0"
							width="100%" style="border-radius: 5px 5px 0 0 ;
					        overflow: hidden;
					        box-shadow: 0 0 20px rgba(0,0,0,0.15); ">

							<thead style="color: white;">
								<tr>
									<th>No <img src="<?php echo base_url('assets/css_wss/sort.png'); ?>" width="10"></th>
									<th>Id Activities <img src="<?php echo base_url('assets/css_wss/sort.png'); ?>" width="10"></th>
									<th>Number BP <img src="<?php echo base_url('assets/css_wss/sort.png'); ?>" width="10"></th>
									<th>Tonase <img src="<?php echo base_url('assets/css_wss/sort.png'); ?>" width="10"></th>
									<th>Time In <img src="<?php echo base_url('assets/css_wss/sort.png'); ?>" width="10"></th>
									<th>Time Out <img src="<?php echo base_url('assets/css_wss/sort.png'); ?>" width="10"></th>
									<th>Document Delivery Order <img src="<?php echo base_url('assets/css_wss/sort.png'); ?>" width="10"></th>
									<th>Document Out <img src="<?php echo base_url('assets/css_wss/sort.png'); ?>" width="10"></th>
									<th>Id User <img src="<?php echo base_url('assets/css_wss/sort.png'); ?>" width="10"></th>
									<th>Id Legality <img src="<?php echo base_url('assets/css_wss/sort.png'); ?>" width="10"></th>
									<th>Id Vehicle <img src="<?php echo base_url('assets/css_wss/sort.png'); ?>" width="10"></th>
									<th style="width:125px;">Action</th>
								</tr>
							</thead>

							<tbody style="text-align: center;">
							</tbody>

							<tfoot>
								<tr>
									<th></th>
									<th></th>
									<th></th>
									<th></th>
									<th></th>
									<th></th>
									<th></th>
									<th></th>
									<th></th>
									<th></th>
									<th></th>
									<th></th>
								</tr>
							</tfoot>

						</table><br><br>

					</section>
				</div>
				<!-- /.box-body -->
			</div>
		</div>
		<!-- /.col -->
	</div>
</div>
<!-- akhir content -->

<script src="<?php echo base_url('assets/jquery/jquery-2.1.4.min.js')?>"></script>
<script src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js')?>"></script>
<script src="<?php echo base_url('assets/datatables/js/dataTables.bootstrap.min.js')?>"></script>
<script src="<?php echo base_url('assets/bootstrap-datepicker/js/bootstrap-datepicker.min.js')?>"></script>


<script type="text/javascript">
	var save_method; 
	var table;
	var base_url = '<?php echo base_url();?>';
	$(document).ready(function () {
		table = $('#table').DataTable({
			"processing": true, 
			"serverSide": true,
			"order": [], 
			"ajax": {
				"url": "<?php echo site_url('User/ajax_list2')?>",
				"type": "POST"
			},
			"columnDefs": [{
					"targets": [-1],
					"orderable": false, 
				},
				{
					"targets": [-2],
					"orderable": false, 
				},
			],

		});
		$('.datepicker').datepicker({
			autoclose: true,
			format: "yyyy-mm-dd",
			todayHighlight: true,
			orientation: "top auto",
			todayBtn: true,
			todayHighlight: true,
		});
		$("input").change(function () {
			$(this).parent().parent().removeClass('has-error');
			$(this).next().empty();
		});
		$("textarea").change(function () {
			$(this).parent().parent().removeClass('has-error');
			$(this).next().empty();
		});
		$("select").change(function () {
			$(this).parent().parent().removeClass('has-error');
			$(this).next().empty();
		});

	});
	function add() {
		document.getElementById('bag1').style.display = "block";
		document.getElementById('bag2').style.display = "block";
		document.getElementById('bag3').style.display = "none";
		save_method = 'add';
		$('#form')[0].reset(); 
		$('.form-group').removeClass('has-error'); 
		$('.help-block').empty(); 
		$('#modal_form').modal('show'); 
		$('.modal-title').text('Add Transportir'); 
		$('#Document_Delivery_Order-preview').hide();
		$('#label-Document_Delivery_Order').text('Upload dokumen');
	}

	function edit_activities(id) {
		document.getElementById('bag1').style.display = "block";
		document.getElementById('bag2').style.display = "block";
		document.getElementById('bag3').style.display = "none";
		save_method = 'update';
		$('#form')[0].reset();
		$('.form-group').removeClass('has-error');
		$('.help-block').empty();
		$.ajax({
			url: "<?php echo site_url('User/ajax_edit2')?>/" + id,
			type: "GET",
			dataType: "JSON",
			success: function (data) {
				$('[name="Id_Activities"]').val(data.Id_Activities);
				$('[name="Number_BP"]').val(data.Number_BP);
				$('[name="Tonase"]').val(data.Tonase);
				$('[name="Time_In"]').val(data.Time_In);
				$('[name="Time_Out"]').val(data.Time_Out);
				$('[name="Id_User"]').val(data.Id_User);
				$('[name="Id_Legality"]').val(data.Id_Legality);
				$('[name="Id_Car"]').val(data.Id_Car);

				$('#modal_form').modal('show'); 
				$('.modal-title').text('Edit ACTIVITIES');
				$('#Document_Delivery_Order-preview').show();
				if (data.Document_Delivery_Order) {
					$('#label-Document_Delivery_Order').text('Change Document_Delivery_Order');
					$('#Document_Delivery_Order-preview div').html('<img src="' + base_url + 'upload_activities/' + data.Document_Delivery_Order +
						'" class="img-responsive">');
					$('#Document_Delivery_Order-preview div').append('<input type="checkbox" name="remove_Document_Delivery_Order" value="' + data
						.Document_Delivery_Order + '"/> Remove Document_Delivery_Order when saving');
				} else {
					$('#label-Document_Delivery_Order').text('Upload Document_Delivery_Order');
					$('#Document_Delivery_Order-preview div').text('(No Document_Delivery_Order)');
				}
			},
			error: function (jqXHR, textStatus, errorThrown) {
				alert('Error get data from ajax');
			}
		});
	}

	function edit_konfirmasi_activities(id) {
		document.getElementById('bag1').style.display = "none";
		document.getElementById('bag2').style.display = "none";
		document.getElementById('bag3').style.display = "block";
		save_method = 'update_konfirmasi';
		$('#form')[0].reset();
		$('.form-group').removeClass('has-error');
		$('.help-block').empty();
		$.ajax({
			url: "<?php echo site_url('User/ajax_edit2')?>/" + id,
			type: "GET",
			dataType: "JSON",
			success: function (data) {
				$('[name="Id_Activities"]').val(data.Id_Activities);

				$('#modal_form').modal('show'); 
				$('.modal-title').text('Edit ACTIVITIES');
				$('#Document_Out-preview').show();
				if (data.Document_Out) {
					$('#label-Document_Out').text('Change Document_Out');
					$('#Document_Out-preview div').html('<img src="' + base_url + 'upload_activities/' + data.Document_Out +
						'" class="img-responsive">');
					$('#Document_Out-preview div').append('<input type="checkbox" name="remove_Document_Out" value="' + data
						.Document_Out + '"/> Remove Document_Out when saving');
				} else {
					$('#label-Document_Out').text('Upload Document_Out');
					$('#Document_Out-preview div').text('(No Document_Out)');
				}
			},
			error: function (jqXHR, textStatus, errorThrown) {
				alert('Error get data from ajax');
			}
		});
	}


	function reload_table() {
		table.ajax.reload(null, false); //reload datatable ajax 
	}

	function save() {
		$('#btnSave').text('saving...'); //change button text
		$('#btnSave').attr('disabled', true); //set button disable 
		var url;

		if (save_method == 'add') {
			url = "<?php echo site_url('User/ajax_add2')?>";
		}		
		if (save_method == 'update_konfirmasi') {
			url = "<?php echo site_url('User/ajax_update_konfirmasi2')?>";
		} else {
			url = "<?php echo site_url('User/ajax_update2')?>";
		}
		var formData = new FormData($('#form')[0]);
		$.ajax({
			url: url,
			type: "POST",
			data: formData,
			contentType: false,
			processData: false,
			dataType: "JSON",
			success: function (data) {

				if (data.status) //if success close modal and reload ajax table
				{
					$('#modal_form').modal('hide');
					reload_table();
				} else {
					for (var i = 0; i < data.inputerror.length; i++) {
						$('[name="' + data.inputerror[i] + '"]').parent().parent().addClass(
						'has-error'); //select parent twice to select div form-group class and add has-error class
						$('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[
						i]); //select span help-block class set text error string
					}
				}
				$('#btnSave').text('save'); //change button text
				$('#btnSave').attr('disabled', false); //set button enable 


			},
			error: function (jqXHR, textStatus, errorThrown) {
				alert('Error adding / update data');
				$('#btnSave').text('save'); //change button text
				$('#btnSave').attr('disabled', false); //set button enable 

			}
		});
	}

	function delete_activities(id) {
		if (confirm('Are you sure delete this data?')) {
			// ajax delete data to database
			$.ajax({
				url: "<?php echo site_url('User/ajax_delete2')?>/" + id,
				type: "POST",
				dataType: "JSON",
				success: function (data) {
					//if success reload ajax table
					$('#modal_form').modal('hide');
					reload_table();
				},
				error: function (jqXHR, textStatus, errorThrown) {
					alert('Error deleting data');
				}
			});

		}
	}

</script>

<!-- modal ane -->
<div class="modal" id="modal_form" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h class="modal-title"></h><!-- c -->
      </div>
      <div class="modal-body form">
        <form action="#" id="form">
        	<div class="form-group">
        		<input type="hidden" value="" name="Id_Activities"/>
        	</div>

        	<div class="row">
 
        	<div class="col-md-6" id="bag1">

				<div class="form-group">
			      <label>Id Activities</label>
			      <input type="number" class="form-control" id="Id_Activities" name="Id_Activities" placeholder="Ditentukan Sistem" readonly>
			    </div>
				<div class="form-group">
	    			<label>Id Vehicle</label>
	    			<input type="text" class="form-control" name="Id_Car" placeholder="Masukan Id_Car">
				</div>
			    <div class="form-group">
					<label>Tonase</label>
					<input type="text" class="form-control" id="Tonase" name="Tonase" placeholder="Masukan Tonase">
				</div>	

  				<div class="input-group" id="Document_Delivery_Order-preview">
					<label>Dokumen Delivery Order</label>
					<div>
						(No dokumen)
						<span class="help-block"></span>
					</div>
				</div>

				<div class="input-group" style="margin-top: 10px;">
					<label id="label-Document_Delivery_Order">Upload Dokumen Delivery Order </label>
					<div>
						<input name="Document_Delivery_Order" type="file">
						<span class="help-block"></span>
					</div>
				</div>


        	</div>

        	<div class="col-md-6" id="bag2">
				<div class="form-group">
	    			<label>Id Legality</label>
	    			<input type="text" class="form-control" name="Id_Legality" placeholder="Masukan Id_Legality">
				</div>
				<div class="form-group">
					<label>Number BP</label>
					<input type="text" class="form-control" name="Number_BP" placeholder="Masukan Number_BP">
				</div>
  			
        	</div>
        	<div class="col-md-12" id="bag3">
        		<div class="input-group" id="Document_Out-preview">
					<label>Dokumen Out</label>
					<div>
						(No dokumen)
						<span class="help-block"></span>
					</div>
				</div>

				<div class="input-group" style="margin-top: 10px;">
					<label id="label-Document_Out">Upload Dokumen </label>
					<div>
						<input name="Document_Out" type="file">
						<span class="help-block"></span>
					</div>
				</div>
        	</div>
        	</div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="reset()">Close</button>
        <button type="button" class="btn btn-primary" id="btnSave" onclick="save()">Save changes</button>
      </div>
    </div>
  </div>
</div>
<!-- #modal ane -->
</section>
</div>
