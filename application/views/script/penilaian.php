<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.6/js/plugins/piexif.min.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.6/js/plugins/sortable.min.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.6/js/fileinput.min.js"></script>
<script type="text/javascript">
	

	var app = new Vue({
        el: "#app",
        mounted: function () {
        	var that = this;
	      	// that.loadJQ();
	    },
	    updated: function () {
	    	var that = this;
	    	// that.loadJQ();
	    },
        data: {
        	mode:'new',
        	list_soal:[],
        	history: [],
        	judul_soal: '',
        	section_judul: true,
        	section_isi: false,
        	id_soal:'',
        	tanggal:'',
        	task:'',
        	total_penilaian:'',
        	tgl:''
        },
        methods: {
        	
		    getSoal: function(id, tanggal = ''){
		    	var that = this;
		    	that.list_soal = [];
		    	that.id_soal = id;
		    	var link = '<?= base_url(); ?>pengawasan/soal/'+ id;
		    	if(tanggal !=''){
		    		link += '?tanggal='+ tanggal;
		    	}
		 		$.get(link,null, function(data){
					that.list_soal = data['soal'];
					that.judul_soal = data['deskripsi'];
					that.task = data['task'];
					that.tgl = data['tanggal'];
					that.total_penilaian = data['total_penilaian'];
					that.section_judul = false;
					that.section_isi= true;
					for (let index = 0; index < data['soal'].length; ++index) {
					    const element = that.list_soal[index];
					    that.loadJQ(element['id'], element['tanggal']);
					    if(element['sub'] != undefined){
					    	for (var key in element["sub"]) {
					    		for (var k in element["sub"][key]['data']) {
									that.loadJQ(element["sub"][key]['data'][k]['id'], element["sub"][key]['data'][k]['tanggal']);
									
								}
							}
					    }
					}
				},'json');
		    },
		    kembali: function(event){
		    	var that = this;
		    	event.preventDefault();
		    	that.section_judul = true;
				that.section_isi= false;
				window.location.reload();
		    },
		    submitForm: function(event){
		    	event.preventDefault();
		  // 		var link = '<?= base_url(); ?>pengawasan/save';
		 	// 	$.post(link, $("#frm").serialize() , function(data){
		  // 				$('.file').fileinput('upload'); 
		 	// 		   	Swal.fire({ title: "Berhasil disimpan..!",
			 //             text: "Berhasil tersimpan",
			 //             timer: 2000,
			 //             icon: 'success',
			 //             showConfirmButton: false,
			             
			 //          	});
				// },'json'); 

				$.ajax({
				    type: 'POST',
				    url: '<?= base_url(); ?>pengawasan/savesv',
				    data: $("#frm").serialize() + "&tanggal=" + app.tgl,
				    success:function(data){
				     	Swal.fire({ title: "Berhasil disimpan..!",
			             text: "Berhasil tersimpan",
			             timer: 2000,
			             icon: 'success',
			             showConfirmButton: false,
			             willClose: () => {
			               app.getSoal(app.id_soal,app.tgl);
			             }
			          	});
				    },
				    error: function (data) {
				    	alert(data);
				    } // end of error

				  });
		  		
		    },
		    loadJQ: function(id_soal_detail, tanggal = ''){	
		    	var data_arr = [];
		    	var link = '<?= base_url(); ?>pengawasan/getimagessp/' + id_soal_detail;
		    	if(tanggal !=''){
		    		link += '?tanggal='+ tanggal;
		    	}
		 		$.get(link,null, function(data){
					data_arr= data;
			    	$("#filefoto"+ id_soal_detail).fileinput({
			    		theme: 'fa',
			    		autoReplace: false,
						showCaption: true,
						overwriteInitial: false,
						fileType: "any",
						dropZoneEnabled: false,
						maxFileCount: 5,
						showUpload: false,
						showRemove: false,
						showBrowse: false,
						showClose: false,
						uploadAsync: false,
						initialPreviewAsData: true, 
						initialPreviewDownloadUrl: "<?=base_url()?>upload/pengawasan/{filename}",
					
					    initialPreview: data_arr['caption'],
				        initialPreviewConfig: data_arr['data']
					}).on('filebeforedelete', function() {
						var abort = false;
				        alert('anda tidak diijinkan menghapus file');
				        return abort;
					}).on('filedeleted', function() {
				        setTimeout(function() {
				            alert('File deletion was successful! ' + krajeeGetCount('file-6'));
				        }, 900);
				    });
				},'json');



		    }
        }
    });

    $(document).ready(function() {
    	$('.fc-datepicker').datepicker({
          	showOtherMonths: true,
          	onSelect: function(date) {
            	window.location.href = "<?= base_url() ?>pengawasan/penilaian?tanggal=" + date;
        	},
        });
	});


</script>