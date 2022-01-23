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
        	list_request: [],
        	list_scan: [],
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

	    if($("#mode").val() == 'edit') {
	    	app.mode = 'edit';
	    	$.get('<?= base_url()?>linenkeluar/getDetail', { id: $("#id_keluar").val() }, function(data){ 
	    		$.each(data['request'], function(index, obj) {
	    			app.list_request.push({
	        			jenis: obj.jenis,
	        			qty: obj.qty,
	        			ready: obj.ready
					}); 
	    		})
				$.each(data['data_detail_keluar'], function(index, obj) {
					

					app.list_scan.push({
						id:obj.id,
						serial: obj.epc,
	        			jenis: obj.jenis,
	        			berat: obj.berat,
	        			status: "KIRIM"
					});
					tmbhqty(obj.berat);

					arr_epc.push(obj.epc);
					arr_epc_scan.push(obj.epc);

					if( $("#no_referensi").val() ==""){
						app.list_request=[];
					}
				})
			})
		}
	})

	$('#btnCetak').on('click', function (event) {
		window.open("<?= base_url(); ?>cetak?p=keluar&id=" + $("#id_keluar").val() ,'_blank' );
	})

	$('#ViewTableRequest').DataTable({
		ajax: {		            
	            "url": "<?= base_url(); ?>linenkeluar/dataRequest",
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
    	app.list_scan=[];
    	arr_epc = [];
    	$.each(app.list_request, function(index, obj) {
    		app.list_request[index]['ready'] = 0; 
    	})
    	start = 0;
    	totalqty=0;
    	$("#total_qty").text(totalqty);
    	$("#total_berat").text(0);
		$("#btnScan").text('Start Scan');
		clearInterval(setScan);
		
		$("#status_koneksi").val("Stop scanning...");
		$("#status_koneksi").removeClass("error-text");
    	$("#status_koneksi").removeClass("scan-text");
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
    		doclose();
    		$("#btnScan").html('<i class="fa fa-barcode"></i> Start Scan');
    		$("#status_koneksi").val('Stop scanning...');
    		clearInterval(setScan);
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
		        	alert('Silahkan gunakan browser IE untuk menggunakan fitur ini.');
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
           // $("#status_koneksi").val("Waiting for scanning...");
           // document.getElementById("SnEPC").innerText=sum;
           // alert(sum);
        }else {

	       var EPC_Len=parseInt(sum.substr(0,2),16);
           var EPC=sum.substr(2,EPC_Len*2);
           $("#status_koneksi").val("Get data Serial...("+ EPC +")");

            //Jika exist data di listview
            if(arr_epc.indexOf(EPC) > -1){
           		
           		if(arr_epc_scan.indexOf(EPC) > -1){
           			$("#status_koneksi").val("Waiting for scanning...");
           		}else{
           			arr_epc_scan.push(EPC);
           			arr_epc.push(EPC);
           			$("#status_koneksi").val(EPC + " compare success...");

			        var params = { epc: EPC};
		        	$.get('<?= base_url() ?>linenkotor/getItemScan', params, function(data){ 

		        		var last_status = data.history;
		        		var last = (last_status != null ? last_status.STATUS : 'BARU');
		        		if(data['data_detail'].length == 0){
							app.list_scan.push({
								id:0,
								serial: EPC,
			        			jenis: "-",
			        			berat:0,
			        			status:'-'
							});
							tmbhqty(0);
						}else{
							app.list_scan.push({
								id:0,
								serial: data['data_detail'][0]['serial'],
			        			jenis: data['data_detail'][0]['jenis'],
			        			berat: data['data_detail'][0]['berat'],
			        			status: last
							}); 

							$.each(app.list_request, function(_, obj) {
				        		if(obj.jenis == data['data_detail'][0]['jenis'] && (last == 'BERSIH' || last == 'BARU') ){
				        			app.list_request[index]['ready'] += 1; 
				        		}
				        	})

				        	tmbhqty(data.data_detail[0].berat);
						}
		        		
		        	})
           		}
           	//JIka tidak exist di listview
            }else{
           		// TUHF2000.RFID_Beep(1);
           		arr_epc.push(EPC);
           		arr_epc_scan.push(EPC);
	        	var params = { epc: EPC};
	        	$.get('<?= base_url() ?>linenkotor/getItemScan', params, function(data){ 
		            if(data.status == 'success'){
		            	
						var last_status = data.history;
						var last = (last_status != null ? last_status.STATUS : 'BARU');

						if(data['data_detail'].length == 0){
							app.list_scan.push({
								id:0,
								serial: EPC,
			        			jenis: "-",
			        			berat:0,
			        			status:'-'
							});
							tmbhqty(0);
						}else{
							app.list_scan.push({
								id:0,
								serial: EPC,
			        			jenis: data['data_detail'][0]['jenis'],
			        			berat: data['data_detail'][0]['berat'],
			        			status: (last_status != null ? last_status.STATUS : 'BARU')
							}); 

							$.each(app.list_request, function(index, obj) {
				        		if(obj.jenis == data['data_detail'][0]['jenis'] && (last == 'BERSIH' || last == 'BARU')){
				        			app.list_request[index]['ready'] += 1; 
				        		}
				        	})
				        	tmbhqty(data.data_detail[0].berat);
						}

						
						
						
		            }
		    	})
            }
        }

        // doclose();
    }
    function tmbhqty(val){
    	totalqty = parseInt($("#total_qty").text());
   		totalqty++;
   		$("#total_qty").text(totalqty);

    	totalberat = parseFloat($("#total_berat").text());
    	totalberat += parseFloat(val);
    	$("#total_berat").text(totalberat);
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
   	
   	

    $('#btnSave').on('click', function (event) {
    	event.preventDefault();
    	doclose();
		var valid = false;
    	var sParam = $('#form-keluar').serialize() + "&scan=" + JSON.stringify(app.list_scan) + "&request=" + JSON.stringify(app.list_request);
    	var validator = $('#form-keluar').validate({
							rules: {
									no_transaksi: {
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
			 		var link = '<?= base_url(); ?>linenkeluar/Save';
			 		$.post(link,sParam, function(data){
						if(data.error==false){	
							alert('Data Sukses Tersimpan');
							window.location.href = '<?= base_url(); ?>linenkeluar';
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
    	

    	if(app.list_scan.length==0){
    		flag = false;
    		finderr('Belum ada data linen di scan.!');
    	}else{
    		$.each(app.list_scan, function(index, obj) {
    			if(obj.status != 'BERSIH' && obj.status != 'BARU' && obj.status == 'KIRIM'){
    				flag = false;
    				alert(obj.jenis + '-(' + obj.serial + ') tidak valid.!');
    				finderr(obj.jenis + '-(' + obj.serial + ') tidak valid.!');
    			}else if (obj.status == 'RUSAK') {
    				flag = false;
    				alert(obj.jenis + '-(' + obj.serial + ') tidak valid.!');
    				finderr(obj.jenis + '-(' + obj.serial + ') tidak valid.!');
    			}
    		})
    	}

    	var ada_qty = false;
    	$.each(app.list_request, function(index, obj) {
    		if(obj.ready > 0 ){
    			ada_qty=true;		
    		}else if(obj.ready == 0 && !ada_qty){
    			flag = false;
    			finderr('Qty Ready ' + obj.jenis + ' harus lebih > 0');
    		}else if(obj.ready > obj.qty){
    			flag = false;
    			finderr('Qty Ready tidak boleh lebih > Qty');
    		}
    		
    		
    	})

    	if(app.list_request.length > 0){
	    	$.each(app.list_scan, function(i, obi) {
	    		var exist = app.list_request.filter(function (person) { return person.jenis ==  obi.jenis });
	    		if(exist.length == 0){
	    			flag = false;
					finderr(obi.jenis + '-(' + obi.serial + ') tidak ada dalam daftar request.!');
	    		}
			})
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

    function finderr(txt){

		$("#status_koneksi").removeClass("scan-text");
		$("#status_koneksi").addClass("error-text");
		$("#status_koneksi").val(txt);
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
		$.get('<?= base_url()?>linenkeluar/get', { id: val }, function(data){ 
				
				$("#no_referensi").val(data['data']['no_request']);
				$("#ruangan").val(data['data']['ruangan']);
				app.list_request=[];
				$.each(data['data_detail'], function(_, obj) {
					var ready = 0;

					$.each(app.list_scan, function(index, obi) {
		        		if(obi.jenis == obj.jenis){
		        			ready += 1; 
		        		}
		        	})

		        	app.list_request.push({
						id_detail: obj.id,
	        			no_request:obj.no_request,
	        			jenis: obj.jenis,
	        			qty: obj.qty - obj.qty_keluar,
	        			ready: ready
					}); 
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