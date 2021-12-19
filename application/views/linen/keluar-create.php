<style type="text/css">
  .error-text {
    color: red;
    border: solid 1px red;
  }
  .scan-text {
    color: blue;
    border: solid 1px blue;
  }
  .non-pointer {
    pointer-events: none;
  }
  #ViewTableKotor {
    width: 100% !important;
  }

  @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap');
  *, button, input{
  margin: 0px;
  padding: 0px;
  box-sizing: border-box;
    
    font-family: 'Roboto', sans-serif;
  }

  :root{
    --bg-shape-color:linear-gradient(120deg,  #343A4F, #0F1620) ;
   --lightblue: #3D9DEA;
   --darkblue: #4A4EEE;
   --text-color: #D5E1EF;
  }
  .main-container {
    padding-bottom: 30px;
  }

  a:hover {
      color: green;
  }
  .text-primary {
    background-color: #4C9F50;
    color: #fff;
  }

  .table thead th, .table thead td {
    color: #fff;
    padding: 10px;
  }

  /* HEADING */

  .heading {
    text-align: center;
  }

  .heading__title {
    font-weight: 600;

  }

  .heading__credits {
    color: #888888;
    font-size: 18px;
    transition: all 0.5s;
  }

  .heading__link {
    text-decoration: none;
  }

  .heading__credits .heading__link {
    color: inherit;
  }

  /* CARDS */

  .cards {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
  }

  .card {
    font-family: 'Poppins', sans-serif;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0px 6px 10px rgba(0, 0, 0, 0.25);
    transition: all 0.2s;
  }

  .card:hover {
    box-shadow: 0px 6px 10px rgba(0, 0, 0, 0.4);
    /*transform: scale(1.01);*/
  }

  .card__link,
  .card__exit,
  .card__icon {
    position: relative;
    text-decoration: none;
    color: rgba(255, 255, 255, 0.8);
  }

  .card__link::after {
    position: absolute;
    top: 25px;
    left: 0;
    content: "";
    width: 0%;
    height: 3px;
    background-color: rgba(255, 255, 255, 0.6);
    transition: all 0.5s;
  }

  .card__link:hover::after {
    width: 100%;
  }

  .card__exit {
    grid-row: 1/2;
    justify-self: end;
  }

  .card__icon {
    grid-row: 2/3;
    font-size: 30px;
  }

  .card__title {
    grid-row: 3/4;
    font-weight: 400;
    color: #ffffff;
    margin-bottom: 0;
  }

  /*.card__apply {
    grid-row: 4/5;
  }*/

  /* CARD BACKGROUNDS */

  .card-1 {
    background: radial-gradient(#a8e063, #56ab2f);
    
  }

  .card-2 {
    background: radial-gradient(#00B4DB, #0083B0);
  }

  .card-3 {
    background: radial-gradient(#76b2fe, #b69efe);
  }

  .card-4 {
    background: radial-gradient(#60efbc, #58d5c9);
    width: 100%;
  }

  .card-5 {
    background: radial-gradient(#f588d8, #c0a3e5);
  }
</style>

<div class="card z-depth-0" id="app">
  <?php include("application/views/Browser.php");
  $browser = new Browser();
  if( $browser->getBrowser() != Browser::BROWSER_IE ) : ?>
  <div class="alert alert-solid-danger mg-b-10 animate__animated animate__bounce animate__infinite" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">×</span>
    </button>
    <strong>Peringatan !</strong> Halaman ini diharuskan menggunakan browser Internet Explorer dikarenakan terdapat Engine yang hanya support pada browser IE saja.
  </div>
  <?php endif; ?>
  <div class="card-header back-green" style="color:#fff;background-color: green;">
    <div class="row">
        <div class="col-xl-8">
            <h4><?= $title ?> <a href="<?= base_url() ?>linenkeluar" style="color: #000;margin-left: 10px;"> Back </a></h4>
            <span>Halaman ini menampilkan data linen yang tersimpan</span>
        </div>
        
        <div class="col-xl-2">
          <div class="status-trans"><?= $mode=="new" ? "INPUT" : $keluar['STATUS'] ?></div>
        </div>
        <div class="col-xl-2">
          <button class="btn btn-success btn-block" id="btnCetak" ><i class="fa fa-print"></i>&nbsp; Print</button>
        </div>
    </div>
  </div>
  <div class="card-block" style="padding: 10px;">
    <form id="form-keluar" name="form-wizard" action="" method="" style="padding-top: 20px;">
      <input type="hidden" name="mode" id="mode" value="<?= $mode ?>">
      <input type="hidden" id="status" name="status" value="<?= $mode=="new" ? "INPUT" : $keluar['STATUS'] ?>">
      <div class="form-group row">
        <label class="col-sm-2 col-form-label" style="font-weight: bold;">NO TRANSAKSI</label>
        <div class="col-sm-10">
          <input type="text" class="form-control form-bg-inverse" id="no_transaksi" name="no_transaksi" value="<?= $no_transaksi ?>" required readonly >
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2 col-form-label" style="font-weight: bold;">TANGGAL </label>
        <div class="col-sm-10">
          <input class="form-control form-bg-inverse" type="text" id="tanggal" name="tanggal" value="<?= empty($keluar) ? date("m/d/Y") : date("m/d/Y", strtotime($keluar['TANGGAL'])) ?>" />
        </div>
      </div>
      
      <div class="form-group row">
        <label class="col-sm-2 col-form-label" style="font-weight: bold;">PIC</label>
        <div class="col-sm-10">
          <select id="pic" name="pic" class="form-control" >
            <?php 
            foreach($pic as $row)
            { 
              if( empty($keluar) ? "" : $keluar['PIC'] === $row->nama_user){
                echo '<option value="'.$row->nama_user.'" selected>'.$row->nama_user.'</option>';
              }else{
                echo '<option value="'.$row->nama_user.'">'.$row->nama_user.'</option>';
              }
              
            }?>
            
          </select>
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2 col-form-label" style="font-weight: bold;">Ruangan</label>
        <div class="col-sm-10">
          <select id="ruangan" name="ruangan" class="form-control" >
            <?php 
            foreach($ruangan as $row)
            { 
              if( empty($keluar) ? "" : $keluar['RUANGAN'] === $row->ruangan){
                echo '<option value="'.$row->ruangan.'" selected>'.$row->ruangan.'</option>';
              }else{
                echo '<option value="'.$row->ruangan.'">'.$row->ruangan.'</option>';
              }
              
            }?>
            
          </select>
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2 col-form-label" style="font-weight: bold;">No Referensi</label>
        <div class="col-sm-10">

          <div class="input-group input-group-button m-b-0" >

            <input type="text" class="form-control" id="no_referensi" name="no_referensi" value="<?= empty($keluar) ? "" : $keluar['NO_REFERENSI'] ?>" readonly>
            <span class="input-group-addon btn btn-grd-inverse" id="btnBrowse" style="border-width: 0;background-color: #01a9ac;" >
              <span class="">Browse..</span>
            </span>
          </div>
        </div>
      </div> 
      <div class="row">
        <div class="col-sm-12">
          <div class="cards">
            <div class="card card-1" style="width: 100%;margin-bottom: 15px;">
              <h4 style="margin-bottom: 12px;">List Request</h4>
              <div class="dt-responsive table-responsive table-brg" style="min-height: 50px;">
                  <input type="hidden" id="total-row" name="total-row" value="<?= $totalrow ?>">
                  <table id="ViewTableListRequest" class="table " style="margin-top: 0 !important;width: 100% !important;">
                      <thead class="text-primary">
                          <tr>
                              <th>
                                No
                              </th>                      
                              <th>
                                Jenis
                              </th>
                              <th>
                                Qty
                              </th>                       
                              <th>
                                Ready
                              </th>
                          </tr>
                      </thead>
                      <tbody id="tbody-table">
                        <tr v-for="(log, index) in list_request">
                            <td style="width:1%">{{ (index+1) }}</td>
                            <td>{{ log.jenis }}</td>
                            <td>{{ log.qty }}</td>
                            <td>{{ log.ready }}</td>
                        </tr>
                      </tbody>
                  </table>
                </div>
            </div>
            
          </div>
        </div>
      </div>
      <input type="hidden" name="id_keluar" id="id_keluar" value="<?= empty($keluar) ? "" : $keluar['id'] ?>">
      <input type="hidden" id="csrf_token" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" >
      <div class="form-group row" style="margin-top: 10px;">
        <?php if(empty($keluar['signature'])): ?>
          <div class="col-sm-2">
            <button class="btn btn-success btn-sm btn-block" id="btnScan" ><i class="fa fa-barcode"></i> Start Scan</button>
          </div>
          <?php if($mode == 'new') : ?>
          <div class="col-sm-2">
            <button class="btn btn-success btn-sm btn-block" id="btnStop" ><i class="fa fa-undo"></i> Repeat Scan</button>
          </div>
          <?php endif; ?>
        
          <div class="col-sm-2">
            
            <button class="btn btn-success btn-sm btn-block" id="btnSave" ><i class="fa fa-save"></i> Simpan</button>
          </div>
          <div class="col-sm-6">
            <input type="text" class="form-control" readonly id="status_koneksi" name="status_koneksi" placeholder="" >
          </div>
        <?php endif; ?>

      </div>
      <div class="row" id="barang">
       
        <div class="col-sm-12">
          <div class="cards">
            <div class="card card-2" style="width: 100%">
              <h4 style="margin-bottom: 12px;">List Scan</h4>
              <div class="row">
                <div class="col-sm-2">Total Scan :</div>
                <div class="col-sm-5" id="total_qty">0</div>
                <div class="col-sm-2">Total Berat : </div>
                <div class="col-sm-1" id="total_berat">0</div>
              </div>
              <div class="dt-responsive table-responsive table-brg" style="min-height: 50px;">
                <input type="hidden" id="total-row" name="total-row" value="<?= $totalrow ?>">
                <table id="ViewTableBrg" class="table" style="margin-top: 0 !important;width: 100% !important;">
                    <thead class="text-primary">
                        <tr>
                            <th>
                              No
                            </th>                      
                            <th>
                              Serial/EPC
                            </th>
                            <th>
                              Nama Barang
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
                      <tr v-for="(log, index) in list_scan">
                          <td style="width:1%">{{ (index+1) }}</td>
                          <td>{{ log.serial }}</td>
                          <td>{{ log.jenis }}</td>
                          <td>{{ log.berat }}</td>
                          <td>{{ log.status }}</td>
                      </tr>
                    </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php if(!empty($keluar['signature'])): ?>
        <table class="table table-bordered mg-t-15">
          <tr>
            <td style="width:300px;">Diterima Tanggal</td>
            <td width="10">:</td>
            <td><?= empty($keluar) ? "" : tgl_waktu_indo($keluar['tgl_terima']) ?></td>
          </tr>
          <tr>
            <td style="width:300px;">Diterima Oleh</td>
            <td width="10">:</td>
            <td><?= empty($keluar) ? "" : $keluar['penerima'] ?></td>
          </tr>
          <tr>
            <td style="width:300px;">Signature</td>
            <td width="10">:</td>
            <td>
              <?php if(!empty($keluar['signature'])): ?>
                <img src="<?= base_url() ?>/upload/signature/<?= $keluar['signature'] ?>" style="width: 400px;">
              <?php endif; ?>
            </td>
          </tr>
        </table>
      <?php endif; ?>
    
    </form>

  </div>
</div>
<?php
  $this->load->view($modal); 
?>
