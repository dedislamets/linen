<script type="text/javascript">
	
	var app = new Vue({
        el: "#app",
        mounted: function () {
	      
	    },
	    updated: function () {
	    	var that = this;
	    	
	    },
        data: {
        	mode:'new',
        	list_soal:[],
        	history: [],
        },
        methods: {
        	
		    getSoal: function(id){
		    	var that = this;
		    	that.list_soal = [];
		    	var link = '<?= base_url(); ?>inspeksi/soal/'+ id;
		 		$.get(link,null, function(data){
					that.list_soal = data['soal'];
				},'json');
		    },

        }
    });
</script>