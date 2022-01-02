<script type="text/javascript">
	var oTable;
	$(document).ready(function(){  
		oTable = $('#ViewTable').DataTable({
			dom: 'frtip',
			ajax: {		            
	            "url": "listjemput/dataTable",
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

		$.get('pembelian/edit/' + $(val).data('id'), null, function(data){ 
				$("#lbl-title").text("Edit");
         		$("#no_penerimaan").val(data[0]['no_penerimaan']);
				$("#tanggal").val(data[0]['tanggal']);
				$("#deskripsi").val(data[0]['deskripsi']);
				$("#status").val(data[0]['status']);
				$("#id_penerimaan").val(data[0]['id']);
           		$('#ModalAdd').modal({backdrop: 'static', keyboard: false}) ;
           
        });

	}

	$('#btnBrowse').on('click', function (event) {
    	$('#modalBrowse').modal({backdrop: 'static', keyboard: false}) ;
    });


	function hapus(val) {
		var r = confirm("Yakin dihapus?");
		if (r == true) {
			
			$.get('pembelian/deletelist', { id: $(val).data('id') }, function(data){ 
				oTable.ajax.reload(null, false);
			})
		
		}
	}

	$('#btnAdd').on('click', function (event) {
		$("#lbl-title").text('Tambah');

		$.get('listjemput/create', null, function(data){ 
			$("#no_request").val(data['no_request']);
			$("#tanggal").val(data['tanggal']);
			$("#status").val('Submit');
			$("#requestor").val('');
			$("#id_request").val('');
			
		})
		$('#Form').find(':input:disabled').removeAttr('disabled');
		
		$('#ModalAdd').modal({backdrop: 'static', keyboard: false}) ;
	});

	$('#btnSubmit').on('click', function (e) {
		var valid = false;
    	var sParam = $('#Form').serialize();
    	var validator = $('#Form').validate({
							rules: {
									requestor: {
							  			required: true
									},
								}
							});
	 	validator.valid();
	 	$status = validator.form();
	 	if($status) {
	 		var link = 'listjemput/Save';
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
</script>
