<style type="text/css">
  .dua-rts {
    width: 200px;
  }
</style>
<div class="card z-depth-0" id="app">
  <?php include("application/views/Browser.php");
  $browser = new Browser();
  if ($browser->getBrowser() != Browser::BROWSER_IE && $data['STATUS'] != "BERSIH") { ?>
    <!-- <div class="alert alert-solid-danger mg-b-10 animate__animated animate__bounce animate__infinite" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">×</span>
    </button>
    <strong>Peringatan !</strong> Halaman ini diharuskan menggunakan browser Internet Explorer dikarenakan terdapat Engine yang hanya support pada browser IE saja.
  </div> -->
  <?php } ?>
  <div class="card-header back-green" style="color:#fff;background-color: green;">
    <div class="row">
      <div class="col-xl-8">
        <h4><?= $title ?> <a href="<?= base_url() ?>linenkotor" style="color: #000;margin-left: 10px;"> Back </a></h4>
        <span>Halaman ini menampilkan data connote yang tersimpan</span>
      </div>
      <!-- <div class="col-xl-2" >
          <a v-if="mode == 'edit'" href="<?= base_url() ?>cetak/rs?id=<?= empty($data) ? "" : $data['id'] ?>" id="btnCetak" class="btn btn-block btn-warning" target="_blank">  <i class="icofont icofont-print" ></i>Cetak</a>
        </div>
 -->
      <div class="col-xl-2">
        <div class="status-trans rounded-10"><?= empty($data) ? "INPUT" : $data['STATUS'] ?></div>
      </div>
      <div class="col-xl-2">
        <button class="btn btn-success btn-block" id="btnCetak"><i class="fa fa-print"></i>&nbsp; Print</button>
      </div>
    </div>
  </div>
  <div class="card-block" style="padding: 10px;">
    <form id="form-routing" name="form-wizard" action="" method="" style="padding-top: 10px;">
      <input type="hidden" name="mode" id="mode" value="<?= $mode ?>">
      <div class="card card-body bg-gray-100 bd-1 rounded-10 pd-20">
        <div class="row">
          <div class="col-md-6 col-12">
            <div class="form-group row">
              <label class="col-sm-4 col-form-label" style="font-weight: bold;">NO TRANSAKSI</label>
              <div class="col-sm-8">
                <input type="text" class="form-control form-bg-inverse" id="no_transaksi" name="no_transaksi" value="<?= empty($data) ? "" : $data['NO_TRANSAKSI'] ?>" required readonly>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-4 col-form-label" style="font-weight: bold;">TANGGAL</label>
              <div class="col-sm-8">
                <input class="form-control form-bg-inverse" type="date" id="tanggal" name="tanggal" value="<?= empty($data) ? "" : date("Y-m-d", strtotime($data['TANGGAL'])) ?>" />
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-4 col-form-label" style="font-weight: bold;">PIC</label>
              <div class="col-sm-8">
                <select id="pic" name="pic" class="form-control">
                  <?php
                  foreach ($pic as $row) {

                    if (empty($data) ? "" : $data['PIC'] === $row->nama_user) {
                      echo '<option value="' . $row->nama_user . '" selected >' . $row->nama_user . '</option>';
                    } else {
                      echo '<option value="' . $row->nama_user . '">' . $row->nama_user . '</option>';
                    }
                  } ?>

                </select>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-12">
            <div class="form-group row">
              <label class="col-sm-4 col-form-label" style="font-weight: bold;">INFEKSIUS</label>
              <div class="col-sm-8">
                <select id="f_infeksius" name="f_infeksius" class="form-control">
                  <option value="Infeksius" <?= ($data['PIC'] == "Infeksius" ? "selected" : "")  ?>>Infeksius</option>
                  <option value="Non Infeksius" <?= ($data['PIC'] == "Non Infeksius" ? "selected" : "")  ?>>Non Infeksius</option>
                </select>
              </div>
            </div>
            <div class="form-group row">

              <label class="col-sm-4 col-form-label" style="font-weight: bold;">JENIS CUCIAN</label>
              <div class="col-sm-8">
                <select id="kategori" name="kategori" class="form-control">
                  <option value="Cuci Normal">Cuci Normal</option>
                  <option value="Rewash">Rewash</option>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-4 col-form-label" style="font-weight: bold;">BERAT TIMBANG</label>
              <div class="col-sm-3">
                <input type="text" class="form-control" id="total_berat_real" name="total_berat_real" placeholder="" value="<?= empty($data) ? "" : $data['TOTAL_BERAT_REAL'] ?>">
              </div>
              <label class="col-sm-2 col-form-label" style="font-weight: bold;">BERAT</label>
              <div class="col-sm-3">
                <input type="text" class="form-control" readonly id="total_berat" name="total_berat" placeholder="" value="<?= empty($data) ? "" : $data['TOTAL_BERAT'] ?>">
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-7">
          <h4 class="info-text" style="margin-top: 30px;padding-left: 00px;">Data Linen</h4>
        </div>
        <div class="col-sm-3">
          <h4 class="info-text" style="margin-top: 30px;text-align: right;">Total Qty</h4>
        </div>
        <div class="col-sm-2" style="margin-top: 30px;">
          <input type="text" class="form-control" style="text-align: center;" readonly id="total_qty" name="total_qty" placeholder="" value="0">
        </div>
      </div>
      <?php if (!empty($data) && $data['STATUS'] == "CUCI") : ?>
        <div class="form-group row">
          <!-- <div class="col-sm-2">
          <button class="btn btn-success btn-sm btn-block" id="btnAdd" ><i class="fa fa-plus"></i> Tambah baru</button>
        </div>
        <div class="col-sm-2">
          <button class="btn btn-success btn-sm btn-block" id="btnScan" ><i class="fa fa-search"></i> Start Scan</button>
        </div>
        <div class="col-sm-2" v-if="mode != 'edit'">
          <button class="btn btn-success btn-sm btn-block" id="btnStop" ><i class="fa fa-undo"></i> Clear Scan</button>
        </div> -->
          <div class="col-sm-4">
            <input type="text" class="form-control" id="txt_scan" name="txt_scan" placeholder="Ketikan Kode EPC" value="">
          </div>
          <div class="col-sm-2">
            <button type="button" class="btn btn-success btn-sm btn-block" id="btnVB">Cek Data API</button>
          </div>
          <div class="col-sm-6">
            <input type="text" class="form-control" readonly id="status_koneksi" name="status_koneksi" placeholder="">
          </div>
        </div>
      <?php endif; ?>

      <div class="row" id="barang">

        <div class="col-sm-12">
          <div class="dt-responsive table-responsive table-brg">
            <input type="hidden" id="total-row" name="total-row" value="<?= $totalrow ?>">
            <table id="ViewTableBrg" class="table table-striped" style="margin-top: 0 !important;width: 100% !important;">
              <thead class="text-primary">
                <tr>
                  <th>
                    No
                  </th>
                  <th>
                    Aksi
                  </th>
                  <th>
                    Serial/EPC
                  </th>
                  <th>
                    Nama Barang
                  </th>
                  <th>
                    Ruangan
                  </th>
                  <th>
                    Berat Kg
                  </th>
                  <th>
                    Status
                  </th>

                </tr>
              </thead>
              <tbody id="tbody-table">
                <?php
                $urut = 1;
                foreach ($data_detail as $row): ?>
                  <tr>
                    <td style="width:1%"><?= $urut ?></td>
                    <td v-bind:class="[last_status == 'CUCI' ? 'dua-rts' : '', '']" style="width: 120px;">
                      <input type="hidden" id="id_detail<?= $urut ?>" name="id_detail<?= $urut ?>" class="form-control hidden" value="<?= $row['id'] ?>">
                      <!-- <a href="#" id="cari<?= $urut ?>" class="btn hor-grd btn-success" onclick="cari_dealer(this)" v-if="last_status != 'BERSIH'">
                            <i class="fa fa-search"></i>&nbsp; Cari
                          </a> -->
                      <!-- <a href="javascript:void(0)" class="btn hor-grd btn-danger" onclick="cancel(this)" v-if="last_status != 'BERSIH'"><i class="fa fa-trash"></i>&nbsp; Del</a> -->
                    </td>
                    <td>
                      <input type="text" name="epc<?= $urut ?>" id="epc<?= $urut ?>" class="form-control" value="<?= $row['epc'] ?>" readonly />
                    </td>
                    <td><input type="text" name="jenis<?= $urut ?>" id="jenis<?= $urut ?>" readonly class="form-control" value="<?= $row['jenis'] ?>" /></td>
                    <td>
                      <input type="text" readonly name="ruangan<?= $urut ?>" id="ruangan<?= $urut ?>" class="form-control" value="<?= $row['ruangan'] ?>" />
                    </td>
                    <td>
                      <input type="text" id="berat<?= $urut ?>" name="berat<?= $urut ?>" placeholder="Kg" class="form-control" style="width:100%" value="<?= $row['berat'] ?>" readonly>
                    </td>
                    <td>
                      <?= $row['status']['STATUS'] ?>
                    </td>
                  </tr>
                  <?php $urut++ ?>
                <?php endforeach; ?>

              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-12" style="margin-top: 10px;">
          <input type="hidden" name="id_kotor" id="id_kotor" value="<?= empty($data) ? "" : $data['id'] ?>">
          <input type="hidden" id="csrf_token" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
          <?php if (!empty($data) && $data['STATUS'] == "CUCI") { ?>
            <!-- <button type="button" class="btn btn-block btn-success" id="btn-finish" v-if="last_status != 'CLOSED'"><i class="fa fa-save"></i>&nbsp; Simpan</button> -->
          <?php } ?>
        </div>
      </div>

    </form>

  </div>
</div>
<?php
$this->load->view($modal);
?>