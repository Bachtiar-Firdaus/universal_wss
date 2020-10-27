
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
		document.getElementById('Tonase').readOnly = false;
		document.getElementById('Id_Legality').readOnly = false;
		document.getElementById('Id_Car').readOnly = false;
		document.getElementById('btnSave_').style.display = "block";
		document.getElementById('btnSave_1').style.display = "none";
		document.getElementById('bag1').style.display = "block";
		document.getElementById('bag2').style.display = "block";
		document.getElementById('bag3').style.display = "block";
		document.getElementById('ses1').style.display = "block";
		document.getElementById('ses2').style.display = "block";
		document.getElementById('bag4').style.display = "none";
		save_method = 'add';
		$('#form')[0].reset(); 
		$('.form-group').removeClass('has-error'); 
		$('.help-block').empty(); 
		$('#modal_form').modal('show'); 
		$('.modal-title').text('Add Activities'); 
		$('#Document_Delivery_Order-preview').hide();
		$('#label-Document_Delivery_Order').text('Upload dokumen');
	}

	function edit_activities(id) {		
		document.getElementById('Id_Legality').readOnly = true;
		document.getElementById('Id_Car').readOnly = true;
		document.getElementById('Tonase').readOnly = true;
		document.getElementById('btnSave_').style.display = "block";
		document.getElementById('btnSave_1').style.display = "none";
		document.getElementById('bag1').style.display = "block";
		document.getElementById('bag2').style.display = "block";
		document.getElementById('bag3').style.display = "block";
		document.getElementById('ses1').style.display = "none";
		document.getElementById('ses2').style.display = "none";
		document.getElementById('bag4').style.display = "none";
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
		document.getElementById('Id_Legality').readOnly = false;
		document.getElementById('Id_Car').readOnly = false;
		document.getElementById('Tonase').readOnly = false;
		document.getElementById('btnSave_').style.display = "none";
		document.getElementById('btnSave_1').style.display = "block";
		document.getElementById('bag1').style.display = "none";
		document.getElementById('bag2').style.display = "none";
		document.getElementById('bag3').style.display = "none";
		document.getElementById('bag4').style.display = "block";
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
				$('.modal-title').text('Konfirmasi');
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
		else if (save_method == 'update_konfirmasi') {
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

	function Cetak_Viat(id) {
		if (confirm('Are you sure print this data?')) {
			window.open("<?php echo site_url('User/Cetak_Viat')?>/" + id);
		}
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

    function autofill1(){
        var Id_Legality = document.getElementById('Id_Legality').value;
        $.ajax({
                       url:"<?php echo base_url();?>User/AC_Legality",
                       data:'&Id_Legality='+Id_Legality,
                       success:function(data){
                           var hasil1 = JSON.parse(data);  
          
      $.each(hasil1, function(key,val){ 
                           document.getElementById('Id_Legality').value=val.Id_Legality;
                           document.getElementById('Number').value=val.Number;
                           document.getElementById('Transportir').value=val.Transportir;  
                           document.getElementById('Customer').value=val.Customer;
                           document.getElementById('Party').value=val.Party;
                           document.getElementById('Balance').value=val.Balance;
                           document.getElementById('Commodity').value=val.Commodity; 
                           document.getElementById('Purpose_of_Unloading').value=val.Purpose_of_Unloading; 
                           document.getElementById('Date_Legality').value=val.Date_Legality; 
                               	
        });
      }
                   });
                  
    }

    function autofill2(){
        var Id_Car =document.getElementById('Id_Car').value;
        $.ajax({
                       url:"<?php echo base_url();?>User/AC_Vehicle",
                       data:'&Id_Car='+Id_Car,
                       success:function(data){
                           var hasil2 = JSON.parse(data);  
          
      $.each(hasil2, function(key,val){ 
                           document.getElementById('Id_Car').value=val.Id_Car;
                           document.getElementById('Number_Sim').value=val.Number_Sim;
                           document.getElementById('Number_Police').value=val.Number_Police;  
                           document.getElementById('Name').value=val.Name;             	
        });
      }
                   });
                  
    }

function cek(){
		var cek_Tonase = document.getElementById("Tonase").value;
		var cek_Balance = document.getElementById("Balance").value;
		var cek_Id_Car = document.getElementById("Id_Car").value;
		var cek_Id_Legality = document.getElementById("Id_Legality").value;
		if(save_method == 'add')
		{
			if(cek_Tonase != "" && cek_Id_Car != "" && cek_Id_Legality != "")
			{			
				if(parseInt(cek_Tonase) <= parseInt(cek_Balance))
				{
				save();		
				}
				else 
				{
		   		 	swal("TONASE MELEBIHI PARTY YANG DITENTUKAN");
				}	
			}
			else 
			{
	   		 	swal("LENGKAPI FIELD");
			}
		}		
		else
		{
			if(cek_Tonase != "" && cek_Id_Car != "" && cek_Id_Legality != "")
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
				<div id="ses1">
				<div class="form-group">
					<label>Number Sim</label>
					<input type="number" class="form-control" id="Number_Sim" name="Number_Sim" placeholder="Masukan Number_Sim" readonly>
				</div>
        		<div class="form-group">
					<label>Number Police</label>
					<input type="text" class="form-control" id="Number_Police" name="Number_Police" placeholder="Masukan Number_Police" readonly>
				</div>	
			    <div class="form-group">
					<label>Name</label>
					<input type="text" class="form-control" id="Name" name="Name" placeholder="Masukan Name" readonly>
				</div>
				</div>

  			<datalist id="data2">
			    <?php
			    foreach ($record2->result() as $c)
			    {
			        echo "<option value='$c->Id_Car'>Number Sim $c->Number_Sim & Number Police $c->Number_Police</option>";
			    }
			    					    					    
			    ?>
			</datalist> 

        	</div>

        	<div class="col-md-6" id="bag2">

				<div class="form-group">
	    			<label>Id Legality</label>
	    			<input list="data1" class="form-control" id="Id_Legality" name="Id_Legality" placeholder="Masukan Id_Legality" onchange="return autofill1();" autocomplete="off">
				</div>

				<div id="ses2">
				<div class="form-group">
					<label>Number</label>
					<input type="number" class="form-control" id="Number" name="Number" placeholder="Masukan Number" readonly>
				</div>	
				<div class="form-group">
					<label>Party</label>
					<input type="number" class="form-control" id="Party" name="Party" placeholder="Masukan Party" readonly>
				</div>
				<div class="form-group">
	    			<label>Balance</label>
	    			<input type="text" class="form-control" id="Balance" name="Balance" placeholder="Masukan Balance" readonly>
				</div>
				<div class="form-group">
	    			<label>Commodity</label>
	    			<input type="text" class="form-control" id="Commodity" name="Commodity" placeholder="Masukan Commodity" readonly>
				</div>

				<div class="form-group" >
					<label>Purpose of Unloading</label>
					<input type="text" class="form-control" id="Purpose_of_Unloading" name="Purpose_of_Unloading" placeholder="Masukan Purpose of Unloading" readonly>
				</div>
			    <div class="form-group">
					<label>Transportir</label>
					<input type="text" class="form-control" id="Transportir" name="Transportir" placeholder="Masukan Transportir" readonly>
				</div>	
			    <div class="form-group">
					<label>Customer</label>
					<input type="Customer" class="form-control" id="Customer" name="Customer" placeholder="Masukan Customer" readonly>
				</div>

				<div class="form-group">
					<label>Date Legality</label>
					<input type="Date" class="form-control" id="Date_Legality" name="Date_Legality" placeholder="Masukan Date_Legality" readonly>
				</div>

				</div>

  			<datalist id="data1">
			    <?php
			    foreach ($record1->result() as $b)
			    {
			        echo "<option value='$b->Id_Legality'>Number $b->Number & Balance $b->Balance</option>";
			    }
			    					    					    
			    ?>
			</datalist> 
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

				<div class="input-group" style="margin-top: 10px;">
					<label id="label-Document_Delivery_Order">Upload Dokumen Delivery Order </label>
					<div>
						<input name="Document_Delivery_Order" type="file">
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
        <div id="btnSave_">
        <button type="button" class="btn btn-primary" id="btnSave" onclick="cek()">Save changes</button>
		</div>
		<div id="btnSave_1">
        <button type="button" class="btn btn-primary" id="btnSave" onclick="save()">Konfirmasi</button>
    	</div>
      </div>
    </div>
  </div>
</div>
<!-- #modal ane -->
</section>
</div>
