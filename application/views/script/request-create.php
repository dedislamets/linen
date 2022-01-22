<script type="text/javascript">
	var cities = <?php echo json_encode($jenis); ?>;
	$(document).ready(function(){  
		$("#tanggal" ).datepicker();
        
		if($("#mode").val() == 'edit') {
			pilih_edit($("#id_request").val());

		}else{
			<?php
        	$detect = new Mobile_Detect;
			if ( $detect->isMobile() ): ?>
				$("#btnAddMobile").trigger('click');
			<?php else: ?>
				$("#btnAdd").trigger('click');
			<?php endif; ?>
		}
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


	$('#btn-finish').on('click', function (e) {
		event.preventDefault();
		var valid = false;
    	var sParam = $('#form-request').serialize();
    	var validator = $('#form-request').validate({
							rules: {
									no_request: {
							  			required: true
									},
									requestor: {
							  			required: true
									},
									total_qty: {
							  			required: true
									},
									  
								}
							});
	 	validator.valid();
	 	$status = validator.form();
	 	if($status) {
	 		var valid = true;
	 		<?php
        	$detect = new Mobile_Detect;
			if ( $detect->isMobile() ): ?>
				valid= validateBarang();
			<?php else: ?>
				valid = validateBarangDesktop()
			<?php endif; ?>
	 		if(valid) {	
		 		var link = '<?= base_url() ?>listrequest/Save';
		 		$.post(link,sParam, function(data){
					if(data.error==false){	
						alert("Tersimpan");
						window.location.href = '<?= base_url(); ?>listrequest';
						androidObj.showToast("ok");
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

	function hapus(val) {
		var r = confirm("Yakin dihapus?");
		if (r == true) {
			
			$.get('linenkotor/deletelist', { id: $(val).data('id') }, function(data){ 
				window.location.reload();
			})
		
		}
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
		baris += '<td width="120"><input type="number" id="qty'+ nomor +'" name="qty'+ nomor +'" placeholder="" class="form-control" value="0"></td>';
		
	
		baris += '</tr>';
		
		var last = $('#tbody-table tr:last').html();
		if(last== undefined){
			$(baris).appendTo("#tbody-table");
		}else{
			$('#tbody-table tr:last').after(baris);
		}
	});

	$('#btnAddMobile').on('click', function (event) {
		event.preventDefault();
		var nomor = $("#azChatList").find('.nomor:last').data('num');
		if( $.isNumeric( nomor ) ) 	{
			nomor = parseInt(nomor) + 1;
		}else{		
			nomor = 1
		}

		$('#total-row').val(nomor);
		var baris = '<div class="media new shadow-base">';
		baris +='<div class="left-view-card nomor" style="padding: 10px;" data-num="'+ nomor+'">'+ nomor+'</div>';
        baris +='   <div class="left-view-card">';
        baris +='		<input type="hidden" name="id_detail'+ nomor +'" id="id_detail'+ nomor +'" class="form-control" value="" />';
        baris +='       <button class="btn hor-grd btn-danger btn-mobile" onclick="cancel(this)"> <i class="fa fa-trash"></i></button> ';
        baris +='   </div>';
        baris +='   <div class="media-body">';
        baris +='       <div class="media-contact-name">';
        baris +='          <span>Nama Barang</span>';
        baris +='          <select name="jenis'+ nomor+'" id="jenis'+ nomor+'" class="form-control">';
        baris += loadcities("");
        baris +='          </select>';
        baris +='        </div>';
        baris +='        <div class="media-contact-name">';
        baris +='            <span style="width: 85px">Jumlah</span>';
        baris +='            <input type="number" id="qty'+ nomor+'" name="qty'+ nomor+'" placeholder="" class="form-control qty" value="0">';
        baris +='        </div>';
        baris +='    </div>';
	
		baris += '</div>';
		$(baris).appendTo("#azChatList");

	});

	$(document).on('blur', "[id^=qty]", function(){
		calculateTotal();
	});

	function pilih_edit(val){
		$.get('<?= base_url()?>listrequest/get', { id: val }, function(data){ 
			$("#azChatList").empty();
			const tbody = $("#azChatList");
			var baris;
			tbody.html('');
			$.each(data['data_detail'], function(_, obj) {

				<?php $detect = new Mobile_Detect;
				if ( $detect->isMobile() ): ?>
					var nomor = $("#azChatList").find('.nomor:last').data('num');
					if( $.isNumeric( nomor ) ) 	{
						nomor = parseInt(nomor) + 1;
					}else{		
						nomor = 1
					}

					$('#total-row').val(nomor);
					var baris = '<div class="media new shadow-base">';
					baris +='<div class="left-view-card nomor" style="padding: 10px;" data-num="'+ nomor+'">'+ nomor+'</div>';
			        baris +='   <div class="left-view-card">';
			        baris +='		<input type="hidden" name="id_detail'+ nomor +'" id="id_detail'+ nomor +'" class="form-control" value="' + obj.id+'" />';
			        baris +='       <button class="btn hor-grd btn-danger btn-mobile" onclick="cancel(this)"> <i class="fa fa-trash"></i></button> ';
			        baris +='   </div>';
			        baris +='   <div class="media-body">';
			        baris +='       <div class="media-contact-name">';
			        baris +='          <span>Nama Barang</span>';
			        baris +='          <select name="jenis'+ nomor+'" id="jenis'+ nomor+'" class="form-control">';
			        baris += 			loadcities(obj.jenis);
			        baris +='          </select>';
			        baris +='        </div>';
			        baris +='        <div class="media-contact-name">';
			        baris +='            <span style="width: 85px">Jumlah</span>';
			        baris +='            <input type="number" id="qty'+ nomor+'" name="qty'+ nomor+'" placeholder="" class="form-control qty" value="' + obj.qty+'">';
			        baris +='        </div>';
			        baris +='    </div>';
				
					baris += '</div>';
					$(baris).appendTo("#azChatList");
				<?php else: ?>
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
					baris += '<td><select name="jenis'+ nomor+'" id="jenis'+ nomor+'" class="form-control">';
			        baris += loadcities(obj.jenis);
			        baris += '</select></td>';
					baris += '<td width="120"><input type="number" id="qty'+ nomor +'" name="qty'+ nomor +'" placeholder="" class="form-control" value="' + obj.qty+'"></td>';
					
				
					baris += '</tr>';
					
					var last = $('#tbody-table tr:last').html();
					if(last== undefined){
						$(baris).appendTo("#tbody-table");
					}else{
						$('#tbody-table tr:last').after(baris);
					}
				<?php endif; ?>
				
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
		for(var i = 0;i < cities.length; i ++){
			var city = cities[i];
			var selected="";
			if(val == city.jenis){
				selected = "selected";
			}
			option +='<option value="'+city.jenis+'" label="'+city.jenis+'" '+ selected +'></option>';
		}
		return option;
	}

	function cancel(val) {
		// var id=$(val).prevAll()[1].value;
		// if(id != ""){
		// 	var r = confirm("Yakin dihapus?");
		// 	if (r == true) {
		// 		$.get('<?= base_url()?>spk/delete', { id: id }, function(data){ 
		// 			$(val).parent().parent().remove();
		// 		})
		// 	}
		// }else{
		// 	$(val).parent().parent().remove();
		// }
		$(val).parent().parent().remove();

	}
</script>
