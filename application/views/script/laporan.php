<script type="text/javascript">
	$('a[data-toggle="tab"]').click(function (e) {
	    e.preventDefault();
	    $(this).tab('show');
	});

	$('a[data-toggle="tab"]').on("shown.bs.tab", function (e) {
	    var id = $(e.target).attr("href");
	    localStorage.setItem('selectedTab', id)
	});

	var selectedTab = localStorage.getItem('selectedTab');
	if (selectedTab != null) {
	    $('a[data-toggle="tab"][href="' + selectedTab + '"]').tab('show');
	}
	$('#btnMedis').on('click', function (event) {
		window.location.href="<?= base_url(); ?>laporan?f=1&b="+ $("#bulan_medis").val() + "&t=" + $("#tahun_medis").val() 
	})
	$('#btnRawat').on('click', function (event) {
		window.location.href="<?= base_url(); ?>laporan?b="+ $("#bulan_rawat").val() + "&t=" + $("#tahun_rawat").val() 
	})

	$('#btnCetakMedis').on('click', function (event) {
		window.open("<?= base_url(); ?>cetak?p=medis&b="+ $("#bulan_medis").val() + "&t=" + $("#tahun_medis").val(),'_blank' );
	})
	$('#btnCetakRawat1').on('click', function (event) {
		window.open("<?= base_url(); ?>cetak?p=rawat_infeksius_kg&b="+ $("#bulan_rawat").val() + "&t=" + $("#tahun_rawat").val(),'_blank' );
	})
	$('#btnCetakRawat2').on('click', function (event) {
		window.open("<?= base_url(); ?>cetak?p=rawat_non_infeksius_kg&b="+ $("#bulan_rawat").val() + "&t=" + $("#tahun_rawat").val(),'_blank' );
	})
	$('#btnCetakRawat3').on('click', function (event) {
		window.open("<?= base_url(); ?>cetak?p=rawat_infeksius_lb&b="+ $("#bulan_rawat").val() + "&t=" + $("#tahun_rawat").val(),'_blank' );
	})
	$('#btnCetakRawat4').on('click', function (event) {
		window.open("<?= base_url(); ?>cetak?p=rawat_non_infeksius_lb&b="+ $("#bulan_rawat").val() + "&t=" + $("#tahun_rawat").val(),'_blank' );
	})
</script>