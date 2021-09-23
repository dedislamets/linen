<script type="text/javascript">
	var app = new Vue({
	    el: "#app",
	    mounted: function () {
	      // this.loadHistory();
	      
	    },
	    updated: function () {
	    	
	    },
	    data: {
	      history: [],
	      alamat:'',
	      totalrow: 1
	    },
	    methods: {
	    	// loadHistory: function () {
		    //     var that = this;

		    //     jQuery.ajax({
		    //       type: "GET",
		    //       cache:false,
		    //       url: '<?= base_url() ?>customer/edit',
		    //       data: {id: $("#id").val()},
		    //       success: function(response) {          
		    //           	that.history = response['child'];
		    //           	that.totalrow = response['total'];
		    //           	that.alamat= response['parent'][0]['cust_address']
		    //       },
		    //     });
		    // },

	    }
	})
	var elemsingle = document.querySelector('.js-single');
	var switchery = new Switchery(elemsingle, { color: '#4680ff', jackColor: '#fff' });

	$(document).ready(function(){  
		
		$('#ViewTable').DataTable({
			dom: 'frtip',
			ajax: {		            
	            "url": "users/dataTable",
	            "type": "GET"
	        },
	        processing	: true,
			serverSide	: true,			
			"bPaginate": true,	
			// "ordering": false,
			"autoWidth": true,
			// "order": [[ 4, "desc" ]],
			
	    });

	})

	function changeSwitchery(element, checked) {
	  if ( ( element.is(':checked') && checked == false ) || ( !element.is(':checked') && checked == true ) ) {
	    element.parent().find('.switchery').trigger('click');
	  }
	}

	function editmodal(val){

		$.get('users/edit', { id: $(val).data('id') }, function(data){ 
				$("#lbl-title").text("Edit");
         		$("#nama_user").val(data['parent'][0]['nama_user']);
				$("#email").val(data['parent'][0]['email']);

				$("#department").val(data['parent'][0]['department']);
				$("#cabang").val(data['parent'][0]['cabang']);
				$("#jenis_kelamin").val(data['parent'][0]['jenis_kelamin']);

				$("#password").val('');
				$("#id_role").val(data['parent'][0]['id_role']);
				if(data['parent'][0]['status'] == 0){
					changeSwitchery($('#status'), false);
				}else{
					changeSwitchery($('#status'), true);
				}
				$("#id").val(data['parent'][0]['id_user']);

           		$('#ModalAdd').modal({backdrop: 'static', keyboard: false}) ;
           
        });

	}

	$('#btnAdd').on('click', function (event) {
		$("#lbl-title").text('Tambah');
		$("#nama_user").val('');
		$("#email").val('');
		$("#password").val('');
		
		$("#id").val('');

		$('#ModalAdd').modal({backdrop: 'static', keyboard: false}) ;
	});
	$('#btnSubmit').on('click', function (e) {
		var valid = false;
    	var sParam = $('#Form').serialize();
    	var validator = $('#Form').validate({
							rules: {
									nama_user: {
							  			required: true
									},
									email: {
							  			required: true
									},
									
								}
							});
	 	validator.valid();
	 	$status = validator.form();
	 	if($status) {
	 		var link = 'users/Save';
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

	function hapus(val) {
		var r = confirm("Yakin dihapus?");
		if (r == true) {
			
			$.get('users/delete', { id: $(val).data('id') }, function(data){ 
				window.location.reload();
			})
		
		}
	}

	
</script>
