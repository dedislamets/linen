<script type="text/javascript">
	var app = new Vue({
        el: "#app",
        mounted: function () {
	      this.loadHistory();
	    },
	    updated: function () {
	    	var that = this;
	    	
	    },
        data: {
        	mode:'new',
        	id_spk: '',
        	moda_tran: '',
        	id_rs:'',
        	last_status:'<?= empty($data) ? "INPUT" : $data['STATUS'] ?>',
        	history: [],
        },
        methods: {
        	
		    updateHistory: function(){
		    	var that = this;
		    	var sParam = $('#form-routing').serialize();
		    	var link = '<?= base_url(); ?>Cargo/updatehistory';
		 		$.post(link,sParam, function(data){
					that.loadHistory();
				},'json');
		    },
		    loadHistory: function () {
		        var that = this;

		        // jQuery.ajax({
		        //   type: "GET",
		        //   cache:false,
		        //   url: '<?= base_url() ?>Trace/getHistory',
		        //   data: {id: $("#id_rs").val()},
		        //   success: function(response) {          
		        //       that.history = response;
		        //   },
		        // });
		    },

        }
    });


	$(document).ready(function(){  

		if($("#mode").val() == 'edit') {
			app.mode = 'edit';

		}
	})


	myTable = $('#ViewTableKotor').DataTable({
			ajax: {		            
	            "url": "<?= base_url(); ?>linenkotor/dataTableBrowse",
	            "type": "GET"
	        },
	        processing	: true,
			serverSide	: true,			
			"bPaginate": true,	

	    });

	$('#ModalTableBrg').DataTable({
		ajax: {		            
	            "url": "<?= base_url(); ?>linenkotor/dataTableBrg",
	            "type": "GET"
	        },
        processing	: true,
		serverSide	: true,			
		"bPaginate": true,	
		"autoWidth": true,
    });

	
    $("#btnCariBarang").on('click', function (event) {
    	$('#modalBarang').modal({backdrop: 'static', keyboard: false}) ;
    });



	$('#btnAdd').on('click', function (event) {
		event.preventDefault();
		var nomor = $('#tbody-table tr:nth-last-child(1) td:first-child').html();
		if( $.isNumeric( nomor ) ) 	{
			nomor = parseInt(nomor) + 1;
		}else{		
			nomor = 1
		}

		$('#total-row').val(nomor);
		$(".no-data").remove();
		var baris = '<tr>';
		baris += '<td style="width:1%">'+ nomor+'</td>';
		baris += '<td width="200"><input type="hidden" name="id_detail'+ nomor +'" id="id_detail'+ nomor +'" class="form-control" value="" /><a href="javascript:void(0)" id="cari'+ nomor +'" class="btn hor-grd btn-success" onclick="cari_dealer(this)"><i class="fa fa-search"></i>&nbsp; Cari</a><a href="javascript:void(0)" class="btn hor-grd btn-danger" onclick="cancel(this)"><i class="fa fa-trash"></i>&nbsp; Del</a></td>';
		baris += '<td><input type="text" name="epc'+ nomor +'" id="epc'+ nomor +'" class="form-control" value="" readonly /></td>';
		baris += '<td><input type="text" name="jenis'+ nomor +'" id="jenis'+ nomor +'" class="form-control" value="" readonly/></td>';
		baris += '<td><input type="text" readonly name="ruangan'+ nomor +'" id="ruangan'+ nomor +'" class="form-control"/></td>';
		baris += '<td><input type="number" readonly id="berat'+ nomor +'" name="berat'+ nomor +'" placeholder="" class="form-control" value="0"></td>';
		
	
		baris += '</tr>';
		
		var last = $('#tbody-table tr:last').html();
		if(last== undefined){
			$(baris).appendTo("#tbody-table");
		}else{
			$('#tbody-table tr:last').after(baris);
		}
	});

    $('#btnBrowse').on('click', function (event) {
    	$('#modalBrowse').modal({backdrop: 'static', keyboard: false}) ;
    });

    function cari_dealer(val) {
		event.preventDefault();
		$("#id-row").val($(val).attr('id'));
		$("#modalBarang").modal({backdrop: 'static', keyboard: false}) ;  	   
	}
   	
   	

    $('#btn-finish').on('click', function (event) {
    	event.preventDefault();
    	doclose();
		var valid = false;
    	var sParam = $('#form-routing').serialize();
    	var validator = $('#form-routing').validate({
							rules: {
									no_transaksi: {
							  			required: true
									},
									pic: {
							  			required: true
									},
									tanggal: {
							  			required: true
									},
								}
							});
	 	validator.valid();
	 	$status = validator.form();
	 	if($status) {
	 		if(validateBarang()){
		 		var link = '<?= base_url(); ?>linenbersih/Save';
		 		$.post(link,sParam, function(data){
					if(data.error==false){	
						alertOK();
						window.location.href = '<?= base_url(); ?>linenbersih/edit/' + data.id;
					}else{	
						alertError(data.message);				  	
					}
				},'json');
		 	}
	 	}
        
    });


	function validateBarang(){
    	var flag = true;
    	if($("#tbody-table").html().trim() == ""){
    		alertError('Anda belum memasukkan daftar item..');
    		flag = false;
    	}else{
    		$("#tbody-table").find('tr').each(function (i, el) {
		        var $tds = $(this).find('td');
		        if($tds.eq(1).next().children().val() != undefined){
			        var productId = $tds.eq(1).next().children().val().trim();
			        if(productId==""){
			        	alertError('Item belum dipilih..');
			        	flag= false;
			        }
			    }
		    });
    	}
    	return flag;
    }

	function pilih_item(val){
		var el = $("#id-row").val();
		var itemno= $(val).data('id');
		var x= true;
		var no=0;
		var berat = 0;
		$("#tbody-table").find('tr').each(function (i, el) {
			no++;
			berat += parseFloat($(val).parent().prev().text());
	        var $tds = $(this).find('td');
	        if($tds.eq(1).next().children().val() != undefined){
		        var productId = $tds.eq(1).next().children().val().trim();
		        if(productId==itemno){
		        	alert('Item No sudah ada, silahkan masukan item lain..');
		        	x=false;
		        }
		    }
	    });
	    if(x){
			$("#"+el).val(itemno);
			var tks = $(val).parent().prev().prev().prev().prev().text();
			$("#"+el).parent().next().children().val(tks.replace("\n", "<br>"));
			$("#"+el).parent().next().next().children().val($(val).parent().prev().prev().prev().text());
			$("#"+el).parent().next().next().next().children().val($(val).parent().prev().prev().text());
			$("#"+el).parent().next().next().next().next().children().val($(val).parent().prev().text());
			$("#modalBarang").modal('hide');
			$("#total_qty").val(no);
			$("#total_berat").val(berat);
		}
	}


	function cancel(val) {
		var id=$(val).prevAll()[1].value;
		if(id != ""){
			var r = confirm("Yakin dihapus?");
			if (r == true) {
				$.get('<?= base_url()?>linenbersih/delete', { id: id, no_transaksi: $("#no_transaksi").val() }, function(data){ 
					$(val).parent().parent().remove();
					$("#total_qty").val(data.total);
					$("#total-row").val(data.total);
					$("#total_berat").val(data.berat);
				})
			}
		}else{
			$(val).parent().parent().remove();
		}
	}
	
</script>