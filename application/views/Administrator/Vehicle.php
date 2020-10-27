
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
							
    						<h2 class="text-center"><b>VEHICLE</b></h2>
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
									<th>Id Car <img src="<?php echo base_url('assets/css_wss/sort.png'); ?>" width="10"></th>
									<th>Number Sim <img src="<?php echo base_url('assets/css_wss/sort.png'); ?>" width="10"></th>
									<th>Number Police <img src="<?php echo base_url('assets/css_wss/sort.png'); ?>" width="10"></th>
									<th>Name <img src="<?php echo base_url('assets/css_wss/sort.png'); ?>" width="10"></th>
									<th>Document SIM & STNK <img src="<?php echo base_url('assets/css_wss/sort.png'); ?>" width="10"></th>
									<th>Id User <img src="<?php echo base_url('assets/css_wss/sort.png'); ?>" width="10"></th>
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
				"url": "<?php echo site_url('Administrator/ajax_list1')?>",
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

		document.getElementById('btnSave_').style.display = "block";
		document.getElementById('Dokumen_').style.display = "block";
		document.getElementById('Number_Sim').readOnly = false;
		document.getElementById('Number_Police').readOnly = false;
		document.getElementById('Name').readOnly = false;
		save_method = 'add';
		$('#form')[0].reset(); 
		$('.form-group').removeClass('has-error'); 
		$('.help-block').empty(); 
		$('#modal_form').modal('show'); 
		$('.modal-title').text('Add Transportir'); 
		$('#Document_SIM_STNK-preview').hide();
		$('#label-Document_SIM_STNK').text('Upload dokumen');
	}

	function edit_vehicle(id) {
		document.getElementById('btnSave_').style.display = "none";
		document.getElementById('Dokumen_').style.display = "none";
		document.getElementById('Number_Sim').readOnly = true;
		document.getElementById('Number_Police').readOnly = true;
		document.getElementById('Name').readOnly = true;
		save_method = 'update';
		$('#form')[0].reset();
		$('.form-group').removeClass('has-error');
		$('.help-block').empty();
		$.ajax({
			url: "<?php echo site_url('Administrator/ajax_edit1')?>/" + id,
			type: "GET",
			dataType: "JSON",
			success: function (data) {
				$('[name="Id_Car"]').val(data.Id_Car);
				$('[name="Number_Sim"]').val(data.Number_Sim);
				$('[name="Number_Police"]').val(data.Number_Police);
				$('[name="Name"]').val(data.Name);
				$('[name="Id_User"]').val(data.Id_User);
				$('#modal_form').modal('show'); 
				$('.modal-title').text('Edit Vehicle');
				$('#Document_SIM_STNK-preview').show();

				if (data.Document_SIM_STNK) {
					$('#label-Document_SIM_STNK').text('Change Document_SIM_STNK');
					$('#Document_SIM_STNK-preview div').html('<img src="' + base_url + 'upload_vehicle/' + data.Document_SIM_STNK +
						'" class="img-responsive">');
					$('#Document_SIM_STNK-preview div').append('<input type="checkbox" name="remove_Document_SIM_STNK" value="' + data
						.Document_SIM_STNK + '"/> Remove Document_SIM_STNK when saving');
				} else {
					$('#label-Document_SIM_STNK').text('Upload Document_SIM_STNK');
					$('#Document_SIM_STNK-preview div').text('(No Document_SIM_STNK)');
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
			url = "<?php echo site_url('Administrator/ajax_add1')?>";
		} else {
			url = "<?php echo site_url('Administrator/ajax_update1')?>";
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

	function delete_vehicle(id) {
		if (confirm('Are you sure delete this data?')) {
			// ajax delete data to database
			$.ajax({
				url: "<?php echo site_url('Administrator/ajax_delete1')?>/" + id,
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
function cek(){
		var cek_Number_Sim = document.getElementById("Number_Sim").value;
		var cek_Number_Police = document.getElementById("Number_Police").value;
		var cek_Name = document.getElementById("Name").value;
		if(save_method == 'add')
		{
			if(cek_Number_Sim != "" && cek_Number_Police != "" && cek_Name != "")
			{			
				save();		
			}
			else 
			{
	   		 	swal("LENGKAPI FIELD");
			}
		}		
		else
		{
			if(cek_Number_Sim != "" && cek_Number_Police != "" && cek_Name != "")
			{
			save();		
			}
			else 
			{
	   		 	swal("LENGKAPI FIELD");
			}
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
        	</div>

        	<div class="row">
 
        	<div class="col-md-6">

				<div class="form-group">
			      <label>Id Vehicle</label>
			      <input type="number" class="form-control" id="Id_Car" name="Id_Car" placeholder="Ditentukan Sistem" readonly>
			    </div>
				<div class="form-group">
					<label>Number Sim</label>
					<input type="number" class="form-control" id="Number_Sim" name="Number_Sim" placeholder="Masukan Number_Sim">
				</div>


  				<div class="input-group" id="Document_SIM_STNK-preview">
					<label>Document SIM & STNK</label>
					<div>
						(No dokumen SIM & STNK)
						<span class="help-block"></span>
					</div>
				</div>

				<div class="input-group" style="margin-top: 10px;" id="Dokumen_">
					<label id="label-Document_SIM_STNK">Upload Document SIM & STNK </label>
					<div>
						<input name="Document_SIM_STNK" type="file">
						<span class="help-block"></span>
					</div>
				</div>
        	</div>

        	<div class="col-md-6">
        		<div class="form-group">
					<label>Number Police</label>
					<input type="text" class="form-control" id="Number_Police" name="Number_Police" placeholder="Masukan Number_Police">
				</div>	
			    <div class="form-group">
					<label>Name</label>
					<input type="text" class="form-control" id="Name" name="Name" placeholder="Masukan Name">
				</div>

  			
        	</div>
        	</div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="reset()">Close</button>
        <div id="btnSave_">
        <button type="button" class="btn btn-primary" id="btnSave" onclick="cek()">Save changes</button>
  		</div>
      </div>
    </div>
  </div>
</div>
<!-- #modal ane -->
</section>
</div>
