<script type="text/javascript">
	var app = new Vue({
        el: "#app",
        mounted: function () {
	      // this.loadHistory();
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
        	list_proses: [],
        },
        methods: {
        	
		    
        }
    });

	var start=0;
    var setScan= null;
    var arr_epc= [];
    var arr_epc_scan = [];
    var totalqty=0;
    var totalberat=0;

	$(document).ready(function(){  
		$("#tanggal" ).datepicker();
		$("#tbody-table").find('tr').each(function (i, el) {
	        var $tds = $(this).find('td');
	        if($tds.eq(1).next().children().val() != undefined){
		        var epc = $tds.eq(1).next().children().val().trim();
		        arr_epc.push(epc);
		    }
	    });

	    if($("#mode").val() == 'edit') {
			arr_epc_scan = arr_epc;
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

    $("#btnStop").on('click', function(e) {
    	e.preventDefault();
    	doclose();
    	$('#tbody-table').html('');
    	arr_epc = [];
    	start = 0;
    	totalqty=0;
    	$("#total_qty").val(totalqty);
    	$("#total_berat").val(0);
		$("#btnScan").text('Start Scan');
		clearInterval(setScan);
		
		$("#status_koneksi").val("Stop scanning...");
    })


    $("#btnScan").on('click', function(e) {
    	e.preventDefault();
    	// arr_epc = [];
    	$("#status_koneksi").removeClass("error-text");
    	$("#status_koneksi").addClass("scan-text");
    	if(start == 0){
    		config();
    	}else{
    		start = 0;
    		$("#btnScan").html('<i class="fa fa-barcode"></i> Start Scan');
    		$("#status_koneksi").val('Stop scanning...');
    		clearInterval(setScan);
    		doclose();
    		return;
    	}
        
    })

    function config(){
    	$.get('<?= base_url()?>api/config', {  }, function(data){ 
    		if(data.status){
    			var Port = data.data[0].port_com;
    			var Baud = data.data[0].baud;

    			var ipAddr = data.data[0].ip;
		        var Port_IP= data.data[0].port_ip;
		        var def = data.data[0].default_scan;
		        var power= data.data[0].power;
		        var konek;
		        try{
		        	doclose();
		        	if (def ==1){
		        		konek = TUHF2000.RFID_TcpOpen(ipAddr,Port_IP);
		        	}else{
		        		konek = TUHF2000.RFID_ComOpen(Port,Baud);
		        	}
		        	
			        if(konek == 0){
			        	$("#btnScan").html('<i class="fa fa-stop"></i> Stop Scan');
			        	$("#status_koneksi").val("Tersambung...");
			        	TUHF2000.RFID_SetRfPower(power);
			        	TUHF2000.RFID_Beep(1);
			        	start =1;

			        	setScan = setInterval(function(){ 
				    		scanning(data.data[0].session, data.data[0].QValue, data.data[0].anteana);
				    	}, 100);
			        }else{
			        	$("#status_koneksi").val("Terputus...(Copot kabel usb dan pasang kembali untuk mengulangi scan!)");
			        }
		        }catch(e){
		        	alert('Terjadi gangguan, silahkan coba kembali..');
		        }
		       
		        
    		}
    	});

    }

    function scanning(session,QValue,anteana){
	  
	    var scantid=0;
	    var t=128;
       	
    	var sum = TUHF2000.RFID_Inventory(QValue,session,scantid,anteana,0,1); 
        if(sum=="") 
        {	 	
           $("#status_koneksi").val("Waiting for scanning...");
           // document.getElementById("SnEPC").innerText=sum;
           // alert(sum);
        }else {

	       var EPC_Len=parseInt(sum.substr(0,2),16);
           var EPC=sum.substr(2,EPC_Len*2);
           $("#status_koneksi").val("Get data Serial...("+ EPC +")");

            //Jika exist data di listview
            if(arr_epc.indexOf(EPC) > -1){
           		
           		if(arr_epc_scan.indexOf(EPC) > -1){
           			TUHF2000.RFID_Beep(0);
           			$("#status_koneksi").val("Waiting for scanning...");
           		}else{
           			TUHF2000.RFID_Beep(1);
           			arr_epc_scan.push(EPC);

           			$("#status_koneksi").val(EPC + " compare success...");

           			var row_status =$("tbody").find("[data-epc='"+ EPC +"']");
           			var urut = $(row_status).data('urut');
           			$(row_status).val(1);
           			

			        var params = { epc: EPC};
		        	$.get('<?= base_url() ?>linenkotor/getItemScan', params, function(data){ 
		        		var last_status = data.history;

		        		var status = '<select name="flag'+ urut +'" id="flag'+ urut +'" class="form-control">';
				        status += '<option value="OK" '+ (last_status != null && last_status.STATUS == 'CUCI' ? 'selected' : '') +'>Valid</option>';
				        status += '<option value="RUSAK">Rusak</option>';
				        status += '<option value="BARU">Tambahan</option>';
				        status += '<option value="exist" '+ (last_status != null && last_status.STATUS != 'CUCI' ? 'selected' : '') +'>Inprocess</option>';
				        status += '</select>';
				        $(row_status).after(status);

		        		var icon = '<i class="fa fa-check-circle" style="font-size: 30px;color: green;"></i>';
		        		if(last_status != null && last_status.STATUS != 'CUCI' ){
							icon = '<i class="fa fa-ban" style="font-size: 30px;color: red;"></i>';
						}
						var row_checked =$("tbody").find("[data-checked='"+ EPC +"']");
           				$(icon).appendTo(row_checked);
		        	})


			        
           		}

           	//JIka tidak exist di listview
            }else{
            	// totalqty = parseInt($("#total_qty").val());
           		// totalqty++;
           		// $("#total_qty").val(totalqty);

           		TUHF2000.RFID_Beep(1);
           		arr_epc.push(EPC);
	        	var params = { epc: EPC};
	        	$.get('<?= base_url() ?>linenkotor/getItemScan', params, function(data){ 
		            if(data.status == 'success'){
		            	totalberat = parseFloat($("#total_berat").val());
		            	totalberat += parseFloat(data.data_detail[0].berat);
		            	$("#total_berat").val(totalberat);

		            	totalqty = parseFloat($("#total_qty").val());
		            	totalqty++;
		            	$("#total_qty").val(totalqty);

			            var nomor = $('#tbody-table tr:nth-last-child(1) td:first-child').html();
						if( nomor != undefined ) 	{
							nomor = parseInt(nomor) + 1;
						}else{		
							nomor = 1
						}

						var last_status = data.history;

						$('#total-row').val(nomor);
						$(".no-data").remove();
						var baris = '<tr>';
						baris += '<td style="width:1%">'+ nomor+'</td>';
						baris += '<td width="100"><input type="hidden" name="id_detail'+ nomor +'" id="id_detail'+ nomor +'" class="form-control" value="" />';
						if($("#mode").val() == 'edit') { 
							baris += '<a href="javascript:void(0)" class="btn hor-grd btn-danger" onclick="cancel(this)"><i class="fa fa-trash"></i>&nbsp; Del</a>';
						} 
						baris += '</td>';
						baris += '<td><input type="text" name="epc'+ nomor +'" id="epc'+ nomor +'" class="form-control" value="'+ EPC +'" readonly /></td>';
						baris += '<td><input type="text" name="jenis'+ nomor +'" id="jenis'+ nomor +'" class="form-control" value="'+ data.data_detail[0].jenis +'" readonly/></td>';
						baris += '<td><input type="text" readonly name="ruangan'+ nomor +'" id="ruangan'+ nomor +'" class="form-control" value="'+ data.data_detail[0].nama_ruangan +'"/></td>';
						baris += '<td><input type="number" readonly id="berat'+ nomor +'" name="berat'+ nomor +'" placeholder="" class="form-control" value="'+ data.data_detail[0].berat +'"></td>';
						var status = '<select name="flag'+ nomor +'" id="flag'+ nomor +'" class="form-control">';
				        status += '<option value="OK">Valid</option>';
				        status += '<option value="RUSAK">Rusak</option>';
				        status += '<option value="BARU" '+ (last_status == null || last_status.STATUS == 'CUCI' ? 'selected' : '') +'>Tambahan</option>';
				        status += '<option value="exist" '+ (last_status != null && last_status.STATUS != 'CUCI' ? 'selected' : '') +'>Inprocess</option>';
				        status += '</select>';
						baris += '<td> <input type="hidden" id="checked'+ nomor +'" name="checked'+ nomor +'" data-epc="'+ EPC +'" class="form-control" value="2">'+ status +'</td>';
						var icon = '<i class="fa fa-plus-circle" style="font-size: 30px;color: orange;"></i>';
						if(last_status != null && last_status.STATUS != 'CUCI'){
							icon = '<i class="fa fa-ban" style="font-size: 30px;color: red;"></i>';
						}
						baris += '<td style="text-align:center;" data-checked="'+ EPC +'">'+ icon +'</td>';
						baris += '</tr>';
						
						var last = $('#tbody-table tr:last').html();
						if(last== undefined){
							$(baris).appendTo("#tbody-table");
						}else{
							$('#tbody-table tr:last').after(baris);
						}

						arr_epc_scan.push(EPC);
		            }
		    	})
           }
        }

        // doclose();
    }

    function doclose() 
    { 
        var sum = TUHF2000.RFID_ComClose(); 	
        // if(sum==0) 	$("#status_koneksi").val("Terputus...");
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
	 			if (confirm("Lanjutkan menyimpan data?")) {
			 		var link = '<?= base_url(); ?>linenbersih/Save';
			 		$.post(link,sParam, function(data){
						if(data.error==false){	
							alert('Data Sukses Tersimpan');
							window.location.href = '<?= base_url(); ?>linenbersih';
						}else{	
							alertError(data.message);				  	
						}
					},'json');
				} 
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
			        var status = $tds.eq(5).next().children().next().val();
			        if(status=="exist"){
			        	alert('Terdapat data yang berstatus inprogress, gagal menyimpan!');
			        	flag= false;
			        }
			        if(status== undefined){
			        	alert('Terdapat item yang belum di scan..!');
			        	flag= false;
			        }
			    }
		    });
    	}
    	return flag;
    }

    $(document).on('change', "[id^=flag]", function(){
		var status =$(this).val();
		var EPC =  	$(this).parent().children().data('epc');		
        var icon = '';  				
		if(status == "exist"){
			icon = '<i class="fa fa-ban" style="font-size: 30px;color: red;"></i>';
		}else if (status == "BARU") {
			icon = '<i class="fa fa-plus-circle" style="font-size: 30px;color: orange;"></i>';
		}else if (status == "OK") {
			icon = '<i class="fa fa-check-circle" style="font-size: 30px;color: green;"></i>';
		}
		else if (status == "RUSAK") {
			icon = '<i class="fa fa-times-circle" style="font-size: 30px;color: red;"></i>';
		}

		var row_checked =$("tbody").find("[data-checked='"+ EPC +"']");
		// debugger;
		$(row_checked).html('');
        $(icon).appendTo(row_checked);
	});


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
		var id=$(val).prevAll()[0].value;
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
			hitungBerat();
		}
	}
	
	function pilih(val){
		$.get('<?= base_url()?>linenkotor/get', { id: val }, function(data){ 
				
				$("#no_transaksi").val(data['data']['NO_TRANSAKSI']);
				$("#tanggal").val(data['data']['TANGGAL']);
				$("#kategori").val(data['data']['KATEGORI']);
				// $("#origin").text(data['data_routing']['kec_pengirim'] + ' - ' + data['data_routing']['kota_pengirim']);
				$("#pic").val(data['data']['PIC']);
				$("#total_qty").val(data['data']['TOTAL_QTY']);
				$("#total_berat").val(data['data']['TOTAL_BERAT']);

				$('#total-row').val(data['data_detail'].length);
				$("#ViewTableBrg tbody").empty();
				const tbody = $("#ViewTableBrg tbody");
				var baris;
				// tbody.html('');
				$.each(data['data_detail'], function(_, obj) {
				    var nomor = $('#tbody-table tr:nth-last-child(1) td:first-child').html();
					if( $.isNumeric( nomor ) ) 	{
						nomor = parseInt(nomor) + 1;
					}else{		
						nomor = 1
					}

					$('#total-row').val(nomor);
					$(".no-data").remove();
					baris = '<tr>';
					baris += '<td style="width:1%">'+ nomor+'</td>';
					baris += '<td width="200"><input type="hidden" name="id_detail'+ nomor +'" id="id_detail'+ nomor +'" class="form-control" value="' + obj.id+'" /><a href="javascript:void(0)" id="cari'+ nomor +'" class="btn hor-grd btn-success" onclick="cari_dealer(this)"><i class="fa fa-search"></i>&nbsp; Cari</a><a href="javascript:void(0)" class="btn hor-grd btn-danger" onclick="cancel(this)"><i class="fa fa-trash"></i>&nbsp; Del</a></td>';
					baris += '<td><input type="text" name="epc'+ nomor +'" id="epc'+ nomor +'" class="form-control" value="' + obj.epc+'" readonly /></td>';
					baris += '<td><input type="text" name="jenis'+ nomor +'" id="jenis'+ nomor +'" class="form-control" value="' + obj.jenis+'" readonly/></td>';
					baris += '<td><input type="text" readonly name="ruangan'+ nomor +'" id="ruangan'+ nomor +'" class="form-control" value="' + obj.ruangan+'" /></td>';
					baris += '<td><input type="number" readonly id="berat'+ nomor +'" name="berat'+ nomor +'" placeholder="" class="form-control" value="' + obj.berat+'"></td>';
					baris += '</tr>';
					
					var last = $('#tbody-table tr:last').html();
					if(last== undefined){
						$(baris).appendTo("#tbody-table");
					}else{
						$('#tbody-table tr:last').after(baris);
					}
				});
				$('#modalBrowse').modal('hide');
			
		})
	}

	function hitungBerat(){
	    var berat =  qty = 0;
		$("#tbody-table").find('tr').each(function (i, el) {
	        var $tds = $(this).find('td');
	        if($tds.eq(1).next().children().val() != undefined){
		        var iberat = $tds.eq(4).next().children().val().trim();
		        berat += parseFloat(iberat);

		        qty++;
		    }
		    $("#total_berat").val(berat);
		    $("#total_qty").val(qty);
	    });
	}
</script>