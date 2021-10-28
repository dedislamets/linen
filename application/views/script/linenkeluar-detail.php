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
		var sig = $('#sig').signature({syncField: '#signature64', syncFormat: 'PNG'});
	    $('#clear').click(function(e) {
	        e.preventDefault();
	        sig.signature('clear');
	        $("#signature64").val('');
	    });
	    
	    if($("#mode").val() == 'edit') {
	    	app.mode = 'edit';
	    	$.get('<?= base_url()?>linenkeluar/getDetail', { id: $("#id_keluar").val() }, function(data){ 
				$.each(data['data_detail_keluar'], function(index, obj) {
					app.list_request.push({
						id_detail: obj.id_request,
	        			no_request:obj.no_transaksi,
	        			jenis: obj.jenis,
	        			epc: obj.epc,
	        			qty: obj.qty,
	        			ready: obj.ready
					}); 

					app.list_scan.push({
						id:obj.id,
						serial: obj.epc,
	        			jenis: obj.jenis,
	        			berat: obj.berat,
	        			status: "KIRIM"
					});
					// tmbhqty(obj.berat);

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


    $('#btnBrowse').on('click', function (event) {
    	$('#modalBrowse').modal({backdrop: 'static', keyboard: false}) ;
    });
   	

  //   $('#btnSave').on('click', function (event) {
  //   	event.preventDefault();
		// var valid = false;
  //   	var sParam = $('#form-keluar').serialize() + "&scan=" + JSON.stringify(app.list_scan) + "&request=" + JSON.stringify(app.list_request);
  //   	var validator = $('#form-keluar').validate({
		// 					rules: {
		// 							no_transaksi: {
		// 					  			required: true
		// 							},
		// 							tanggal: {
		// 					  			required: true
		// 							},
		// 						}
		// 					});
	 // 	validator.valid();
	 // 	$status = validator.form();
	 // 	if($status) {
	 // 		if(validateBarang()){
	 // 			if (confirm("Lanjutkan menyimpan data?")) {
		// 	 		var link = '<?= base_url(); ?>linenkeluar/Save';
		// 	 		$.post(link,sParam, function(data){
		// 				if(data.error==false){	
		// 					alert('Data Sukses Tersimpan');
		// 					window.location.href = '<?= base_url(); ?>linenkeluar';
		// 				}else{	
		// 					alertError(data.message);				  	
		// 				}
		// 			},'json');
		// 		} 
		//  	}
	 // 	}
        
  //   });


	function validateBarang(){
    	var flag = true;
    	if(app.list_scan.length==0){
    		flag = false;
    		finderr('Belum ada data linen di scan.!');
    	}else{
    		$.each(app.list_scan, function(index, obj) {
    			if(obj.status != 'BERSIH' && obj.status != 'BARU' && obj.status != 'KIRIM'){
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

    
</script>