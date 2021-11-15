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
	      show: false,
	      mode : 'new',
	      totalrow: 1,
	      id_atasan: '',
	      myTable2: '',
	      myTable:''
	    },
	    methods: {
	    	loadData: function(id){
		    	var that = this;

		    }
	    }
	})
	

	$(document).ready(function(){  
		var modal_lv = 0;
		$('.modal').on('shown.bs.modal', function (e) {
		    $('.modal-backdrop:last').css('zIndex',1051+modal_lv);
		    $(e.currentTarget).css('zIndex',1052+modal_lv);
		    modal_lv++
		});

		$('.modal').on('hidden.bs.modal', function (e) {
		    modal_lv--
		});
		$(document).on('hidden.bs.modal', function (event) {
		  
		})

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
			
	    });

	    $('#btnAdd').on('click', function (event) {
	    	app.mode = 'new';
			$("#lbl-title").text('Tambah');
			$("#nama_user").val('');
			$("#email").val('');
			$("#password").val('');
			$("#status").prop('checked', false);
			$("#data-bawahan").css('display','none');

			$("#id").val('');

			$('#ModalAdd').modal({ keyboard: false}) ;
		});

	})

	$("#ada_bawahan").change(function() {
	    if(this.checked && app.mode == 'edit') {
	    	$("#data-bawahan").css('display','block');
	    }
	    else{
	    	$("#data-bawahan").css('display','none');
	    }
	});

	function editmodal(val){

		$.get('users/edit', { id: $(val).data('id') }, function(data){ 
				app.id_atasan = $(val).data('id');
				app.mode = 'edit';
				$("#lbl-title").text("Edit");
         		$("#nama_user").val(data['parent'][0]['nama_user']);
				$("#email").val(data['parent'][0]['email']);

				$("#department").val(data['parent'][0]['department']);
				$("#jenis_kelamin").val(data['parent'][0]['jenis_kelamin']);

				$("#password").val('');
				$("#id_role").val(data['parent'][0]['id_role']);

				if(data['parent'][0]['status'] == 1){
					$("#status").prop('checked', true);
				}else{
					$("#status").removeAttr("checked");
				}

				if(data['parent'][0]['ada_bawahan'] == 1){
					$("#ada_bawahan").prop('checked', true);
					$("#data-bawahan").css('display','block');
				}else{
					$("#ada_bawahan").removeAttr("checked");
					$("#data-bawahan").css('display','none');
				}

				$("#id").val(data['parent'][0]['id_user']);

				app.myTable = $('#ViewTableUser').DataTable({
					dom: 'frtip',
					ajax: {		            
			            "url": "users/dataTableModalBahawan?id=" + $(val).data('id'),
			            "type": "GET"
			        },
			        processing	: true,
					serverSide	: true,			
					"bPaginate": true,	
					"autoWidth": true,
					"destroy": true,
		            
			    });

				app.myTable2 = $('#ModalTableUser').DataTable({
					dom: 'frtip',
					ajax: {		            
			            "url": "users/dataTableModal",
			            "type": "GET"
			        },
			        processing	: true,
					serverSide	: true,			
					"bPaginate": true,	
					"autoWidth": true,
					"destroy": true,
		            
			    });

           		$('#ModalAdd').modal({backdrop: 'static', keyboard: false}) ;
           
        });

	}

	function removeRole(val) {
		var r = confirm("Yakin dihapus?");
		if (r == true) {
			
			$.post('users/delete_bawahan', { id: $(val).data('id') }, function(data){ 
				app.myTable.ajax.url("users/dataTableModalBahawan?id=" + app.id_atasan).load();
			})
		
		}
	}

	$('#btnpilih').on('click', function (event) {

        var checked_courses = $('#ModalTableUser').find('input[name="selected_courses[]"]:checked').length;
        if (checked_courses != 0) {
            CheckedTrue();
            
        } else {
            alert("Silahkan pilih terlebih dahulu");
        }

    });

    function CheckedTrue() {
        var b = $("#txtSelected");
        b.val('');
        var str = "";
        var rowcollection = app.myTable2.$(':checkbox', { "page": "all" });
        rowcollection.each(function () {
            if (this.checked) {
                str += this.value + ";";
            }
        });
        b.val(str);                        
        $.ajax({
            type: "POST",
            url: 'users/add',
            data: {id_user: str, id_atasan: app.id_atasan},
            dataType: "json",
            traditional: true,	            
           	beforeSend: function(){
				
			},
		    success: function (data) {
		    	app.myTable.ajax.url("users/dataTableModalBahawan?id=" + app.id_atasan).load();
				$('#ModalUser').modal('hide');
	        },
        });
        
    }
	
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
