<script type="text/javascript">
	var cities = <?php echo json_encode($jenis); ?>;
	var vendor = <?php echo json_encode($vendor); ?>;
	$(document).ready(function(){  
		$("#tanggal" ).datepicker();
        
		if($("#mode").val() != 'new') {
			pilih_edit($("#id_penerimaan").val());

		}else{
			$("#btnAdd").trigger('click');
		}
	})


	$('#btn-finish').on('click', function (e) {
		event.preventDefault();
		var valid = false;
    	var sParam = $('#form-request').serialize();
    	var validator = $('#form-request').validate({
							rules: {
									no_penerimaan: {
							  			required: true
									},
									id_penerimaan: {
							  			required: true
									},
									  
								}
							});
	 	validator.valid();
	 	$status = validator.form();
	 	if($status) {
	 		var valid = true;
	 		valid = validateBarangDesktop();
	 		if(valid) {	
		 		var link = '<?= base_url() ?>pembelian/SaveDetail';
		 		$.post(link,sParam, function(data){
					if(data.error==false){	
						alert("Tersimpan");
						window.location.href="<?= base_url(); ?>pembelian/detail/"+ data.id
					}else{	
						alertError(data.message);				  	
					}
				},'json');
	 		}
	 	}
        
    });
	function validateBarangDesktop(){
    	var flag = true;
    	if($("#tbody-table").html().trim() == ""){
    		alertError('Anda belum memasukkan daftar item..');
    		flag = false;
    	}else{
    		$("#tbody-table").find('tr').each(function (i, el) {
		        var $tds = $(this).find('td');
		        if($tds.eq(1).children().val() != undefined){
			        var qty = $($tds[3]).children().val();
			    
			        if(parseInt(qty) == 0){
			        	alertError('Qty masih kosong..');
			        	flag= false;
				        
			        }
			    }
		    });
    	}
    	return flag;
    }
    function validateBarang(){
    	var flag = true;


    	if($("#azChatList").html().trim() == ""){
    		alertError('Anda belum memasukkan daftar item..');
    		flag = false;
    	}else{
    		$("#azChatList").find('.media').each(function (i, el) {
    			var nomor = $(el).find('.nomor').data('num');
    			var qty = $(el).find('.qty').val()
		        if( qty === "0" || qty === ""){
		        	alertError('Anda belum memasukkan qty di baris ke ' + nomor + '..!!');
		        	flag = false;

		        }
		    });
    	}
    	return flag;
    }


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
		baris += '<td width="120"><input type="hidden" name="id_detail'+ nomor +'" id="id_detail'+ nomor +'" class="form-control" value="" /><a href="javascript:void(0)" class="btn hor-grd btn-danger" onclick="cancel(this)"><i class="fa fa-trash"></i>&nbsp; Del</a></td>';
		baris += '<td><select name="jenis'+ nomor+'" id="jenis'+ nomor+'" class="form-control">';
        baris += loadcities("");
        baris += '</select></td>';
        baris += '<td width="100"><a class="nav-link-detail" href="javascript::void(0)" onclick="showModalDetail(this)">Detail</a></td>';
		baris += '<td width="120"><input type="number" onChange="changeQty(this)" id="qty'+ nomor +'" name="qty'+ nomor +'" placeholder="" class="form-control" value="0"></td>';
		
	
		baris += '</tr>';
		
		var last = $('#tbody-table tr:last').html();
		if(last== undefined){
			$(baris).appendTo("#tbody-table");
		}else{
			$('#tbody-table tr:last').after(baris);
		}
	});


	function pilih_edit(val){
		$.get('<?= base_url()?>pembelian/get', { id: val }, function(data){ 
			$("#azChatList").empty();
			const tbody = $("#azChatList");
			var baris;
			tbody.html('');
			$.each(data['data_detail'], function(_, obj) {
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
				baris += '<td width="120"><input type="hidden" name="id_detail'+ nomor +'" id="id_detail'+ nomor +'" class="form-control" value="' + obj.id+'" /><a href="javascript:void(0)" class="btn hor-grd btn-danger" onclick="cancel(this)"><i class="fa fa-trash"></i>&nbsp; Del</a></td>';
				baris += '<td><select name="jenis'+ nomor+'" id="jenis'+ nomor+'" class="form-control" >';
		        baris += loadcities(obj.jenis);
		        baris += '</select></td>';
		        baris += '<td width="100"><a class="nav-link-detail" href="javascript::void(0)" data-id="' + obj.id_jenis+'" onclick="showModalDetail(this)">Detail</a></td>';
				baris += '<td width="120"><input type="number" id="qty'+ nomor +'" name="qty'+ nomor +'" onChange="changeQty(this)" placeholder="" class="form-control" value="' + obj.qty+'"></td>';
				
			
				baris += '</tr>';
				
				var last = $('#tbody-table tr:last').html();
				if(last== undefined){
					$(baris).appendTo("#tbody-table");
				}else{
					$('#tbody-table tr:last').after(baris);
				}
			})
		})
	}

	function calculateTotal(){
		var qty = 0; 
		$("[id^='qty']").each(function() {
			qty += parseInt($(this).val());
		})
		$("#total_qty").val(qty);
	}

	function loadcities(val){
		var option = "";
		var id_jenis = 0;
		for(var i = 0;i < cities.length; i ++){
			var city = cities[i];
			var selected="";
			if(val == city.jenis){
				selected = "selected";
				id_jenis = cities.id;
			}
			option +='<option value="'+city.jenis+'" label="'+city.jenis+'" '+ selected +'></option>';
		}
		return option;
	}

	function cancel(val) {
		var id=$(val).prevAll()[0].value;
		if(id != ""){
			var r = confirm("Yakin dihapus?");
			if (r == true) {
				$.get('<?= base_url()?>pembelian/delete', { id: id }, function(data){ 
					$(val).parent().parent().remove();
				})
			}
		}else{
			$(val).parent().parent().remove();
		}
		$(val).parent().parent().remove();

	}

	function changeQty(val) {
		if($(val).val() < 0){
			alertError('Qty tidak boleh minus!!');
			$(val).val(val.defaultValue);
		}
	}

	function showModalDetail(val){
		var name_jenis = $(val).parent().prev().children().val();
		var id_jenis_array = cities.filter(item => item.jenis.includes(name_jenis));
		var id_jenis = id_jenis_array[0].id;

		$.get('<?= base_url()?>jenis/edit', { id: id_jenis }, function(data){ 
     		$("#nama_item").text(data[0]['jenis']);
			$("#spesifikasi").text(data[0]['spesifikasi']);
			$("#berat").text(data[0]['berat']);
			$("#harga").text(data[0]['harga']);
			$("#jenis").text(data[0]['fmedis']);
       		$('#ModalDetail').modal({backdrop: 'static', keyboard: false}) ;
           
        });

	}
</script>
