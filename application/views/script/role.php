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
	      permit:''
	    },
	    methods: {
	    	loadMenuSelected: function () {
		        var that = this;

		        jQuery.ajax({
		          type: "GET",
		          cache:false,
		          url: '<?= base_url() ?>role/getMenuSelected',
		          data: {id: that.group_id},
		          success: function(response) {          
		              	that.menu_selected = response;
		              	
		          },
		        });
		    },
		    loadPermission: function (id,text) {
		    	var that = this;

		    	that.menu_id = id;
				that.menu_text = text;	
				that.permission.create='0';
				that.permission.edit='0';
				that.permission.delete='0';
				that.permission.print='0';
				// $.get('role/getPermissionMenu', { id_group_menu: id }, function(data){ 
				// 	if(data != null){
			 //    		that.permission = data;
			 //    		that.permit=1;
				// 	}
			 //    })
		    },
		    checkedChange: function(e){
		    	var checked = (e.target.checked ? 1:0);
		    	var id = e.target.id;
		    	$.get('role/set_status_checked_permission', { id_group_menu: app.menu_id, type : id, checked: checked }, function(data){ 
		    		app.loadPermission(app.menu_id, app.menu_text);
			    })
		   
		    }
	    }
	})

	getMenuTree();

	function getMenuTree(){
		$('#basicTree').jstree({		
			'core' : {	
				'check_callback': true,		
				'data':
					{
				    'url':'role/getItem?id=' + app.group_id ,
				    'dataType':'json'
				 	}

			},	
			
			"search" : {  
	                 "case_insensitive" : true,  
	                 "show_only_matches" : true
	             },	

			'types' : {
		        'default' : {
		            'icon' : 'icofont icofont-folder'
		        },
		        'file' : {
		            'icon' : 'icofont icofont-file-alt'
		        }
		    },
		    'checkbox': {
	            three_state : true, // to avoid that fact that checking a node also check others
			      whole_node : true,  // to avoid checking the box just clicking the node 
			      tie_selection : true // for checking without selecting and selecting without checking
	         },
		  	"plugins" : [
		    	"themes", "xml_data", "ui","types", "search", 'checkbox'
		  	]
		}).on("changed.jstree", function (e, data) {	
			
			var state_checked = data.node.state.selected;

	   		$.get('role/set_status_checked', { menu: data.node.id, group: app.group_id, aktif: state_checked }, function(data){ 
		    	app.loadMenuSelected();
		    })
	    });	
	}

	$('#basicTree').on('ready.jstree', function() {   
	     // $("#basicTree").jstree("open_all"); 
	     $('#basicTree').off("click.jstree", ".jstree-anchor"); 
	});	

	$('#search_field').keyup(function(){
	    $('#basicTree').jstree('search', $(this).val());
	});


    $(".btnGroup").on('click', function (event) {
    	app.group_id = $(this).data('id');
    	app.group_text = $(this).text();
    	$('#basicTree').jstree("destroy");
    	getMenuTree();
    	app.loadMenuSelected();
    	app.loadPermission(0,'');
    }) 


</script>