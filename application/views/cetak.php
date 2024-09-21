<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Cetak Printout</title>
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets\css\bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets\css\jquery-ui.min.css">
	<link rel="stylesheet" href="<?= base_url(); ?>assets\css\style-print.css">

</head>

<body>
	<html lang="en">

	<head>
		<meta charset='UTF-8'>
		<title>Editable Invoice</title>
		<style type="text/css">
			.no-border {
				border-top: 0px solid !important;
			}

			.border-dotted {
				border-bottom: dotted 2px;
				border-top: none;
				border-left: none;
				border-right: none;
			}
		</style>
	</head>

	<body>
		<?php
		$month = date('m');
		$thn = date('Y');
		if (!empty($this->input->get("b", TRUE))) {
			$month = $this->input->get("b", TRUE);
			$thn = $this->input->get("t", TRUE);
		}
		$jml_hari =  cal_days_in_month(CAL_GREGORIAN, $month, $thn);
		?>
		<div id="page-wrap">
			<input type="hidden" name="page" id="page" value="<?= $page ?>">
		</div>
		<?php if ($page == "medis") { ?>
			<div class="row">
				<table class="table" style="margin-bottom: 0;">
					<tr>
						<td style="border:none">
							<img src="<?= base_url() . 'upload/logo/' . $setup[0]->Logo ?>" style="height: 80px;width: 80px;" class="">
						</td>
						<td style="border:none">
							<h3 style="text-align: center;">Laporan Jumlah Linen Khusus Tenaga Medis</h3>
							<h4 style="font-size: 18px;text-align: center;">
								<?= $setup[0]->company ?><br>
								Instalasi Laundry
							</h4>
						</td>
						<td style="border:none">
							<img src="<?= base_url() . 'upload/logo/' . $setup[0]->Logo ?>" style="height: 80px;width: 80px;" class="">
						</td>
					</tr>
				</table>
			</div>
			<div>
				<table style="margin-bottom: 0; width: 100%;">
					<thead>
						<tr>
							<th rowspan="2">No</th>
							<th rowspan="2">Jenis Linen</th>
							<?php
							for ($i = 1; $i <= $jml_hari; $i++) {
								echo "<th>" . $i . "</th>";
							}
							?>
						</tr>
					</thead>
					<tbody>
						<?php
						$no = 1;
						foreach ($laporan_medis as $row => $ruangan) {
							echo "<tr>";
							echo "<td>" . $no . "</td>";
							echo "<td>" . $row . "</td>";
							for ($i = 1; $i <= $jml_hari; $i++) {
								$total = 0;
								foreach ($ruangan as $tgl => $row_tgl) {
									if ($tgl == $i) {
										$total = $row_tgl;
									}
								}
								echo "<td>" . ($total == 0 ? '' : $total) . "</td>";
							}
							echo "</tr>";
							$no++;
						}
						?>
						<tr>
							<td colspan="2">Total</td>
							<?php
							for ($i = 1; $i <= $jml_hari; $i++) {
								$total = 0;
								foreach ($laporan_medis_sum as $tgl => $row) {
									if ($tgl == $i) {
										$total = $row;
									}
								}
								echo "<td>" . ($total == 0 ? '' : $total) . "</td>";
							}
							?>
						</tr>
					</tbody>
				</table>
			</div>
			<table style="margin-bottom: 0;width: 100%">
				<tr>
					<td width="30%" style="border:none;padding-top: 30px;">
						<p style="margin-bottom: 0;text-align: center;"><?= $setup[0]->company ?></p>
						<p style="text-align: center;">KEPALA INSTALASI LAUNDRY</p>
						<br>
						<br>
						<br>
						<br>
						<p style="font-weight: bold;text-align: center;text-decoration: underline;margin-bottom: 0;"><?= $setup[0]->pic_1 ?></p>
						<p style="font-weight: bold;text-align: center;margin-bottom: 0;"><?= !empty($setup[0]->pic_1_nik) ? 'NIP. ' . $setup[0]->pic_1_nik : '' ?></p>
					</td>
					<td width="40%" class="no-border">
					</td>
					<td width="30%" style="border:none;padding-top: 30px;">
						<p style="margin-bottom: 0;text-align: center;">ADM. UMUM</p>
						<br>
						<br>
						<br>
						<br>
						<br>
						<p style="font-weight: bold;text-align: center;text-decoration: underline;margin-bottom: 0;"><?= $setup[0]->pic_2 ?></p>
						<p style="font-weight: bold;text-align: center;margin-bottom: 0;"><?= !empty($setup[0]->pic_2_nik) ? 'NIP. ' . $setup[0]->pic_1_nik : '' ?></p>

					</td>
				</tr>
			</table>
			<div style="break-after:page"></div>
		<?php } elseif ($page == 'nonmedis') { ?>
			<div class="row">
				<table class="table" style="margin-bottom: 0;">
					<tr>
						<td style="border:none">
							<img src="<?= base_url() . 'upload/logo/' . $setup[0]->Logo ?>" style="height: 80px;width: 80px;" class="">
						</td>
						<td style="border:none">
							<h3 style="text-align: center;">Laporan Jumlah Linen Khusus Tenaga Non Medis</h3>
							<h4 style="font-size: 18px;text-align: center;">
								<?= $setup[0]->company ?><br>
								Instalasi Laundry
							</h4>
						</td>
						<td style="border:none">
							<img src="<?= base_url() . 'upload/logo/' . $setup[0]->Logo ?>" style="height: 80px;width: 80px;" class="">
						</td>
					</tr>
				</table>
			</div>
			<div>
				<table style="margin-bottom: 0; width: 100%;">
					<thead>
						<tr>
							<th rowspan="2">No</th>
							<th rowspan="2">Jenis Linen</th>
							<?php
							for ($i = 1; $i <= $jml_hari; $i++) {
								echo "<th>" . $i . "</th>";
							}
							?>
						</tr>
					</thead>
					<tbody>
						<?php
						$no = 1;
						foreach ($laporan_non_medis as $row => $ruangan) {
							echo "<tr>";
							echo "<td>" . $no . "</td>";
							echo "<td>" . $row . "</td>";
							for ($i = 1; $i <= $jml_hari; $i++) {
								$total = 0;
								foreach ($ruangan as $tgl => $row_tgl) {
									if ($tgl == $i) {
										$total = $row_tgl;
									}
								}
								echo "<td>" . ($total == 0 ? '' : $total) . "</td>";
							}
							echo "</tr>";
							$no++;
						}
						?>
						<tr>
							<td colspan="2">Total</td>
							<?php
							for ($i = 1; $i <= $jml_hari; $i++) {
								$total = 0;
								foreach ($laporan_non_medis_sum as $tgl => $row) {
									if ($tgl == $i) {
										$total = $row;
									}
								}
								echo "<td>" . ($total == 0 ? '' : $total) . "</td>";
							}
							?>
						</tr>
					</tbody>
				</table>
			</div>
			<table style="margin-bottom: 0;width: 100%">
				<tr>
					<td width="30%" style="border:none;padding-top: 30px;">
						<p style="margin-bottom: 0;text-align: center;"><?= $setup[0]->company ?></p>
						<p style="text-align: center;">KEPALA INSTALASI LAUNDRY</p>
						<br>
						<br>
						<br>
						<br>
						<p style="font-weight: bold;text-align: center;text-decoration: underline;margin-bottom: 0;"><?= $setup[0]->pic_1 ?></p>
						<p style="font-weight: bold;text-align: center;margin-bottom: 0;"><?= !empty($setup[0]->pic_1_nik) ? 'NIP. ' . $setup[0]->pic_1_nik : '' ?></p>
					</td>
					<td width="40%" class="no-border">
					</td>
					<td width="30%" style="border:none;padding-top: 30px;">
						<p style="margin-bottom: 0;text-align: center;">ADM. UMUM</p>
						<br>
						<br>
						<br>
						<br>
						<br>
						<p style="font-weight: bold;text-align: center;text-decoration: underline;margin-bottom: 0;"><?= $setup[0]->pic_2 ?></p>
						<p style="font-weight: bold;text-align: center;margin-bottom: 0;"><?= !empty($setup[0]->pic_2_nik) ? 'NIP. ' . $setup[0]->pic_1_nik : '' ?></p>

					</td>
				</tr>
			</table>
			<div style="break-after:page"></div>
		<?php } elseif ($page == 'rawat_infeksius_kg') { ?>
			<div class="row">
				<table class="table" style="margin-bottom: 0;">
					<tr>
						<td style="border:none">
							<img src="<?= base_url() . 'upload/logo/' . $setup[0]->Logo ?>" style="height: 80px;width: 80px;" class="">
						</td>
						<td style="border:none">
							<h3 style="text-align: center;">Laporan Linen Rawat Inap Infeksius (Kg)</h3>
							<h4 style="font-size: 18px;text-align: center;">
								<?= $setup[0]->company ?><br>
								Instalasi Laundry
							</h4>
						</td>
						<td style="border:none">
							<img src="<?= base_url() . 'upload/logo/' . $setup[0]->Logo ?>" style="height: 80px;width: 80px;" class="">
						</td>
					</tr>
				</table>
			</div>

			<div>
				<table style="margin-bottom: 0; width: 100%;">
					<thead>
						<tr>
							<th rowspan="2">ID</th>
							<th rowspan="2">Ruangan</th>
							<?php
							for ($i = 1; $i <= $jml_hari; $i++) {
								echo "<th>" . $i . "</th>";
							}
							?>
						</tr>

					</thead>
					<tbody>
						<?php
						$no = 1;
						foreach ($laporan_rawat_inf as $row => $ruangan) {
							echo "<tr>";
							echo "<td>" . $no . "</td>";
							echo "<td>" . $row . "</td>";
							for ($i = 1; $i <= $jml_hari; $i++) {
								$total = 0;
								foreach ($ruangan as $tgl => $row_tgl) {
									if ($tgl == $i) {
										$total = $row_tgl;
									}
								}
								echo "<td>" . ($total == 0 ? '' : $total) . "</td>";
							}
							echo "</tr>";
							$no++;
						}
						?>
						<tr>
							<td colspan="2">Total</td>
							<?php
							for ($i = 1; $i <= $jml_hari; $i++) {
								$total = 0;
								foreach ($laporan_rawat_inf_sum as $tgl => $row) {
									if ($tgl == $i) {
										$total = $row;
									}
								}
								echo "<td>" . ($total == 0 ? '' : $total) . "</td>";
							}
							?>
						</tr>
					</tbody>
				</table>
			</div>
			<table style="margin-bottom: 0;width: 100%">
				<tr>
					<td width="30%" style="border:none;padding-top: 30px;">
						<p style="margin-bottom: 0;text-align: center;"><?= $setup[0]->company ?></p>
						<p style="text-align: center;">KEPALA INSTALASI LAUNDRY</p>
						<br>
						<br>
						<br>
						<br>
						<p style="font-weight: bold;text-align: center;text-decoration: underline;margin-bottom: 0;"><?= $setup[0]->pic_1 ?></p>
						<p style="font-weight: bold;text-align: center;margin-bottom: 0;"><?= !empty($setup[0]->pic_1_nik) ? 'NIP. ' . $setup[0]->pic_1_nik : '' ?></p>
					</td>
					<td width="40%" class="no-border">
					</td>
					<td width="30%" style="border:none;padding-top: 30px;">
						<p style="margin-bottom: 0;text-align: center;">ADM. UMUM</p>
						<br>
						<br>
						<br>
						<br>
						<br>
						<p style="font-weight: bold;text-align: center;text-decoration: underline;margin-bottom: 0;"><?= $setup[0]->pic_2 ?></p>
						<p style="font-weight: bold;text-align: center;margin-bottom: 0;"><?= !empty($setup[0]->pic_2_nik) ? 'NIP. ' . $setup[0]->pic_1_nik : '' ?></p>

					</td>

				</tr>
			</table>
			<div style="break-after:page"></div>
		<?php } elseif ($page == 'rawat_non_infeksius_kg') { ?>
			<div class="row">
				<table class="table" style="margin-bottom: 0;">
					<tr>
						<td style="border:none">
							<img src="<?= base_url() . 'upload/logo/' . $setup[0]->Logo ?>" style="height: 80px;width: 80px;" class="">
						</td>
						<td style="border:none">
							<h3 style="text-align: center;">Laporan Linen Rawat Inap Infeksius (Kg)</h3>
							<h4 style="font-size: 18px;text-align: center;">
								<?= $setup[0]->company ?><br>
								Instalasi Laundry
							</h4>
						</td>
						<td style="border:none">
							<img src="<?= base_url() . 'upload/logo/' . $setup[0]->Logo ?>" style="height: 80px;width: 80px;" class="">
						</td>
					</tr>
				</table>
			</div>

			<div>
				<table style="margin-bottom: 0; width: 100%;">
					<thead>
						<tr>
							<th rowspan="2">ID</th>
							<th rowspan="2">Ruangan</th>
							<?php
							for ($i = 1; $i <= $jml_hari; $i++) {
								echo "<th>" . $i . "</th>";
							}
							?>
						</tr>

					</thead>
					<tbody>
						<?php
						$no = 1;
						foreach ($laporan_non_rawat_inf as $row => $ruangan) {
							echo "<tr>";
							echo "<td>" . $no . "</td>";
							echo "<td>" . $row . "</td>";
							for ($i = 1; $i <= $jml_hari; $i++) {
								$total = 0;
								foreach ($ruangan as $tgl => $row_tgl) {
									if ($tgl == $i) {
										$total = $row_tgl;
									}
								}
								echo "<td>" . ($total == 0 ? '' : $total) . "</td>";
							}
							echo "</tr>";
							$no++;
						}
						?>
						<tr>
							<td colspan="2">Total</td>
							<?php
							for ($i = 1; $i <= $jml_hari; $i++) {
								$total = 0;
								foreach ($laporan_non_rawat_inf_sum as $tgl => $row) {
									if ($tgl == $i) {
										$total = $row;
									}
								}
								echo "<td>" . ($total == 0 ? '' : $total) . "</td>";
							}
							?>
						</tr>
					</tbody>
				</table>
			</div>
			<table style="margin-bottom: 0;width: 100%">
				<tr>
					<td width="30%" style="border:none;padding-top: 30px;">
						<p style="margin-bottom: 0;text-align: center;"><?= $setup[0]->company ?></p>
						<p style="text-align: center;">KEPALA INSTALASI LAUNDRY</p>
						<br>
						<br>
						<br>
						<br>
						<p style="font-weight: bold;text-align: center;text-decoration: underline;margin-bottom: 0;"><?= $setup[0]->pic_1 ?></p>
						<p style="font-weight: bold;text-align: center;margin-bottom: 0;"><?= !empty($setup[0]->pic_1_nik) ? 'NIP. ' . $setup[0]->pic_1_nik : '' ?></p>
					</td>
					<td width="40%" class="no-border">
					</td>
					<td width="30%" style="border:none;padding-top: 30px;">
						<p style="margin-bottom: 0;text-align: center;">ADM. UMUM</p>
						<br>
						<br>
						<br>
						<br>
						<br>
						<p style="font-weight: bold;text-align: center;text-decoration: underline;margin-bottom: 0;"><?= $setup[0]->pic_2 ?></p>
						<p style="font-weight: bold;text-align: center;margin-bottom: 0;"><?= !empty($setup[0]->pic_2_nik) ? 'NIP. ' . $setup[0]->pic_1_nik : '' ?></p>

					</td>
				</tr>
			</table>
			<div style="break-after:page"></div>
		<?php } elseif ($page == 'rawat_infeksius_lb') { ?>
			<div class="row">
				<table class="table" style="margin-bottom: 0;">
					<tr>
						<td style="border:none">
							<img src="<?= base_url() . 'upload/logo/' . $setup[0]->Logo ?>" style="height: 80px;width: 80px;" class="">
						</td>
						<td style="border:none">
							<h3 style="text-align: center;">Laporan Linen Rawat Inap Infeksius (Lembar)</h3>
							<h4 style="font-size: 18px;text-align: center;">
								<?= $setup[0]->company ?><br>
								Instalasi Laundry
							</h4>
						</td>
						<td style="border:none">
							<img src="<?= base_url() . 'upload/logo/' . $setup[0]->Logo ?>" style="height: 80px;width: 80px;" class="">
						</td>
					</tr>
				</table>
			</div>

			<div>
				<table style="margin-bottom: 0; width: 100%;">
					<thead>
						<tr>
							<th rowspan="2">ID</th>
							<th rowspan="2">Jenis Linen</th>
							<?php
							for ($i = 1; $i <= $jml_hari; $i++) {
								echo "<th>" . $i . "</th>";
							}
							?>
						</tr>

					</thead>
					<tbody>
						<?php
						$no = 1;
						foreach ($laporan_rawat_inf_2 as $row => $ruangan) {
							echo "<tr>";
							echo "<td>" . $no . "</td>";
							echo "<td>" . $row . "</td>";
							for ($i = 1; $i <= $jml_hari; $i++) {
								$total = 0;
								foreach ($ruangan as $tgl => $row_tgl) {
									if ($tgl == $i) {
										$total = $row_tgl;
									}
								}
								echo "<td>" . ($total == 0 ? '' : $total) . "</td>";
							}
							echo "</tr>";
							$no++;
						}
						?>
						<tr>
							<td colspan="2">Total</td>
							<?php
							for ($i = 1; $i <= $jml_hari; $i++) {
								$total = 0;
								foreach ($laporan_rawat_inf_sum_2 as $tgl => $row) {
									if ($tgl == $i) {
										$total = $row;
									}
								}
								echo "<td>" . ($total == 0 ? '' : $total) . "</td>";
							}
							?>
						</tr>
					</tbody>
				</table>
			</div>
			<table style="margin-bottom: 0;width: 100%">
				<tr>
					<td width="30%" style="border:none;padding-top: 30px;">
						<p style="margin-bottom: 0;text-align: center;"><?= $setup[0]->company ?></p>
						<p style="text-align: center;">KEPALA INSTALASI LAUNDRY</p>
						<br>
						<br>
						<br>
						<br>
						<p style="font-weight: bold;text-align: center;text-decoration: underline;margin-bottom: 0;"><?= $setup[0]->pic_1 ?></p>
						<p style="font-weight: bold;text-align: center;margin-bottom: 0;"><?= !empty($setup[0]->pic_1_nik) ? 'NIP. ' . $setup[0]->pic_1_nik : '' ?></p>
					</td>
					<td width="40%" class="no-border">
					</td>
					<td width="30%" style="border:none;padding-top: 30px;">
						<p style="margin-bottom: 0;text-align: center;">ADM. UMUM</p>
						<br>
						<br>
						<br>
						<br>
						<br>
						<p style="font-weight: bold;text-align: center;text-decoration: underline;margin-bottom: 0;"><?= $setup[0]->pic_2 ?></p>
						<p style="font-weight: bold;text-align: center;margin-bottom: 0;"><?= !empty($setup[0]->pic_2_nik) ? 'NIP. ' . $setup[0]->pic_1_nik : '' ?></p>

					</td>
				</tr>
			</table>
			<div style="break-after:page"></div>
		<?php } elseif ($page == 'rawat_non_infeksius_lb') { ?>
			<div class="row">
				<table class="table" style="margin-bottom: 0;">
					<tr>
						<td style="border:none">
							<img src="<?= base_url() . 'upload/logo/' . $setup[0]->Logo ?>" style="height: 80px;width: 80px;" class="">
						</td>
						<td style="border:none">
							<h3 style="text-align: center;">Laporan Linen Rawat Inap Non Infeksius (Lembar)</h3>
							<h4 style="font-size: 18px;text-align: center;">
								<?= $setup[0]->company ?><br>
								Instalasi Laundry
							</h4>
						</td>
						<td style="border:none">
							<img src="<?= base_url() . 'upload/logo/' . $setup[0]->Logo ?>" style="height: 80px;width: 80px;" class="">
						</td>
					</tr>
				</table>
			</div>

			<div>
				<table style="margin-bottom: 0; width: 100%;">
					<thead>
						<tr>
							<th rowspan="2">ID</th>
							<th rowspan="2">Jenis Linen</th>
							<?php
							for ($i = 1; $i <= $jml_hari; $i++) {
								echo "<th>" . $i . "</th>";
							}
							?>
						</tr>

					</thead>
					<tbody>
						<?php
						$no = 1;
						foreach ($laporan_rawat_non_inf_2 as $row => $ruangan) {
							echo "<tr>";
							echo "<td>" . $no . "</td>";
							echo "<td>" . $row . "</td>";
							for ($i = 1; $i <= $jml_hari; $i++) {
								$total = 0;
								foreach ($ruangan as $tgl => $row_tgl) {
									if ($tgl == $i) {
										$total = $row_tgl;
									}
								}
								echo "<td>" . ($total == 0 ? '' : $total) . "</td>";
							}
							echo "</tr>";
							$no++;
						}
						?>
						<tr>
							<td colspan="2">Total</td>
							<?php
							for ($i = 1; $i <= $jml_hari; $i++) {
								$total = 0;
								foreach ($laporan_rawat_non_inf_sum_2 as $tgl => $row) {
									if ($tgl == $i) {
										$total = $row;
									}
								}
								echo "<td>" . ($total == 0 ? '' : $total) . "</td>";
							}
							?>
						</tr>
					</tbody>
				</table>
			</div>
			<table style="margin-bottom: 0;width: 100%">
				<tr>
					<td width="30%" style="border:none;padding-top: 30px;">
						<p style="margin-bottom: 0;text-align: center;"><?= $setup[0]->company ?></p>
						<p style="text-align: center;">KEPALA INSTALASI LAUNDRY</p>
						<br>
						<br>
						<br>
						<br>
						<p style="font-weight: bold;text-align: center;text-decoration: underline;margin-bottom: 0;"><?= $setup[0]->pic_1 ?></p>
						<p style="font-weight: bold;text-align: center;margin-bottom: 0;"><?= !empty($setup[0]->pic_1_nik) ? 'NIP. ' . $setup[0]->pic_1_nik : '' ?></p>
					</td>
					<td width="40%" class="no-border">
					</td>
					<td width="30%" style="border:none;padding-top: 30px;">
						<p style="margin-bottom: 0;text-align: center;">ADM. UMUM</p>
						<br>
						<br>
						<br>
						<br>
						<br>
						<p style="font-weight: bold;text-align: center;text-decoration: underline;margin-bottom: 0;"><?= $setup[0]->pic_2 ?></p>
						<p style="font-weight: bold;text-align: center;margin-bottom: 0;"><?= !empty($setup[0]->pic_2_nik) ? 'NIP. ' . $setup[0]->pic_1_nik : '' ?></p>

					</td>
				</tr>
			</table>
			<div style="break-after:page"></div>
		<?php } elseif ($page == 'rewash') { ?>
			<div class="row">
				<table class="table" style="margin-bottom: 0;">
					<tr>
						<td style="border:none">
							<img src="<?= base_url() . 'upload/logo/' . $setup[0]->Logo ?>" style="height: 80px;width: 80px;" class="">
						</td>
						<td style="border:none">
							<h3 style="text-align: center;">Laporan Linen Rewash</h3>
							<h4 style="font-size: 18px;text-align: center;">
								<?= $setup[0]->company ?><br>
								Instalasi Laundry
							</h4>
						</td>
						<td style="border:none">
							<img src="<?= base_url() . 'upload/logo/' . $setup[0]->Logo ?>" style="height: 80px;width: 80px;" class="">
						</td>
					</tr>
				</table>
			</div>

			<div>
				<table style="margin-bottom: 0; width: 100%;">
					<thead>
						<tr>
							<th rowspan="2">ID</th>
							<th rowspan="2">Jenis Linen</th>
							<?php
							for ($i = 1; $i <= $jml_hari; $i++) {
								echo "<th>" . $i . "</th>";
							}
							?>
						</tr>

					</thead>
					<tbody>
						<?php
						$no = 1;
						foreach ($laporan_rewash as $row => $ruangan) {
							echo "<tr>";
							echo "<td>" . $no . "</td>";
							echo "<td>" . $row . "</td>";
							for ($i = 1; $i <= $jml_hari; $i++) {
								$total = 0;
								foreach ($ruangan as $tgl => $row_tgl) {
									if ($tgl == $i) {
										$total = $row_tgl;
									}
								}
								echo "<td>" . ($total == 0 ? '' : $total) . "</td>";
							}
							echo "</tr>";
							$no++;
						}
						?>
						<tr>
							<td colspan="2">Total</td>
							<?php
							for ($i = 1; $i <= $jml_hari; $i++) {
								$total = 0;
								foreach ($laporan_rewash_sum as $tgl => $row) {
									if ($tgl == $i) {
										$total = $row;
									}
								}
								echo "<td>" . ($total == 0 ? '' : $total) . "</td>";
							}
							?>
						</tr>
					</tbody>
				</table>
			</div>
			<table style="margin-bottom: 0;width: 100%">
				<tr>
					<td width="30%" style="border:none;padding-top: 30px;">
						<p style="margin-bottom: 0;text-align: center;"><?= $setup[0]->company ?></p>
						<p style="text-align: center;">KEPALA INSTALASI LAUNDRY</p>
						<br>
						<br>
						<br>
						<br>
						<p style="font-weight: bold;text-align: center;text-decoration: underline;margin-bottom: 0;"><?= $setup[0]->pic_1 ?></p>
						<p style="font-weight: bold;text-align: center;margin-bottom: 0;"><?= !empty($setup[0]->pic_1_nik) ? 'NIP. ' . $setup[0]->pic_1_nik : '' ?></p>
					</td>
					<td width="40%" class="no-border">
					</td>
					<td width="30%" style="border:none;padding-top: 30px;">
						<p style="margin-bottom: 0;text-align: center;">ADM. UMUM</p>
						<br>
						<br>
						<br>
						<br>
						<br>
						<p style="font-weight: bold;text-align: center;text-decoration: underline;margin-bottom: 0;"><?= $setup[0]->pic_2 ?></p>
						<p style="font-weight: bold;text-align: center;margin-bottom: 0;"><?= !empty($setup[0]->pic_2_nik) ? 'NIP. ' . $setup[0]->pic_1_nik : '' ?></p>

					</td>
				</tr>
			</table>
			<div style="break-after:page"></div>
		<?php } elseif ($page == 'keluar') { ?>
			<div class="row">
				<table class="table" style="margin-bottom: 0;">
					<tr>
						<td style="border:none">
							<img src="<?= base_url() . 'upload/logo/' . $setup[0]->Logo ?>" style="height: 80px;width: 80px;" class="">
						</td>
						<td style="border:none">
							<h3 style="text-align: center;">Laporan Linen Rawat Inap Non Infeksius (Lembar)</h3>
							<h4 style="font-size: 18px;text-align: center;">
								<?= $setup[0]->company ?><br>
								Instalasi Laundry
							</h4>
						</td>
						<td style="border:none">
							<img src="<?= base_url() . 'upload/logo/' . $setup[0]->Logo ?>" style="height: 80px;width: 80px;" class="">
						</td>
					</tr>
				</table>
			</div>

			<div>
				<table style="margin-bottom: 0; width: 100%;">
					<thead>
						<tr>
							<th rowspan="2" class="vcenter">No</th>
							<th rowspan="2" class="vcenter">Ruangan</th>
							<th colspan="2" class="vcenter">Jumlah</th>
							<th rowspan="2" class="vcenter">Berat (Kg)</th>
							<th rowspan="2" class="vcenter">Biaya</th>
						</tr>
						<tr>
							<th>Infeksius</th>
							<th>Non Infeksius</th>
						</tr>

					</thead>
					<tbody>

					</tbody>
				</table>
			</div>
			<table style="margin-bottom: 0;width: 100%">
				<tr>
					<td width="30%" style="border:none;padding-top: 30px;">
						<p style="margin-bottom: 0;text-align: center;"><?= $setup[0]->company ?></p>
						<p style="text-align: center;">KEPALA INSTALASI LAUNDRY</p>
						<br>
						<br>
						<br>
						<br>
						<p style="font-weight: bold;text-align: center;text-decoration: underline;margin-bottom: 0;">ADY HARTANTO. A.Md.KL,SKM</p>
						<p style="font-weight: bold;text-align: center;margin-bottom: 0;">NIP. 19800806 201001 1 021</p>
					</td>
					<td width="40%" class="no-border">
					</td>
					<td width="30%" style="border:none;padding-top: 30px;">
						<p style="margin-bottom: 0;text-align: center;">ADM. UMUM</p>
						<br>
						<br>
						<br>
						<br>
						<br>
						<p style="font-weight: bold;text-align: center;">FARRA KHARISMA RINTA</p>
					</td>
				</tr>
			</table>
			<div style="break-after:page"></div>
		<?php } elseif ($page == 'storage') { ?>
			<div class="row">
				<table class="table" style="margin-bottom: 0;">
					<tr>
						<td style="border:none">
							<img src="<?= base_url() . 'upload/logo/' . $setup[0]->Logo ?>" style="height: 80px;width: 80px;" class="">
						</td>
						<td style="border:none">
							<h3 style="text-align: center;">Laporan Penyimpanan</h3>
							<h4 style="font-size: 18px;text-align: center;">
								<?= $setup[0]->company ?><br>
								Instalasi Laundry
							</h4>
						</td>
						<td style="border:none">
							<img src="<?= base_url() . 'upload/logo/' . $setup[0]->Logo ?>" style="height: 80px;width: 80px;" class="">
						</td>
					</tr>
				</table>
			</div>

			<div>
				<table style="margin-bottom: 0; width: 100%;">
					<thead>
						<tr>
							<th class="vcenter">No</th>
							<th class="vcenter">Nama Barang</th>
							<th class="vcenter">Spesifikasi</th>
							<th class="vcenter">Jumlah</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$urut = 1;
						$total = 0;
						foreach ($laporan_storage as $row): ?>
							<tr>
								<td width="10"><?= $urut ?></td>
								<td><?= $row->jenis ?></td>
								<td><?= $row->spesifikasi ?></td>
								<td style="text-align: right;"><?= $row->jml ?></td>

							</tr>
							<?php $urut++;
							$total += $row->jml; ?>
						<?php endforeach; ?>
						<tr>
							<td colspan="3" style="text-align: right;font-size: 21px;font-weight: bold;">Total</td>
							<td style="text-align: right;font-size: 21px;font-weight: bold;"><?= number_format($total) ?></td>
						</tr>
					</tbody>
				</table>
			</div>
			<table style="margin-bottom: 0;width: 100%">
				<tr>
					<td width="30%" style="border:none;padding-top: 30px;">
						<p style="margin-bottom: 0;text-align: center;"><?= $setup[0]->company ?></p>
						<p style="text-align: center;">KEPALA INSTALASI LAUNDRY</p>
						<br>
						<br>
						<br>
						<br>
						<p style="font-weight: bold;text-align: center;text-decoration: underline;margin-bottom: 0;"><?= $setup[0]->pic_1 ?></p>
						<p style="font-weight: bold;text-align: center;margin-bottom: 0;"><?= !empty($setup[0]->pic_1_nik) ? 'NIP. ' . $setup[0]->pic_1_nik : '' ?></p>
					</td>
					<td width="40%" class="no-border">
					</td>
					<td width="30%" style="border:none;padding-top: 30px;">
						<p style="margin-bottom: 0;text-align: center;">ADM. UMUM</p>
						<br>
						<br>
						<br>
						<br>
						<br>
						<p style="font-weight: bold;text-align: center;text-decoration: underline;margin-bottom: 0;"><?= $setup[0]->pic_2 ?></p>
						<p style="font-weight: bold;text-align: center;margin-bottom: 0;"><?= !empty($setup[0]->pic_2_nik) ? 'NIP. ' . $setup[0]->pic_1_nik : '' ?></p>

					</td>
				</tr>
			</table>
			<div style="break-after:page"></div>
		<?php } elseif ($page == 'rusak') { ?>
			<div class="row">
				<table class="table" style="margin-bottom: 0;">
					<tr>
						<td style="border:none">
							<img src="<?= base_url() . 'upload/logo/' . $setup[0]->Logo ?>" style="height: 80px;width: 80px;" class="">
						</td>
						<td style="border:none">
							<h3 style="text-align: center;">Laporan Linen Rusak</h3>
							<h4 style="font-size: 18px;text-align: center;">
								<?= $setup[0]->company ?><br>
								Instalasi Laundry
							</h4>
						</td>
						<td style="border:none">
							<img src="<?= base_url() . 'upload/logo/' . $setup[0]->Logo ?>" style="height: 80px;width: 80px;" class="">
						</td>
					</tr>
				</table>
			</div>

			<div>
				<table style="margin-bottom: 0; width: 100%;">
					<thead>
						<tr>
							<th class="vcenter">No</th>
							<th class="vcenter">Tanggal</th>
							<th class="vcenter">Defect</th>
							<th class="vcenter">Nama Barang</th>
							<th class="vcenter">Spesifikasi</th>
							<th class="vcenter">Jumlah</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$urut = 1;
						$total = 0;
						foreach ($laporan_rusak as $row): ?>
							<tr>
								<td width="10"><?= $urut ?></td>
								<td><?= $row->TANGGAL ?></td>
								<td><?= $row->DEFECT ?></td>
								<td><?= $row->jenis ?></td>
								<td><?= $row->spesifikasi ?></td>
								<td style="text-align: right;"><?= $row->jml ?></td>

							</tr>
							<?php $urut++;
							$total += $row->jml; ?>
						<?php endforeach; ?>
						<tr>
							<td colspan="5" style="text-align: right;font-size: 21px;font-weight: bold;">Total</td>
							<td style="text-align: right;font-size: 21px;font-weight: bold;"><?= number_format($total) ?></td>
						</tr>
					</tbody>
				</table>
			</div>
			<table style="margin-bottom: 0;width: 100%">
				<tr>
					<td width="30%" style="border:none;padding-top: 30px;">
						<p style="margin-bottom: 0;text-align: center;"><?= $setup[0]->company ?></p>
						<p style="text-align: center;">KEPALA INSTALASI LAUNDRY</p>
						<br>
						<br>
						<br>
						<br>
						<p style="font-weight: bold;text-align: center;text-decoration: underline;margin-bottom: 0;"><?= $setup[0]->pic_1 ?></p>
						<p style="font-weight: bold;text-align: center;margin-bottom: 0;"><?= !empty($setup[0]->pic_1_nik) ? 'NIP. ' . $setup[0]->pic_1_nik : '' ?></p>
					</td>
					<td width="40%" class="no-border">
					</td>
					<td width="30%" style="border:none;padding-top: 30px;">
						<p style="margin-bottom: 0;text-align: center;">ADM. UMUM</p>
						<br>
						<br>
						<br>
						<br>
						<br>
						<p style="font-weight: bold;text-align: center;text-decoration: underline;margin-bottom: 0;"><?= $setup[0]->pic_2 ?></p>
						<p style="font-weight: bold;text-align: center;margin-bottom: 0;"><?= !empty($setup[0]->pic_2_nik) ? 'NIP. ' . $setup[0]->pic_1_nik : '' ?></p>

					</td>
				</tr>
			</table>
			<div style="break-after:page"></div>
		<?php } elseif ($page == 'linenkotor') { ?>
			<div class="row">
				<table class="table" style="margin-bottom: 0;">
					<tr>
						<td style="border:none">
							<img src="<?= base_url() . 'upload/logo/' . $setup[0]->Logo ?>" style="height: 80px;width: 80px;" class="">
						</td>
						<td style="border:none">
							<h3 style="text-align: center;">Laporan Linen Kotor</h3>
							<h4 style="font-size: 18px;text-align: center;">
								<?= $setup[0]->company ?><br>
								Instalasi Laundry
							</h4>
						</td>
						<td style="border:none">
							<img src="<?= base_url() . 'upload/logo/' . $setup[0]->Logo ?>" style="height: 80px;width: 80px;" class="">
						</td>
					</tr>
				</table>
			</div>

			<div>
				<table style="margin-bottom: 0; width: 100%;">
					<thead>
						<tr>
							<th>
								No
							</th>
							<th>
								Tanggal
							</th>
							<th>
								Nomor
							</th>
							<th>
								Ruangan
							</th>
							<th>
								PIC
							</th>
							<th>
								Nama Barang
							</th>
							<th>
								Spesifikasi
							</th>
							<th style="text-align: right;">
								Qty
							</th>
							<th style="text-align: right;">
								Berat
							</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$urut = 1;
						$total = 0;
						$total_berat = 0;
						foreach ($laporan_kotor as $row): ?>
							<tr>
								<td width="10"><?= ($urut > 1 && $laporan_kotor[$urut - 2]->NO_TRANSAKSI == $row->NO_TRANSAKSI) ? '' : $urut ?></td>
								<td>
									<?= ($urut > 1 && $laporan_kotor[$urut - 2]->TANGGAL == $row->TANGGAL) ? '' : $row->TANGGAL ?>
								</td>
								<td>
									<?= ($urut > 1 && $laporan_kotor[$urut - 2]->NO_TRANSAKSI == $row->NO_TRANSAKSI) ? '' : $row->NO_TRANSAKSI ?>
								</td>
								<td>
									<?= ($urut > 1 && $laporan_kotor[$urut - 2]->NO_TRANSAKSI == $row->NO_TRANSAKSI) ? '' : $row->ruangan ?>
								</td>
								<td>
									<?= ($urut > 1 && $laporan_kotor[$urut - 2]->NO_TRANSAKSI == $row->NO_TRANSAKSI) ? '' : $row->PIC ?>
								</td>
								<td><?= $row->jenis ?></td>
								<td><?= $row->spesifikasi ?></td>
								<td style="text-align: right;"><?= $row->jml ?></td>
								<td style="text-align: right;"><?= $row->total_berat ?></td>
							</tr>
							<?php
							if ($urut == 1 || $laporan_kotor[$urut - 2]->NO_TRANSAKSI != $row->NO_TRANSAKSI) $urut++;
							$total += $row->jml;
							$total_berat += $row->total_berat;
							?>

						<?php endforeach; ?>
						<tr>
							<td colspan="7" style="text-align: right;font-size: 21px;font-weight: bold;">Total</td>
							<td style="text-align: right;font-size: 21px;font-weight: bold;"><?= number_format($total) ?></td>
							<td style="text-align: right;font-size: 21px;font-weight: bold;"><?= number_format($total_berat) ?></td>
						</tr>
					</tbody>
				</table>
			</div>
			<table style="margin-bottom: 0;width: 100%">
				<tr>
					<td width="30%" style="border:none;padding-top: 30px;">
						<p style="margin-bottom: 0;text-align: center;"><?= $setup[0]->company ?></p>
						<p style="text-align: center;">KEPALA INSTALASI LAUNDRY</p>
						<br>
						<br>
						<br>
						<br>
						<p style="font-weight: bold;text-align: center;text-decoration: underline;margin-bottom: 0;"><?= $setup[0]->pic_1 ?></p>
						<p style="font-weight: bold;text-align: center;margin-bottom: 0;"><?= !empty($setup[0]->pic_1_nik) ? 'NIP. ' . $setup[0]->pic_1_nik : '' ?></p>
					</td>
					<td width="40%" class="no-border">
					</td>
					<td width="30%" style="border:none;padding-top: 30px;">
						<p style="margin-bottom: 0;text-align: center;">ADM. UMUM</p>
						<br>
						<br>
						<br>
						<br>
						<br>
						<p style="font-weight: bold;text-align: center;text-decoration: underline;margin-bottom: 0;"><?= $setup[0]->pic_2 ?></p>
						<p style="font-weight: bold;text-align: center;margin-bottom: 0;"><?= !empty($setup[0]->pic_2_nik) ? 'NIP. ' . $setup[0]->pic_1_nik : '' ?></p>

					</td>
				</tr>
			</table>
			<div style="break-after:page"></div>
		<?php } ?>
		</div>
	</body>

	</html>
	<!-- <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script> -->
	<script type="text/javascript" src="<?= base_url(); ?>assets\js\jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="<?= base_url(); ?>assets\js\jquery-ui.min.js"></script>
	<script type="text/javascript" src="<?= base_url(); ?>assets\js\bootstrap.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			if ($("#page").val() != 'keluar') {
				var css = '@page { size: landscape; }',
					head = document.head || document.getElementsByTagName('head')[0],
					style = document.createElement('style');

				style.type = 'text/css';
				style.media = 'print';

				if (style.styleSheet) {
					style.styleSheet.cssText = css;
				} else {
					style.appendChild(document.createTextNode(css));
				}

				head.appendChild(style);
			}
			window.print();
		})
	</script>
</body>

</html>