
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
							
    						<h2 class="text-center"><b>MANAGE ACCOUNTS</b></h2>
    						<button class="btn" onclick="add()"><i class="glyphicon glyphicon-plus"></i>ADD</button>
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
									<th>Id User <img src="<?php echo base_url('assets/css_wss/sort.png'); ?>" width="10"></th>
									<th>Username <img src="<?php echo base_url('assets/css_wss/sort.png'); ?>" width="10"></th>
									<th>Password <img src="<?php echo base_url('assets/css_wss/sort.png'); ?>" width="10"></th>
									<th>Account Status <img src="<?php echo base_url('assets/css_wss/sort.png'); ?>" width="10"></th>
									<th>Level <img src="<?php echo base_url('assets/css_wss/sort.png'); ?>" width="10"></th>
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
				"url": "<?php echo site_url('Administrator/ajax_list_Manage_Accounts')?>",
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
		save_method = 'add';
		$('#form')[0].reset(); 
		$('.form-group').removeClass('has-error'); 
		$('.help-block').empty(); 
		$('#modal_form').modal('show'); 
		$('.modal-title').text('Add Accounts'); 
	}
	function edit_manage_accounts(id) {
		save_method = 'update';
		$('#form')[0].reset();
		$('.form-group').removeClass('has-error');
		$('.help-block').empty();
		$.ajax({
			url: "<?php echo site_url('Administrator/ajax_edit_Manage_Accounts')?>/" + id,
			type: "GET",
			dataType: "JSON",
			success: function (data) {
				$('[name="Id_User"]').val(data.Id_User);
				$('[name="Username"]').val(data.Username);
				$('[name="Password"]').val(data.Password);
				$('[name="Account_Status"]').val(data.Account_Status);
				$('[name="Level"]').val(data.Level);
				$('#modal_form').modal('show'); 
				$('.modal-title').text('View Legality');
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
			url = "<?php echo site_url('Administrator/ajax_add_Manage_Accounts')?>";
		} else {
			url = "<?php echo site_url('Administrator/ajax_update_Manage_Accounts')?>";
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

	function delete_Manage_Accounts(id) {
		if (confirm('Are you sure delete this data?')) {
			// ajax delete data to database
			$.ajax({
				url: "<?php echo site_url('Administrator/ajax_delete_Manage_Accounts')?>/" + id,
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
		var cek_Username = document.getElementById("Username").value;
		var cek_Password = document.getElementById("Password").value;
		var cek_Account_Status = document.getElementById("Account_Status").value;
		var cek_Level = document.getElementById("Level").value;
		if(save_method == 'add')
		{
			if(cek_Username != "" && cek_Password != "" && cek_Account_Status != "" && cek_Level != "")
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
			if(cek_Username != "" && cek_Password != "" && cek_Account_Status != "" && cek_Level != "")
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


<form method="post" accept-charset="utf-8" action="<?php echo base_url()?>Administrator/Cetak_Manage_Accounts">
    <div class="form-group">

        <div  style="width: 170px;  float: left; ">
            <button type="submit" style="width: 160px; margin: 5px;" id="btncetak" class="btn btn-primary">Report Accounts</button>
        </div><br><br><br>
    </div>
</form>   





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
 
        	<div class="col-md-12">

				<div class="form-group">
			      <label>Id User</label>
			      <input type="number" class="form-control" id="Id_User" name="Id_User" placeholder="Ditentukan Sistem" readonly>
			    </div>
				<div class="form-group">
					<label>Username</label>
					<input type="text" class="form-control" id="Username" name="Username" placeholder="Masukan Username" autocomplete="off">
				</div>

			    <div class="form-group">
					<label>Password</label>
					<input type="text" class="form-control" id="Password" name="Password" placeholder="Masukan Password" autocomplete="off">
				</div>	
			    <div class="form-group">
					<label>Account Status</label>
					<select id="Account_Status" name="Account_Status" class="form-control" >
						<option value="">Pilih Salah Satu Divre</option>
						<option value="Divre_I_Medan">Divre_I_Medan</option>
						<option value="Divre_II_Padang">Divre_II_Padang</option>
						<option value="Divre_III_Dumai">Divre_III_Dumai</option>
						<option value="Divre_IV_Palembang">Divre_IV_Palembang</option>
						<option value="Divre_V_Pangkal_Pinang">Divre_V_Pangkal_Pinang</option>
						<option value="Divre_VI_Lampung">Divre_VI_Lampung</option>
						<option value="Divre_VII_DKI_Jakarta">Divre_VII_DKI_Jakarta</option>
						<option value="Divre_VIII_Bandung">Divre_VIII_Bandung</option>
						<option value="Divre_IX_Semarang">Divre_IX_Semarang</option>
						<option value="Divre_X_Surabaya">Divre_X_Surabaya</option>
						<option value="Divre_XI_Pontianak">Divre_XI_Pontianak</option>
						<option value="Divre_XII_Banjarmasin">Divre_XII_Banjarmasin</option>
						<option value="Divre_XIII_Balikpapan">Divre_XIII_Balikpapan</option>
						<option value="Divre_XIV_Denpasar">Divre_XIV_Denpasar</option>
						<option value="Divre_XV_Mataram">Divre_XV_Mataram</option>
						<option value="Divre_XVI_Kupang">Divre_XVI_Kupang</option>
						<option value="Divre_XVII_Makassar">Divre_XVII_Makassar</option>
						<option value="Divre_XVIII_Palu">Divre_XVIII_Palu</option>
						<option value="Divre_XIX_Bitung">Divre_XIX_Bitung</option>
						<option value="Divre_XX_Sorong">Divre_XX_Sorong</option>
					</select>
				</div>
        		<div class="form-group">
					<label>Level</label>
					<select id="Level" name="Level" class="form-control" >
						<option value="">Pilih Salah Satu Jenis User</option>
						<option value="User">User</option>
						<option value="Superuser">Superuser</option>
					</select>
				</div>	

        	</div>
        	</div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="reset()">Close</button>
        <button type="button" class="btn btn-primary" id="btnSave" onclick="cek()">Save changes</button>	
      </div>
    </div>
  </div>
</div>
<!-- #modal ane -->
</section>
</div>
