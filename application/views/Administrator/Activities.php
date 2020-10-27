
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
				"url": "<?php echo site_url('Administrator/ajax_list2')?>",
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

	function view_activities(id) {		
		document.getElementById('Id_Legality').readOnly = true;
		document.getElementById('Id_Car').readOnly = true;
		document.getElementById('Tonase').readOnly = true;
		document.getElementById('bag1').style.display = "block";
		document.getElementById('bag2').style.display = "block";
		document.getElementById('bag3').style.display = "block";
		document.getElementById('bag4').style.display = "none";
		save_method = 'update';
		$('#form')[0].reset();
		$('.form-group').removeClass('has-error');
		$('.help-block').empty();
		$.ajax({
			url: "<?php echo site_url('Administrator/ajax_edit2')?>/" + id,
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
				$('.modal-title').text('View Activities');
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
		document.getElementById('Id_Legality').readOnly = false;
		document.getElementById('Id_Car').readOnly = false;
		document.getElementById('Tonase').readOnly = false;
		document.getElementById('bag1').style.display = "none";
		document.getElementById('bag2').style.display = "none";
		document.getElementById('bag3').style.display = "none";
		document.getElementById('bag4').style.display = "block";
		save_method = 'update_konfirmasi';
		$('#form')[0].reset();
		$('.form-group').removeClass('has-error');
		$('.help-block').empty();
		$.ajax({
			url: "<?php echo site_url('Administrator/ajax_edit2')?>/" + id,
			type: "GET",
			dataType: "JSON",
			success: function (data) {
				$('[name="Id_Activities"]').val(data.Id_Activities);

				$('#modal_form').modal('show'); 
				$('.modal-title').text('View Konfirmasi');
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


	function Cetak_Viat(id) {
		if (confirm('Are you sure print this data?')) {
			window.open("<?php echo site_url('Administrator/Cetak_Viat')?>/" + id);
		}
	}


</script>


<form method="post" accept-charset="utf-8" action="<?php echo base_url()?>User/Cetak_Activities">
    <div class="form-group">
        <div  style="width: 180px; float: left;">
            <input required name="First_Date" placeholder="First_Date" value="masukan First_Date" type="date" style="  float: left; width: 167px; margin: 5px; border-radius: 5px; height: 35px;px;">
        </div>
        <div  style="width: 180px; float: left;">
            <input required name="Last_Date" placeholder="Last_Date" value="masukan Last_Date" type="date" style="  float: left; width: 167px; margin: 5px; border-radius: 5px; height: 35px;px;">
        </div>


        <div  style="width: 170px;  float: left; ">
            <button type="submit" style="width: 160px; margin: 5px;" id="btncetak" class="btn btn-primary">Report Activities</button>
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
 
        	<div class="col-md-6" id="bag1">

				<div class="form-group">
			      <label>Id Activities</label>
			      <input type="number" class="form-control" id="Id_Activities" name="Id_Activities" placeholder="Ditentukan Sistem" readonly>
			    </div>

				<div class="form-group">
	    			<label>Id Vehicle</label>
	    			<input list="data2" class="form-control" id="Id_Car" name="Id_Car" placeholder="Masukan Id_Car" onchange="return autofill2();" autocomplete="off">
				</div>

        	</div>

        	<div class="col-md-6" id="bag2">

				<div class="form-group">
	    			<label>Id Legality</label>
	    			<input list="data1" class="form-control" id="Id_Legality" name="Id_Legality" placeholder="Masukan Id_Legality" onchange="return autofill1();" autocomplete="off">
				</div>


        	</div>

        	<div class="col-md-12" id="bag3">
        		<div class="form-group">
					<label>Tonase</label>
					<input type="text" class="form-control" id="Tonase" name="Tonase" placeholder="Masukan Tonase" autocomplete="off">
				</div>	

        		<div class="form-group">
					<label>Number BP</label>
					<input type="text" class="form-control" id="Number_BP" name="Number_BP" placeholder="Masukan Number_BP" autocomplete="off">
				</div>

  				<div class="input-group" id="Document_Delivery_Order-preview">
					<label>Dokumen Delivery Order</label>
					<div>
						(No dokumen)
						<span class="help-block"></span>
					</div>
				</div>

			</div>
        	<div class="col-md-12" id="bag4">
        		<div class="input-group" id="Document_Out-preview">
					<label>Dokumen Out</label>
					<div>
						(No dokumen)
						<span class="help-block"></span>
					</div>
				</div>

        	</div>
        	</div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="reset()">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- #modal ane -->
</section>
</div>
