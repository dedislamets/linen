<script type="text/javascript">

	$(document).ready(function(){  
		$('#ViewTable').DataTable({
			dom: 'frtip',
			ajax: {		            
	            "url": "linenkeluar/dataTable",
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

	$('#btnBrowse').on('click', function (event) {
    	$('#modalBrowse').modal({backdrop: 'static', keyboard: false}) ;
    });


	function hapus(val) {
		var r = confirm("Yakin dihapus?");
		if (r == true) {
			
			$.get('linenbersih/deletelist', { id: $(val).data('id') }, function(data){ 
				window.location.reload();
			})
		
		}
	}
</script>
