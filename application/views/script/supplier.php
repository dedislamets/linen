<script type="text/javascript">
	var oTable;
	$(document).ready(function(){  
		oTable = $('#ViewTable').DataTable({
			dom: 'frtip',
			ajax: {		            
	            "url": "supplier/dataTable",
	            "type": "GET"
	        },
	        processing	: true,
			serverSide	: true,			
			"bPaginate": true,	
			// "ordering": false,
			"autoWidth": true,

	    });

	})

	function editmodal(val){

		$.get('supplier/edit', { id: $(val).data('id') }, function(data){ 
				$("#lbl-title").text("Edit");
				$("#vendor_code").attr("readonly","readonly");
				$("#vendor_code").val(data[0]['vendor_code']);
				$("#vendor_name").val(data[0]['vendor_name']);
				$("#phone").val(data[0]['phone']);
				$("#contact").val(data[0]['contact']);
				$("#alamat").val(data[0]['alamat']);
				$("#id_vendor").val(data[0]['id']);
           		$('#ModalAdd').modal({backdrop: 'static', keyboard: false}) ;
           
        });

	}
	
	$('#btnAdd').on('click', function (event) {
		$("#lbl-title").text('Tambah');
		$("#vendor_code").removeAttr("readonly");
		$("#vendor_code").val('');
		$("#vendor_name").val("");
		$("#phone").val('');
		$("#contact").val('');
		$("#alamat").val('');
		$("#id_vendor").val('');
		$('#Form').find(':input:disabled').removeAttr('disabled');
		
		$('#ModalAdd').modal({backdrop: 'static', keyboard: false}) ;
	});

	$('#btnSubmit').on('click', function (e) {
		var valid = false;
    	var sParam = $('#Form').serialize();
    	var validator = $('#Form').validate({
							rules: {
									vendor_code: {
							  			required: true
									},
									vendor_name: {
							  			required: true
									},
								}
							});
	 	validator.valid();
	 	$status = validator.form();
	 	if($status) {
	 		var link = 'supplier/Save';
	 		$.post(link,sParam, function(data){
				if(data.error==false){				
					$('#ModalAdd').modal('hide');					
					oTable.ajax.reload(null, false);  
				}else{	
					$("#lblMessage").remove();
					$("<div id='lblMessage' class='alert alert-danger' style='display: inline-block;float: left;width: 68%;padding: 10px;text-align: left;'><strong><i class='ace-icon fa fa-times'></i> "+data.msg+"!</strong></div>").appendTo(".modal-footer");
											  					  	
				}
			},'json');
	 	}
        
    });

	function hapus(val) {
		var r = confirm("Yakin dihapus?");
		if (r == true) {
			
			$.get('supplier/delete', { id: $(val).data('id') }, function(data){ 
				oTable.ajax.reload(null, false);  
			})
		
		}
	}

</script>
