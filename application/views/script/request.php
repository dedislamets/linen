<script type="text/javascript">
	var mode = 1;
	$(document).ready(function(){  

		var table = $('#ViewTable').DataTable({
			responsive: true,
			ajax: {		            
	            "url": "listrequest/dataTable",
	            "type": "GET"
	        },
	        processing	: true,
			serverSide	: true,

	    });

	    $('#ViewTableDetail').DataTable({
			responsive: true,
			ajax: {		            
	            "url": "listrequest/dataTableDetail",
	            "type": "GET"
	        },
	        processing	: true,
			serverSide	: true,
			"columnDefs": [
				{
	            "targets": 2,
	            "render": function ( data, type, row, meta ) {
	                var text = '<a href="listrequest/edit/'+ data +'" style="font-weight:500;">'+ data +'</a>';
	              	return text;
	            	}
	          	},
			]
	    });

	    $("#ViewTableDetail_wrapper").css("display",'none');
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

	$('#btnMode').on('click', function (e) {
		if(mode == 0){
			mode = 1;
			$("#ViewTable_wrapper").css("display",'block');
			$("#ViewTableDetail_wrapper").css("display",'none');
			$("#btnMode").text('Mode Ringkas');
		}else{
			mode = 0;
			$("#ViewTable_wrapper").css("display",'none');
			$("#ViewTableDetail_wrapper").css("display",'block');
			$("#btnMode").text('Mode Detail');
		}
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
			
			$.get('listrequest/deletelist', { id: $(val).data('id') }, function(data){ 
				window.location.reload();
			})
		
		}
	}

</script>
