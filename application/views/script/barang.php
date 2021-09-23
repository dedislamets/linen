<script type="text/javascript">

	$(document).ready(function(){  
		$('#ViewTable').DataTable({
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
				{ "width": "100px", "targets": [4,3,2] },
				
			]

	    });

	})

	function editmodal(val){

		$.get('barang/edit', { id: $(val).data('id') }, function(data){ 
				$("#lbl-title").text("Edit");
         		$("#jenis").val(data[0]['jenis_barang']);
				$("#jenis").change();
				$("#satuan").val(data[0]['satuan']);
				$("#satuan").change();
				$("#nama_barang").val(data[0]['nama_barang']);
				$("#berat_barang").val(data[0]['berat_barang']);
				$("#id_barang").val(data[0]['id_barang']);
           		$('#ModalAdd').modal({backdrop: 'static', keyboard: false}) ;
           
        });

	}
	
	$('#btnAdd').on('click', function (event) {
		$("#lbl-title").text('Tambah');
		$("#jenis").val('Gadget');
		$("#satuan").val('Kg');
		$("#nama_barang").val('');
		$("#berat_barang").val(0);
		$("#id_barang").val('');
		$('#Form').find(':input:disabled').removeAttr('disabled');
		
		$('#ModalAdd').modal({backdrop: 'static', keyboard: false}) ;
	});

	$('#btnSubmit').on('click', function (e) {
		var valid = false;
    	var sParam = $('#Form').serialize();
    	var validator = $('#Form').validate({
							rules: {
									nama_barang: {
							  			required: true
									},
									berat_barang: {
							  			required: true
									},
									jenis: {
							  			required: true
									},
									  
								}
							});
	 	validator.valid();
	 	$status = validator.form();
	 	if($status) {
	 		var link = 'Barang/Save';
	 		$.post(link,sParam, function(data){
				if(data.error==false){									
					window.location.reload();
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
