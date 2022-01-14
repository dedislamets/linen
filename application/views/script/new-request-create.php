<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.6/js/plugins/piexif.min.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.6/js/plugins/sortable.min.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.6/js/fileinput.min.js"></script>
<script type="text/javascript">
	var cities = <?php echo json_encode($jenis); ?>;
	$(document).ready(function(){  
		$("#tanggal" ).datepicker();
        
		if($("#mode").val() == 'edit') {
			pilih_edit($("#id_request").val());

		}else{

			$("#btnAdd").trigger('click');
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
	 		valid = validateBarangDesktop();
	 		if(valid) {	
		 		var link = '<?= base_url() ?>newrequest/Save';
		 		$.post(link,sParam, function(data){
					if(data.error==false){	
						$('.file').fileinput('upload'); 
						alert('Sukses');
						window.location.href = '<?= base_url(); ?>newrequest/edit/' + data.id;
					}else{	
						alert(data.message);				  	
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
		baris += '<td><input type="text" id="jenis'+ nomor +'" name="jenis'+ nomor +'" placeholder="" class="form-control" value=""></td>';
		baris += '<td><input type="text" id="spesifikasi'+ nomor +'" name="spesifikasi'+ nomor +'" placeholder="" class="form-control" value=""></td>';
		baris += '<td width="90"><input type="number" id="qty'+ nomor +'" name="qty'+ nomor +'" placeholder="" class="form-control" value="0"></td>';
		baris += '<td><input type="text" id="link'+ nomor +'" name="link'+ nomor +'" placeholder="" class="form-control" value=""></td>';
		baris += '<td ></td>';
		baris +='<td></td>';
	
		baris += '</tr>';
		
		var last = $('#tbody-table tr:last').html();
		if(last== undefined){
			$(baris).appendTo("#tbody-table");
		}else{
			$('#tbody-table tr:last').after(baris);
		}

		// $("#filefoto"+ nomor).fileinput({
  //   		theme: 'fa',
  //   		autoReplace: false,
		// 	showCaption: true,
		// 	overwriteInitial: false,
		// 	fileType: "any",
		// 	dropZoneEnabled: false,
		// 	maxFileCount: 5,
		// 	showUpload: false,
		// 	showRemove: false,
		// 	uploadUrl: "<?=base_url()?>newrequest/upload",
		// 	uploadAsync: false,
		// 	initialPreviewAsData: true, 
		// 	initialPreviewDownloadUrl: "<?=base_url()?>upload/baru/{filename}",
		// 	uploadExtraData : function (previewId, index) {
		// 	    return {
		//             id_request: $("#id_request").val(),
		//             id_request_detail: obj.id
		//         };
		//     },
		// });
	});


	$(document).on('blur', "[id^=qty]", function(){
		calculateTotal();
	});

	function pilih_edit(val){
		
		$.get('<?= base_url()?>newrequest/get', { id: val }, function(data){ 
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
				var readonly = "";
				var showBrowse = true;
				var showRemove = true;
				if(obj.status == 'Pending' ) {
				baris += '<td width="50"><input type="hidden" name="id_detail'+ nomor +'" id="id_detail'+ nomor +'" class="form-control" value="' + obj.id+'" /><a href="javascript:void(0)" class="btn hor-grd btn-danger" onclick="cancel(this)"><i class="fa fa-trash"></i></a></td>';
				} else{
					baris +='<td></td>';
					readonly = "readonly";
					showBrowse = false;
					showRemove = false;
				}
		        baris += '<td><input type="text" id="jenis'+ nomor +'" name="jenis'+ nomor +'" placeholder="" class="form-control" value="' + obj.jenis+'" '+ readonly+'></td>';
		        baris += '<td><input type="text" id="spesifikasi'+ nomor +'" name="spesifikasi'+ nomor +'" placeholder="" class="form-control" value="' + obj.spesifikasi+'" '+ readonly+'></td>';
				baris += '<td><input type="number" id="qty'+ nomor +'" name="qty'+ nomor +'" placeholder="" class="form-control" value="' + obj.qty+'" '+ readonly+'></td>';
				baris += '<td><input type="text" id="link'+ nomor +'" name="link'+ nomor +'" placeholder="" class="form-control" value="' + obj.link+'" '+ readonly+'></td>';
				baris += '<td ><input id="filefoto'+ nomor+'" name="filefoto[]" type="file" class="file" multiple=true accept=".jpg,.gif,.png,.jpeg,.xls,.xlsx,.pdf,.mp4"></td>';
				baris += '<td>' + obj.status+'</td>';
				
				baris += '</tr>';
				
				var last = $('#tbody-table tr:last').html();
				if(last== undefined){
					$(baris).appendTo("#tbody-table");
				}else{
					$('#tbody-table tr:last').after(baris);
				}
				var data_arr = [];
				var link = '<?= base_url(); ?>newrequest/getimages/' + obj.id;
				$.get(link,null, function(data){
					data_arr= data;
					$("#filefoto"+ nomor).fileinput({
			    		theme: 'fa',
			    		autoReplace: false,
						showCaption: true,
						overwriteInitial: false,
						fileType: "any",
						dropZoneEnabled: false,
						maxFileCount: 5,
						showUpload: false,
						showBrowse: showBrowse,
						showRemove: showRemove,
						uploadUrl: "<?=base_url()?>newrequest/upload",
						uploadAsync: false,
						initialPreviewAsData: true, 
						initialPreviewShowDelete: showRemove,
						initialPreviewDownloadUrl: "<?=base_url()?>upload/baru/{filename}",
					    uploadExtraData : function (previewId, index) {
						    return {
					            id_request: $("#id_request").val(),
					            id_request_detail: obj.id
					        };
					    },
					    deleteExtraData : function (previewId, index) {
						    return {
					            id_request: app.id_soal,
					            id_request_detail: id_soal_detail
					        };
					    },
					    initialPreview: data_arr['caption'],
				        initialPreviewConfig: data_arr['data']
					});
				})
			})
			// $('#form-request *').prop('disabled', true);
		})
	}

	function calculateTotal(){
		var qty = 0; 
		$("[id^='qty']").each(function() {
			qty += parseInt($(this).val());
		})
		$("#total_qty").val(qty);
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
