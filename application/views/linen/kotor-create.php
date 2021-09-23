<div class="card z-depth-0">
  <? include("application/views/Browser.php");
  $browser = new Browser();
  if( $browser->getBrowser() != Browser::BROWSER_IE ) : ?>
  <div class="alert alert-solid-danger mg-b-10 animate__animated animate__bounce animate__infinite" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">×</span>
    </button>
    <strong>Peringatan !</strong> Halaman ini diharuskan menggunakan browser Internet Explorer dikarenakan terdapat Engine yang hanya support pada browser IE saja.
  </div>
  <? endif; ?>
  <div class="card-header back-green" style="color:#fff;background-color: green !important;">
    <div class="row">
        <div class="col-xl-10">
            <h4><?= $title ?> <a href="<?= base_url() ?>linenkotor" style="color: #000;margin-left: 10px;"> Back </a></h4>
            <span>Halaman ini menampilkan data connote yang tersimpan</span>
        </div>
        
        <div class="col-xl-2">
          <div class="status-trans"><?= empty($data) ? "INPUT" : $data['STATUS'] ?></div>
        </div>
    </div>
  </div>
  <div class="card-block" style="padding: 10px;">
    <form id="form-routing" name="form-wizard" action="" method="" style="padding-top: 20px;">
      <input type="hidden" name="mode" id="mode" value="<?= $mode ?>">

      <div class="form-group row">
        <label class="col-sm-2 col-form-label" style="font-weight: bold;">NO TRANSAKSI</label>
        <div class="col-sm-10">
          <input type="text" class="form-control form-bg-inverse" id="no_transaksi" name="no_transaksi" value="<?= $no_transaksi ?>" required readonly >
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2 col-form-label" style="font-weight: bold;">TANGGAL </label>
        <div class="col-sm-10">
          <input class="form-control form-bg-inverse" type="date" id="tanggal" name="tanggal" value="<?= date("m/d/Y") ?>" />
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2 col-form-label" style="font-weight: bold;">KATEGORI</label>
        <div class="col-sm-10">
          <select name="kategori" id="kategori" class="form-control">
            <?php 
            foreach($kategori as $row)
            { 
              if( empty($data) ? "" : $data['KATEGORI'] === $row->kategori){
                echo '<option value="'.$row->kategori.'" selected >'.$row->kategori.'</option>';
              }else{
                echo '<option value="'.$row->kategori.'">'.$row->kategori.'</option>';
              }
            }
            ?>
          </select>
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2 col-form-label" style="font-weight: bold;">PIC</label>
        <div class="col-sm-10">
          <select id="pic" name="pic" class="form-control" >
            <?php 
            foreach($pic as $row)
            { 
              echo '<option value="'.$row->nama_user.'">'.$row->nama_user.'</option>';
            }?>
            
          </select>
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2 col-form-label" style="font-weight: bold;">TOTAL QTY</label>
        <div class="col-sm-4">
          <input type="text" class="form-control" readonly id="total_qty" name="total_qty" placeholder="" value="0">
        </div>
        <label class="col-sm-2 col-form-label" style="font-weight: bold;">TOTAL BERAT</label>
        <div class="col-sm-4">
          <input type="text" class="form-control" readonly id="total_berat" name="total_berat" placeholder="" value="0">
        </div>
      </div>

      <h4 class="info-text" style="margin-top: 30px;padding-left: 00px;">Data Linen</h4>
      <div class="form-group row">
        <div class="col-sm-2">
          <button class="btn btn-success btn-sm btn-block" id="btnScan" ><i class="fa fa-search"></i> Start Scan</button>
        </div>
        <div class="col-sm-2">
          <button class="btn btn-success btn-sm btn-block" id="btnStop" ><i class="fa fa-undo"></i> Clear Scan</button>
        </div>
        <div class="col-sm-8">
          <input type="text" class="form-control" readonly id="status_koneksi" name="status_koneksi" placeholder="" >
        </div>
      </div>

 
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
            
                </tbody>
            </table>
          </div>
        </div>
      </div>
      
      <div class="row">
        <div class="col-sm-12" style="margin-top: 10px;">
          <input type="hidden" name="id_kotor" id="id_kotor" value="">
          <input type="hidden" id="csrf_token" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" >

          <button class="btn btn-block btn-success" id="btn-finish" v-if="last_status != 'CLOSED'"><i class="fa fa-save"></i>&nbsp; Simpan</button>
        </div>
      </div>
    
    </form>

  </div>
</div>
<?php
  $this->load->view($modal); 
?>
