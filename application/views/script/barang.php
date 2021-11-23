<script type="text/javascript">
	var oTable;
	$(document).ready(function(){  
		
	 oTable = $('#ViewTable').DataTable({
			dom: 'frtip',
			ajax: {		            
	            "url": "Barang/dataTable",
	            "type": "GET"
	        },
	        processing	: true,
			serverSide	: true,			
			"bPaginate": true,	
			// "ordering": false,
			"autoWidth": true,
			// "order": [[ 4, "desc" ]],
			columnDefs:[
				{ "width": "100px", "targets": [5,4,3,6] },
				
			]

	    });

	})

	function editmodal(val){

		$.get('barang/edit', { id: $(val).data('id') }, function(data){ 
			$("#lbl-title").text("Edit");

			$("#id_jenis").val(data[0]['id_jenis']);
			$("#id_jenis").change();
			$("#serial").val(data[0]['serial']);
       		$('#ModalAdd').modal({backdrop: 'static', keyboard: false}) ;
           
        });

	}

	$('#btnSubmit').on('click', function (e) {
		var valid = false;
    	var sParam = $('#Form').serialize();
    	var validator = $('#Form').validate({
							rules: {
									serial: {
							  			required: true
									},
									
								}
							});
	 	validator.valid();
	 	$status = validator.form();
	 	if($status) {
	 		var link = 'Barang/update';
	 		$.post(link,sParam, function(data){
				if(data.error==false){									
					oTable.ajax.reload(null, false);  
					$('#ModalAdd').modal('hide');
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
			
			$.get('Barang/delete', { id: $(val).data('id') }, function(data){ 
				window.location.reload();
			})
		
		}
	}
</script>
