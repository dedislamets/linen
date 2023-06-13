<script type="text/javascript">

	$(document).ready(function(){  
		$('#ViewTable').DataTable({
			responsive: true,
			dom: 'frtip',
			ajax: {		            
	            "url": "<?= base_url()?>pengawasan/dataTable",
	            "type": "GET"
	        },
	        processing	: true,
			serverSide	: true,			
			"bPaginate": true,	
			order: [
	            [0, 'desc']
	        ],
	    });

	})

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
			
			$.get('linenkotor/deletelist', { id: $(val).data('id') }, function(data){ 
				window.location.reload();
			})
		
		}
	}
</script>
