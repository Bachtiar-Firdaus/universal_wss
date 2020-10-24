
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
							
    						<h2 class="text-center"><b>Transportir</b></h2>

    						<button class="btn" onclick="add_legality()"><i class="glyphicon glyphicon-plus"></i>Tambah</button>
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
									<th>Id Legality <img src="<?php echo base_url('assets/css_wss/sort.png'); ?>" width="10"></th>
									<th>Number <img src="<?php echo base_url('assets/css_wss/sort.png'); ?>" width="10"></th>
									<th>Transportir <img src="<?php echo base_url('assets/css_wss/sort.png'); ?>" width="10"></th>
									<th>Customer <img src="<?php echo base_url('assets/css_wss/sort.png'); ?>" width="10"></th>
									<th>Party <img src="<?php echo base_url('assets/css_wss/sort.png'); ?>" width="10"></th>
									<th>Balance <img src="<?php echo base_url('assets/css_wss/sort.png'); ?>" width="10"></th>
									<th>Commodity <img src="<?php echo base_url('assets/css_wss/sort.png'); ?>" width="10"></th>
									<th>Purpose_of_Unloading <img src="<?php echo base_url('assets/css_wss/sort.png'); ?>" width="10"></th>
									<th>Date <img src="<?php echo base_url('assets/css_wss/sort.png'); ?>" width="10"></th>
									<th>Id User <img src="<?php echo base_url('assets/css_wss/sort.png'); ?>" width="10"></th>
									<th>Document Legality <img src="<?php echo base_url('assets/css_wss/sort.png'); ?>" width="10"></th>
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
<!-- <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js')?>"></script> -->
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
				"url": "<?php echo site_url('User/ajax_list')?>",
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
	function add_legality() {
		save_method = 'add';
		$('#form')[0].reset(); 
		$('.form-group').removeClass('has-error'); 
		$('.help-block').empty(); 
		$('#modal_form').modal('show'); 
		$('.modal-title').text('Add Transportir'); 
		$('#dokumen-preview').hide();
		$('#label-dokumen').text('Upload dokumen');
	}

	function edit_legality(id) {
		save_method = 'update';
		$('#form')[0].reset();
		$('.form-group').removeClass('has-error');
		$('.help-block').empty();
		$.ajax({
			url: "<?php echo site_url('User/ajax_edit')?>/" + id,
			type: "GET",
			dataType: "JSON",
			success: function (data) {
				$('[name="Id_Legality"]').val(data.Id_Legality);
				$('[name="Number"]').val(data.Number);
				$('[name="Transportir"]').val(data.Transportir);
				$('[name="Customer"]').val(data.Customer);
				$('[name="Party"]').val(data.Party);
				$('[name="Balance"]').val(data.Balance);
				$('[name="Commodity"]').val(data.Commodity);
				$('[name="Purpose_of_Unloading"]').val(data.Purpose_of_Unloading);
				$('[name="Date"]').val(data.Date);
				$('[name="Id_User"]').val(data.Id_User);
				$('#modal_form').modal('show'); 
				$('.modal-title').text('Edit Legality');
				$('#Document_Legality-preview').show();
				if (data.Document_Legality) {
					$('#label-Document_Legality').text('Change Document_Legality');
					$('#Document_Legality-preview div').html('<img src="' + base_url + 'upload_legality/' + data.Document_Legality +
						'" class="img-responsive">');
					$('#Document_Legality-preview div').append('<input type="checkbox" name="remove_dokumen" value="' + data
						.Document_Legality + '"/> Remove Document_Legality when saving');
				} else {
					$('#label-Document_Legality').text('Upload Document_Legality');
					$('#Document_Legality-preview div').text('(No Document_Legality)');
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
			url = "<?php echo site_url('User/ajax_add')?>";
		} else {
			url = "<?php echo site_url('User/ajax_update')?>";
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

	function delete_legality(id) {
		if (confirm('Are you sure delete this data?')) {
			// ajax delete data to database
			$.ajax({
				url: "<?php echo site_url('User/ajax_delete')?>/" + id,
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
        		<input type="hidden" value="" name="Id_Legality"/>
        	</div>

        	<div class="row">
 
        	<div class="col-md-6">

				<div class="form-group">
			      <label>Id Legality</label>
			      <input type="number" class="form-control" id="Id_Legality" name="Id_Legality" placeholder="Ditentukan Sistem" readonly>
			    </div>
				<div class="form-group">
					<label>Party</label>
					<input type="number" class="form-control" name="Party" placeholder="Masukan Party">
				</div>

			    <div class="form-group">
					<label>Transportir</label>
					<input type="text" class="form-control" id="Transportir" name="Transportir" placeholder="Masukan Transportir">
				</div>	
			    <div class="form-group">
					<label>Customer</label>
					<input type="Customer" class="form-control" id="Customer" name="Customer" placeholder="Masukan Customer">
				</div>

				<div class="form-group">
					<label>Date</label>
					<input type="Date" class="form-control" id="Date" name="Date" placeholder="Masukan Date">
				</div>
  				<div class="input-group" id="Document_Legality-preview">
					<label>Dokumen</label>
					<div>
						(No dokumen)
						<span class="help-block"></span>
					</div>
				</div>

				<div class="input-group" style="margin-top: 10px;">
					<label id="label-Document_Legality">Upload Dokumen </label>
					<div>
						<input id="up" name="Document_Legality" type="file">
						<span class="help-block"></span>
					</div>
				</div>
        	</div>

        	<div class="col-md-6">
        	<div class="form-group">
					<label>Number</label>
					<input type="number" class="form-control" id="Number" name="Number" placeholder="Masukan Number">
				</div>	

				<div class="form-group">
	    			<label>Balance</label>
	    			<input type="text" class="form-control" name="Balance" placeholder="Masukan Balance">
				</div>
				<div class="form-group">
	    			<label>Commodity</label>
	    			<input type="text" class="form-control" name="Commodity" placeholder="Masukan Commodity">
				</div>

				<div class="form-group" >
					<label>Purpose of Unloading</label>
					<input type="text" class="form-control" id="Purpose_of_Unloading" name="Purpose_of_Unloading" placeholder="Masukan Purpose of Unloading">
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
