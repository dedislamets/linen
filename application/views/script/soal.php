
<script type="text/javascript">
	
	var app = new Vue({
        el: "#app",
        mounted: function () {
        	var that = this;
        	if(that.mode == 'edit'){
	      		that.getSoal(that.id_soal);
        	}
	    },
	    updated: function () {
	    	// var that = this;
	    	// that.loadJQ();
	    },
        data: {
        	mode:'<?= $mode ?>',
        	list_soal:[],
        	history: [],
        	judul_soal: '',
        	section_judul: true,
        	section_isi: false,
        	id_soal:'<?= empty($soal) ? "" : $soal->id ?>',
        	tanggal:'',
        	task:'',
        	total_skor: 0
        },
        methods: {
        	
		    getSoal: function(id){
		    	var that = this;
		    	that.list_soal = [];
		    	that.id_soal = id;
		    	var link = '<?= base_url(); ?>pengawasan/soal/'+ id;
		 		$.get(link,{ f: '1'}, function(data){
					that.list_soal = data['soal'];
					that.judul_soal = data['deskripsi'];
					that.task = data['task'];
					that.total_skor = data['total_skor'];
					that.section_judul = false;
					that.section_isi= true;
					for (let index = 0; index < data['soal'].length; ++index) {
					    const element = that.list_soal[index];
					    // that.loadJQ(element['id'], index+1);
					}
				},'json');
		    },
		    addModal: function(event){
		    	event.preventDefault();
		    	app.mode = 'new';
				$("#soal").val('');
				$("#bobot").val(0);

				$("#nilai_max").val(0);
				$("#skor_max").val(0);
				$("#keterangan").val('');
				$("#title_sub_baru").val('');

				$("#id_soal_detail").val('');
				$("#id_judul").val(app.id_soal);
		    	$('#ModalAdd').modal({backdrop: 'static', keyboard: false}) ;
		    },
		    editModal: function(event,id){
		    	event.preventDefault();
		    	app.mode = 'edit';
				$("#id_judul").val(app.id_soal);
				$.get('<?= base_url()?>soal/getedit/' +  id, { }, function(data){ 
	
					$("#lbl-title").text("Edit");
	         		$("#soal").val(data['parent'][0]['soal']);
					$("#bobot").val(data['parent'][0]['bobot']);

					$("#nilai_max").val(data['parent'][0]['nilai_max']);
					$("#skor_max").val(data['parent'][0]['skor_max']);
					$("#keterangan").val(data['parent'][0]['keterangan']);
					$("#id_soal_detail").val(data['parent'][0]['id']);
					$("#id_judul").val(data['parent'][0]['id_judul']);

					$("#parent_id").val(data['parent'][0]['parent_id']);
					$("#title_sub").val(data['parent'][0]['title_sub']);

					if(data['parent'][0]['punya_sub'] == 1){
						$("#punya_sub").prop('checked', true);
					}else{
						$("#punya_sub").removeAttr("checked");
					}
	           
	        	});
		    	$('#ModalAdd').modal({backdrop: 'static', keyboard: false}) ;
		    },
		    kembali: function(event){
		    	var that = this;
		    	event.preventDefault();
		    	that.section_judul = true;
				that.section_isi= false;
				window.location.reload();
		    }
		    
        }
    });

    $(document).ready(function() {
    	$("#punya_sub").change(function() {
		    if(this.checked) {
		    	$("#info-sub").css('display','block');
		    }
		    else{
		    	$("#info-sub").css('display','none');
		    }
		});

		$('#btnSubmit').on('click', function (e) {
			var valid = false;
	    	var sParam = $('#Form').serialize();
	    	var validator = $('#Form').validate({
								rules: {
										soal: {
								  			required: true
										},
									}
								});
		 	validator.valid();
		 	$status = validator.form();
		 	if($status) {
		 		var link = '<?= base_url() ?>soal/Save';
		 		$.post(link,sParam, function(data){
					if(data.error==false){									
						window.location.reload();
					}else{	
						$("#lblMessage").remove();
						$("<div id='lblMessage' class='alert alert-danger' style='display: inline-block;float: left;width: 68%;padding: 10px;text-align: left;'><strong><i class='ace-icon fa fa-times'></i> "+data.msg+"!</strong></div>").appendTo(".modal-footer");
												  					  	
					}
				},'json');
		 	}
	        
	    });

	    $('#btn-finish').on('click', function (e) {
			var valid = false;
	    	var sParam = $('#form-soal').serialize();
	    	var validator = $('#form-soal').validate({
								rules: {
										judul: {
								  			required: true
										},
										deskripsi : {
											required: true
										}
									}
								});
		 	validator.valid();
		 	$status = validator.form();
		 	if($status) {
		 		var link = '<?= base_url() ?>soal/submit';
		 		$.post(link,sParam, function(data){
					if(data.error==false){									
						if(app.mode == 'edit'){
							window.location.reload();
						}else{
							window.location.href = '<?= base_url()?>soal';
						}	
					}else{	
						alert('ada error');
												  					  	
					}
				},'json');
		 	}
	        
	    });

	    
	});

    $('#btnDelete').on('click', function (e) {
    	var r = confirm("Yakin dihapus?");
		if (r == true) {
			$.get('<?= base_url() ?>soal/delete_komponen/' + $("#id_soal_detail").val(), { }, function(data){ 
				window.location.reload();
			})
		
		}
    });

</script>