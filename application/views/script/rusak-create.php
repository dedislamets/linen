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
	    	$.get('<?= base_url()?>linenrusak/getDetail', { id: $("#id_keluar").val() }, function(data){ 
				$.each(data['data_detail_rusak'], function(index, obj) {

					app.list_scan.push({
						id:obj.id,
						serial: obj.epc,
	        			jenis: obj.jenis,
	        			berat: obj.berat,
	        			jml_cuci:0
					});
					tmbhqty();

					arr_epc.push(obj.epc);
					arr_epc_scan.push(obj.epc);

				})
			})
		}
	})

	
    $("#btnCariBarang").on('click', function (event) {
    	$('#modalBarang').modal({backdrop: 'static', keyboard: false}) ;
    });

    $("#btnStop").on('click', function(e) {
    	e.preventDefault();
    	app.list_scan=[];
    	arr_epc = [];
    	start = 0;
    	totalqty=0;
    	$("#total_qty").val(totalqty);
		$("#btnScan").text('Start Scan');
		clearInterval(setScan);
		doclose();
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
    		start =1;
    		$("#btnScan").html('<i class="fa fa-stop"></i> Stop Scan');
    		setScan = setInterval(function(){ 
	    		scanning();
	    	}, 500);
    	}else{
    		start = 0;
    		$("#btnScan").html('<i class="fa fa-barcode"></i> Start Scan');
    		$("#status_koneksi").val('Stop scanning...');
    		clearInterval(setScan);
    		return;
    	}
        
    })

    function scanning(){
    	var session = 255;
	    var QValue = 4;
	    var scantid=0;
	    var anteana = 128;
	    var t=128;
       	
       	var Port = 9;
        var Baud=5;

        var konek = TUHF2000.RFID_ComOpen(Port,Baud);
        if(konek == 0){
        	$("#status_koneksi").val("Tersambung...");
        }else{
        	$("#status_koneksi").val("Terputus...(Copot kabel usb dan pasang kembali untuk mengulangi scan!)");
        }
    	var sum = TUHF2000.RFID_Inventory(QValue,session,scantid,anteana,0,10); 
        if(sum=="") 
        {	 	
           $("#status_koneksi").val("Waiting for scanning...");
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

			        var params = { epc: EPC};
		        	$.get('<?= base_url() ?>linenkotor/getItemScan', params, function(data){ 
		        		var last_status = data.history;
		        		var jml_cuci = data.jml_cuci;
		        		var last = (last_status != null ? last_status.STATUS : 'BARU');
		        		if(data['data_detail'].length == 0){
							app.list_scan.push({
								id:0,
								serial: EPC,
			        			jenis: "-",
			        			berat:0,
			        			status:'-',
			        			jml_cuci:0
							});
							tmbhqty();
						}else{
							app.list_scan.push({
								id:0,
								serial: data['data_detail'][0]['serial'],
			        			jenis: data['data_detail'][0]['jenis'],
			        			berat: data['data_detail'][0]['berat'],
			        			status: last,
			        			jml_cuci:jml_cuci
							}); 

				        	tmbhqty();
						}
		        		
		        	})
           		}

           	//JIka tidak exist di listview
            }else{
            	

           		TUHF2000.RFID_Beep(1);
           		arr_epc.push(EPC);
	        	var params = { epc: EPC};
	        	$.get('<?= base_url() ?>linenkotor/getItemScan', params, function(data){ 
		            if(data.status == 'success'){
		            	
						var last_status = data.history;
						var jml_cuci = data.jml_cuci;
						var last = (last_status != null ? last_status.STATUS : 'BARU');

						if(data['data_detail'].length == 0){
							app.list_scan.push({
								id:0,
								serial: EPC,
			        			jenis: "-",
			        			berat:0,
			        			status:'-',
			        			jml_cuci:0
							});
							tmbhqty(0);
						}else{
							app.list_scan.push({
								id:0,
								serial: EPC,
			        			jenis: data['data_detail'][0]['jenis'],
			        			berat: data['data_detail'][0]['berat'],
			        			status: (last_status != null ? last_status.STATUS : 'BARU'),
			        			jml_cuci: jml_cuci
							}); 

				        	tmbhqty();
						}

						
						
						arr_epc_scan.push(EPC);
		            }
		    	})
           }
        }

        doclose();
    }
    function tmbhqty(){
    	totalqty = parseInt($("#total_qty").val());
   		totalqty++;
   		$("#total_qty").val(totalqty);
    }

    function doclose() 
    { 
        var sum = TUHF2000.RFID_ComClose(); 	
        // if(sum==0) 	$("#status_koneksi").val("Terputus...");
    } 

    $('#btnBrowse').on('click', function (event) {
    	$('#modalBrowse').modal({backdrop: 'static', keyboard: false}) ;
    });

    $('#btnSave').on('click', function (event) {
    	event.preventDefault();
		var valid = false;
    	var sParam = $('#form-rusak').serialize() + "&scan=" + JSON.stringify(app.list_scan) + "&request=" + JSON.stringify(app.list_request);
    	var validator = $('#form-rusak').validate({
							rules: {
									no_transaksi: {
							  			required: true
									},
									tanggal: {
							  			required: true
									},
									catatan: {
							  			required: true
									},
								}
							});
	 	validator.valid();
	 	$status = validator.form();
	 	if($status) {
	 		if(validateBarang()){
	 			if (confirm("Lanjutkan menyimpan data?")) {
			 		var link = '<?= base_url(); ?>listrusak/Save';
			 		$.post(link,sParam, function(data){
						if(data.error==false){	
							alert('Data Sukses Tersimpan');
							window.location.href = '<?= base_url(); ?>listrusak';
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
    			if(obj.status == 'RUSAK' ){
    				flag = false;
    				alert(obj.jenis + '-(' + obj.serial + ') sudah berstatus rusak sebelumnya.!');
    				finderr(obj.jenis + '-(' + obj.serial + ') sudah berstatus rusak sebelumnya.!');
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