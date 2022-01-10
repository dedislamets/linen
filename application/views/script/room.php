<script type="text/javascript">

	$(document).ready(function(){  
		$('#ViewTable').DataTable({
			dom: 'frtip',
			ajax: {		            
	            "url": "Room/dataTable",
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

		$.get('room/edit', { id: $(val).data('id') }, function(data){ 
				$("#lbl-title").text("Edit");
				$("#nama_ruangan").val(data[0]['ruangan']);
				// $("#finfeksius").val(data[0]['finfeksius']);
				$("#id_ruangan").val(data[0]['id']);
           		$('#ModalAdd').modal({backdrop: 'static', keyboard: false}) ;
           
        });

	}
	
	$('#btnAdd').on('click', function (event) {
		$("#lbl-title").text('Tambah');
		$("#nama_ruangan").val('');
		// $("#finfeksius").val("Infeksius");
		$("#id_ruangan").val('');
		$('#Form').find(':input:disabled').removeAttr('disabled');
		
		$('#ModalAdd').modal({backdrop: 'static', keyboard: false}) ;
	});

	$('#btnSubmit').on('click', function (e) {
		var valid = false;
    	var sParam = $('#Form').serialize();
    	var validator = $('#Form').validate({
							rules: {
									nama_ruangan: {
							  			required: true
									}
								}
							});
	 	validator.valid();
	 	$status = validator.form();
	 	if($status) {
	 		var link = 'room/Save';
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
			
			$.get('room/delete', { id: $(val).data('id') }, function(data){ 
				window.location.reload();
			})
		
		}
	}
</script>
