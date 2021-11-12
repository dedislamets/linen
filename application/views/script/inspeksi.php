<script type="text/javascript">
	
	var app = new Vue({
        el: "#app",
        mounted: function () {
        	var that = this;
	      	that.loadJQ();
	    },
	    updated: function () {
	    	var that = this;
	    	that.loadJQ();
	    },
        data: {
        	mode:'new',
        	list_soal:[],
        	history: [],
        	judul_soal: ''
        },
        methods: {
        	
		    getSoal: function(id){
		    	var that = this;
		    	that.list_soal = [];
		    	var link = '<?= base_url(); ?>pengawasan/soal/'+ id;
		 		$.get(link,null, function(data){
					that.list_soal = data['soal'];
					that.judul_soal = data['deskripsi'];
				},'json');
		    },
		    loadJQ: function(event){
		    	// $("#accordion").accordion({ collapsible: true, active: false });

		    	$(".file").fileinput({
		    		theme: 'fa',
		    		autoReplace: false,
					showCaption: true,
					overwriteInitial: false,
					fileType: "any",
					dropZoneEnabled: false,
					showUpload: false,
					uploadUrl: "/file-upload-batch/2",
				 //    previewFileIcon: '<i class="fa fa-file"></i>',
				 //    layoutTemplates: {
				 //          actions: '<div class="file-actions">\n' +
				 //                  '    <div class="file-footer-buttons" style="float:none">\n' +
				 //                  '        {upload}{delete}{other}' +
				 //                  '    </div>\n' +
				 //                  '</div>',
				 //          actionDelete: '<button type="button" class="kv-file-remove btn btn-danger btn-block" {dataUrl}{dataKey}><i class="fa fa-trash-o"></i> Delete</button>',
				 //          actionUpload: '',
				 //      },
				 //    previewTemplates: {
				 //          image: '<div class="file-preview-frame" id="{previewId}" data-fileindex="{fileindex}">\n' +
				 //                  '   <img src="{data}" class="file-preview-image" title="{caption}" alt="{caption}" style="width: 200px;height: 113px;">\n' +
				 //                  '   {footer}\n' +
				 //                  '</div>\n',
				 //      },
				 //    uploadExtraData : function (previewId, index) {
					// 	    var obj = {};
					// 	    $('#form-id').find('input,select').each(function() {
					// 	        var id = $(this).attr('name'), val = $(this).val();
					// 	        obj[id] = val;
					// 	    });
					// 	    return obj;
				 //    }
				});
		    }
        }
    });

    $(document).ready(function() {
    	

		$('#frm').submit(function(event) {
		  event.preventDefault();
		  $('.file').fileinput('upload');  
		});
	});


</script>