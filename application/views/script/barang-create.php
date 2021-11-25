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

	$(document).ready(function(){  
		$("#tanggal" ).datepicker();
	})

    $("#btnStop").on('click', function(e) {
    	e.preventDefault();
    	doclose();
    	app.list_scan=[];
    	app.list_request=[];
    	arr_epc = [];

    	start = 0;
		$("#btnScan").text('Start Scan');
		clearInterval(setScan);
		
		$("#status_koneksi").val("Stop scanning...");
		$("#status_koneksi").removeClass("error-text");
    	$("#status_koneksi").removeClass("scan-text");
    })

    $("#btnScan").on('click', function(e) {
    	e.preventDefault();
    	doclose();
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
           			// TUHF2000.RFID_Beep(0);
           			$("#status_koneksi").val("Waiting for scanning...");
           		}else{
           			// TUHF2000.RFID_Beep(1);
           			arr_epc_scan.push(ECP);
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
			        			status:'-'
							});
						}else{
							app.list_scan.push({
								id:0,
								serial: data['data_detail'][0]['serial'],
			        			jenis: data['data_detail'][0]['jenis'],
			        			status: last
							}); 
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
			        			status:'-'
							});
						}else{
							app.list_scan.push({
								id:0,
								serial: EPC,
			        			jenis: data['data_detail'][0]['jenis'],
			        			status: (last_status != null ? last_status.STATUS : 'BARU')
							}); 

						}

						
						
						
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
    	var sParam = $('#form-barang').serialize() + "&scan=" + JSON.stringify(app.list_scan) ;
    	var validator = $('#form-barang').validate({
							rules: {
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
			 		var link = '<?= base_url(); ?>Barang/Save';
			 		$.post(link,sParam, function(data){
						if(data.error==false){	
							alert('Data Sukses Tersimpan');
							window.location.href = '<?= base_url(); ?>barang';
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
    			if(obj.status != '-' ){
    				flag = false;
    				alert(obj.jenis + '-(' + obj.serial + ') tidak valid.!');
    				finderr(obj.jenis + '-(' + obj.serial + ') tidak valid.!');
    			}
    		})
    	}

    	return flag;
    }

    function finderr(txt){

		$("#status_koneksi").removeClass("scan-text");
		$("#status_koneksi").addClass("error-text");
		$("#status_koneksi").val(txt);
    }

</script>