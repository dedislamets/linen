<!-- <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.6/js/plugins/piexif.min.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.6/js/plugins/sortable.min.js" type="text/javascript"></script> -->
<!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.6/js/fileinput.min.js"></script> -->
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.2/js/plugins/buffer.min.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.2/js/plugins/filetype.min.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.2/js/plugins/piexif.min.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.2/js/plugins/sortable.min.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.2/js/fileinput.min.js"></script>
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
        	id_ruangan:'0',
        	nama_ruangan: '',
        	tanggal:'',
        	task:'',
        	total_penilaian:'',
        	disabled : false
        },
        methods: {
        	
		    getSoal: function(id, tgl, ruangan){
		    	var that = this;
		    	that.list_soal = [];
		    	that.id_soal = id;
		    	var link = '<?= base_url(); ?>pengawasan/soal/'+ id;
		 		$.get(link,{tanggal: tgl, ruangan: ruangan }, function(data){
					that.list_soal = data['soal'];
					that.judul_soal = data['deskripsi'];
					that.nama_ruangan = data['nama_ruangan'];
					that.task = data['task'];
					that.total_penilaian = data['total_penilaian'];
					that.section_judul = false;
					that.section_isi= true;
					for (let index = 0; index < data['soal'].length; ++index) {
					    const element = that.list_soal[index];
					    that.loadJQ(element['id'], tgl, ruangan, element['id_inspeksi']);
					    if(element['sub'] != undefined){
					    	for (var key in element["sub"]) {
					    		for (var k in element["sub"][key]['data']) {
									that.loadJQ(element["sub"][key]['data'][k]['id'], tgl, ruangan, element["sub"][key]['data'][k]['id_inspeksi']);
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
				window.location.href = "<?= base_url(); ?>pengawasan";
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
				//$('.file').fileinput('upload'); 
				$.ajax({
				    type: 'POST',
				    url: '<?= base_url(); ?>pengawasan/save',
				    data: $("#frm").serialize() ,
				    success:function(data){
				    	
				     	Swal.fire({ title: "Berhasil disimpan..!",
			             text: "Berhasil tersimpan",
			             timer: 4000,
			             icon: 'success',
			             showConfirmButton: false,
			             willClose: () => {
			               app.getSoal(app.id_soal, app.tanggal, app.id_ruangan);
			             }
			          	});
				    },
				    error: function (data) {
				    	alert(data);
				    } // end of error

				  });
		  		
		    },
		    loadJQ: function(id_soal_detail, tgl, ruangan, id_inspeksi){	
		    	var that = this;
		    	var data_arr = [];
		    	var link = '<?= base_url(); ?>pengawasan/getimages/' + id_inspeksi;
		 		$.get(link,{tanggal: tgl, ruangan: ruangan}, function(data){
					data_arr= data;
					var role = "<?= $this->session->userdata('role') ?>";
					that.disabled = (role == 'Pengawas') ? true : false;
			    	$("#filefoto"+ id_soal_detail).fileinput({
			    		theme: 'fa',
			    		autoReplace: false,
						showCaption: true,
						overwriteInitial: false,
						fileType: "any",
						dropZoneEnabled: false,
						maxFileCount: 5,
						showUpload: that.disabled ,
						showBrowse:  that.disabled,
						showRemove: false,
						uploadUrl: "<?=base_url()?>pengawasan/upload",
						uploadAsync: true,
						initialPreviewAsData: true, 
						initialPreviewDownloadUrl: "<?=base_url()?>upload/pengawasan/{filename}",
						// previewFileIconSettings: { // configure your icon file extensions
					 //        'doc': '<i class="fa fa-file-word text-primary"></i>',
					 //        'xls': '<i class="fa fa-file-excel text-success"></i>',
					 //    },
						// previewFileExtSettings: { // configure the logic for determining icon file extensions
					 //        'doc': function(ext) {
					 //            return ext.match(/(doc|docx)$/i);
					 //        },
					 //        'xls': function(ext) {
					 //            return ext.match(/(xls|xlsx)$/i);
					 //        },
					 //    },
					    uploadExtraData : function (previewId, index) {
						    return {
					            id_soal: app.id_soal,
					            id_soal_detail: id_soal_detail,
					            tanggal: app.tanggal,
					            ruangan: app.id_ruangan
					        };
					    },
					    deleteExtraData : function (previewId, index) {
						    return {
					            id_soal: app.id_soal,
					            id_soal_detail: id_soal_detail
					        };
					    },
					    initialPreview: data_arr['caption'],
				        initialPreviewConfig: data_arr['data']
					}).on('filebeforedelete', function() {
						var abort = true;
				        if (confirm("Are you sure you want to delete this image?")) {
				            abort = false;
				        }
				        return abort;
					}).on('filedeleted', function() {
				        setTimeout(function() {
				            alert('File deletion was successful! ' + krajeeGetCount('file-6'));
				        }, 900);
				    }).on("filebatchselected", function(event, files) {
					    $("#filefoto"+ id_soal_detail).fileinput("upload");
					});
				},'json');

		    }
        }
    });

    $(document).ready(function() {
    	const urlParams = new URLSearchParams(window.location.search);
		const param_tgl = urlParams.get('tanggal');
		const param_soal = urlParams.get('soal');
		const param_ruangan = urlParams.get('ruangan');

		if(param_soal != null){
			app.getSoal(param_soal, param_tgl, param_ruangan);
			app.tanggal = param_tgl;
			app.id_ruangan = param_ruangan;
			app.mode = "edit";
		}else{
			var now = new Date();
			app.tanggal = moment(now).format('YYYY-MM-DD');
			app.mode = "new";
		}
	});


</script>