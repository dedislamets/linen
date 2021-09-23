<script type="text/javascript">
	var app = new Vue({
	    el: "#app",
	    mounted: function () {
	      this.loadMenuSelected();
	      
	    },
	    updated: function () {
	    	
	    },
	    data: {
	      menu_text: '',
	      menu_id:'',
	      group_id: '1',
	      group_text:'Administrator',
	      menu_selected: [],
	      permission: [],
	      permit:'',
	      myTable2: ''
	    },
	    methods: {
	    	loadMenuSelected: function () {
		        myTable = $('#ViewTable').DataTable({
					dom: 'frtip',
					ajax: {		            
			            "url": "roleusers/dataTable?id=" + this.group_id,
			            "type": "GET"
			        },
			        processing	: true,
					serverSide	: true,			
					"bPaginate": true,	
					"autoWidth": true,
					"destroy": true,
		            
			    });

			    this.myTable2 = $('#ModalTableUser').DataTable({
					dom: 'frtip',
					ajax: {		            
			            "url": "roleusers/dataTableModal?id=" + this.group_id,
			            "type": "GET"
			        },
			        processing	: true,
					serverSide	: true,			
					"bPaginate": true,	
					"autoWidth": true,
					"destroy": true,
		            
			    });
		    },
		    
	    }
	})


    $(".btnGroup").on('click', function (event) {
    	app.group_id = $(this).data('id');
    	app.group_text = $(this).text();
    	app.loadMenuSelected();
    }) 

    $("#btnAdd").on('click', function (event) {
    	$('#ModalUser').modal({backdrop: 'static', keyboard: false}) ;
    }) 

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
            url: 'roleusers/add',
            data: {id_user: str, id_group_menu: app.group_id},
            dataType: "json",
            traditional: true,	            
           	beforeSend: function(){
				
			},
		    success: function (data) {
				$('#ModalUser').modal('hide');
	            app.loadMenuSelected();
	        },
        });
        
    }

    $('#btnsubmit').on('click', function (event) {

        var checked_courses = $('#ModalTableUser').find('input[name="selected_courses[]"]:checked').length;
        if (checked_courses != 0) {
            CheckedTrue();
            
        } else {
            alert("Silahkan pilih terlebih dahulu");
        }

    });

    function removeRole(val) {
		var r = confirm("Yakin dihapus?");
		if (r == true) {
			
			$.get('roleusers/delete', { id: $(val).data('id') }, function(data){ 
				app.loadMenuSelected();
			})
		
		}
	}
</script>