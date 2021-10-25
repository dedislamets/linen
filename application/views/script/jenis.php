<script type="text/javascript">
	var oTable;
	$(document).ready(function(){  
		oTable = $('#ViewTable').DataTable({
			dom: 'frtip',
			ajax: {		            
	            "url": "jenis/dataTable",
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

		$.get('jenis/edit', { id: $(val).data('id') }, function(data){ 
				$("#lbl-title").text("Edit");
				$("#jenis").val(data[0]['jenis']);
				$("#fmedis").val(data[0]['fmedis']);
				$("#harga").val(data[0]['harga']);
				$("#berat").val(data[0]['berat']);
				$("#spesifikasi").val(data[0]['spesifikasi']);
				$("#id_jenis").val(data[0]['id']);
           		$('#ModalAdd').modal({backdrop: 'static', keyboard: false}) ;
           
        });

	}
	
	$('#btnAdd').on('click', function (event) {
		$("#lbl-title").text('Tambah');
		$("#jenis").val('');
		$("#fmedis").val("Medis");
		$("#harga").val(0);
		$("#berat").val(0);
		$("#spesifikasi").val('');
		$("#id_jenis").val('');
		$('#Form').find(':input:disabled').removeAttr('disabled');
		
		$('#ModalAdd').modal({backdrop: 'static', keyboard: false}) ;
	});

	$('#btnSubmit').on('click', function (e) {
		var valid = false;
    	var sParam = $('#Form').serialize();
    	var validator = $('#Form').validate({
							rules: {
									jenis: {
							  			required: true
									},
								}
							});
	 	validator.valid();
	 	$status = validator.form();
	 	if($status) {
	 		var link = 'jenis/Save';
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

    $('#harga').on('keyup', function (event) {
    	$(this).val(formatRupiah($(this).val()));
    });

	function hapus(val) {
		var r = confirm("Yakin dihapus?");
		if (r == true) {
			
			$.get('jenis/delete', { id: $(val).data('id') }, function(data){ 
				oTable.ajax.reload(null, false);  
			})
		
		}
	}

	function formatRupiah(angka) {
	  	var number_string = angka.replace(/[^,\d]/g, "").toString(),
		    split = number_string.split(","),
		    sisa = split[0].length % 3,
		    rupiah = split[0].substr(0, sisa),
		    ribuan = split[0].substr(sisa).match(/\d{3}/gi);

	  // tambahkan titik jika yang di input sudah menjadi angka ribuan
	  if (ribuan) {
	    separator = sisa ? "." : "";
	    rupiah += separator + ribuan.join(".");
	  }

	  rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
	  if(rupiah=="") rupiah = 0;
	  return rupiah;
	}
</script>
