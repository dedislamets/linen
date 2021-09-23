<script type="text/javascript">
	$(document).ready(function(){  
		$('.chosen-select').chosen({allow_single_deselect:true}); 
		$('#campaign').trigger("change");
	

	    myTable2 = $('#ViewTable2').DataTable({
			ajax: {		            
	            "url": "Model/dataTable?campaign=" + $('#campaign :selected').text(),
	            "type": "GET"
	        },
	        processing	: true,
			serverSide	: true,			
			"bPaginate": true,	
			// "ordering": false,
			"autoWidth": true,
			"order": [[ 1, "desc" ]],
			"initComplete": function(settings, json) {
                hideloader();
            },           
	    });

		$('#dealer').on('change', function() {
			$("#txtCode").val($(this).val());
		});

		$('#campaign').on('change', function() {
			$("#txtAwal").val($(this).find(':selected').data('awal').substring(0,10));
			$("#txtAkhir").val($(this).find(':selected').data('akhir').substring(0,10));
		});

		$('#btnGo').on('click', function (event) {
            showloader('body');
            myTable2.ajax.url("Model/dataTable?campaign=" + $('#campaign :selected').text() ).load();    

            hideloader();
        });
	});


	$('#campaign').on('change', function() {
		$("#txtAwal").val($(this).find(':selected').data('awal').substring(0,10));
		$("#txtAkhir").val($(this).find(':selected').data('akhir').substring(0,10));
	});

	

</script>