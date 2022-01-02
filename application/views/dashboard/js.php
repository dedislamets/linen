<script type="text/javascript">
	$(function(){
        'use strict'

        // var datapie = {
        //   labels: ['Search', 'Email', 'Referral', 'Social', 'Other'],
        //   datasets: [{
        //     data: [25,20,30,15,10],
        //     backgroundColor: ['#6f42c1', '#007bff','#17a2b8','#00cccc','#adb2bd']
        //   }]
        // };

        var datapie = <?php echo $chart_rs; ?>;

        var optionpie = {
          maintainAspectRatio: false,
          responsive: true,
          legend: {
            display: false,
          },
          animation: {
            animateScale: true,
            animateRotate: true
          }
        };

        var ctxpie= document.getElementById('chartDonut');
        var myPieChart6 = new Chart(ctxpie, {
          type: 'doughnut',
          data: datapie,
          options: optionpie
        });

     });

  function editModal(val){
    $.get('listjemput/edit/' + $(val).data('id'), null, function(data){ 
        $("#lbl-title").text("Proses");
        $("#no_request").val(data[0]['no_request']);
        $("#tanggal").val(data[0]['tanggal']);
        $("#ruangan").val(data[0]['ruangan']);
        $("#requestor").val(data[0]['requestor']);
        $("#id_request").val(data[0]['id']);
        $('#ModalAdd').modal({backdrop: 'static', keyboard: false}) ;
           
    });
  }

  $('#btnSubmit').on('click', function (e) {
    var valid = false;
      var sParam = $('#Form').serialize();
      var validator = $('#Form').validate({
              rules: {
                  pic_jemput: {
                      required: true
                  },
                }
              });
    validator.valid();
    $status = validator.form();
    if($status) {
      var link = 'listjemput/proses';
      $.post(link,sParam, function(data){
        if(data.error==false){        
          $('#ModalAdd').modal('hide');         
          window.location.reload(); 
        }
      },'json');
    }
        
  });
</script>