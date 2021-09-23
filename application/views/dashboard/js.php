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
</script>