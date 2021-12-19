<style type="text/css">
  .kbw-signature { width: 100%; height: 200px;}
  #sig canvas{
    width: 100% !important;
    height: auto;
  }
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
  @media only screen and (max-width: 600px) {
    .card {
      padding: 5px;
    }
    .az-content .container {
      padding-left: 10px;
      padding-right: 10px;
    }
    .az-header{
      display: none;
    }
    .judul{
      text-align: center;
    }
    .table th, .table td {
      padding: 6px 10px;
    }
    .az-content-dashboard {
      padding-top: 0px;
    }
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
<?php if(!empty($this->session->flashdata('message'))): ?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <?php echo $this->session->flashdata('message'); ?>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>
<?php endif; ?>
<div class="card z-depth-0" id="app">
  <div class="card-header back-green" style="color:#fff;background-color: green;">
    <div class="row">
        <div class="col-xl-8">
            <h4 class="judul">Detail Linen Keluar</h4>
        </div>
    </div>
  </div>
  <div class="card-block" style="padding: 10px;">
    <form id="form-wizard" name="form-wizard"  method="POST" action="<?= base_url()?>linenkeluar/savesignature" style="padding-top: 20px;">
      <input type="hidden" name="mode" id="mode" value="<?= $mode ?>">
      <input type="hidden" id="status" name="status" value="<?= $mode=="new" ? "INPUT" : $keluar['STATUS'] ?>">
      
      <table class="table table-bordered" style="margin-bottom: 10px;">
        <tr>
          <td>No Transaksi</td>
          <td width="10px">:</td>
          <td><?= $no_transaksi ?></td>
        </tr>
        <tr>
          <td>Tanggal</td>
          <td width="10px">:</td>
          <td><?= empty($keluar) ? date("m/d/Y") : date("m/d/Y", strtotime($keluar['TANGGAL'])) ?></td>
        </tr>
        <tr>
          <td>PIC</td>
          <td width="10px">:</td>
          <td><?= $keluar['PIC'] ?></td>
        </tr>
        <tr>
          <td>Ruangan</td>
          <td width="10px">:</td>
          <td><?= $keluar['RUANGAN'] ?></td>
        </tr>
        <tr>
          <td>Referensi</td>
          <td width="10px">:</td>
          <td><?= $keluar['NO_REFERENSI'] ?></td>
        </tr>
      </table>
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
      <div class="row" id="barang">
        <input type="hidden" name="id_keluar" id="id_keluar" value="<?= empty($keluar) ? "" : $keluar['id'] ?>">
        <input type="hidden" id="csrf_token" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" >
        <div class="col-sm-12">
          <div class="cards">
            <div class="card card-2" style="width: 100%">
              <h4 style="margin-bottom: 12px;">List Scan</h4>
              <!-- <div class="row">
                <div class="col-sm-2">Total Scan :</div>
                <div class="col-sm-5" id="total_qty">0</div>
                <div class="col-sm-2">Total Berat : </div>
                <div class="col-sm-1" id="total_berat">0</div>
              </div> -->
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
                              Jenis
                            </th>                       
                            <th>
                              Berat
                            </th>
                        </tr>
                    </thead>
                    <tbody id="tbody-table">
                      <tr v-for="(log, index) in list_scan">
                          <td style="width:1%">{{ (index+1) }}</td>
                          <td>{{ log.serial }}</td>
                          <td>{{ log.jenis }}</td>
                          <td>{{ log.berat }}</td>
                      </tr>
                    </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="form-group row pd-t-15">
        <label class="col-sm-2 col-form-label" style="font-weight: bold;">Nama Penerima</label>
        <div class="col-sm-10">
          <input type="text" class="form-control form-bg-inverse" id="penerima" name="penerima" value="<?= $keluar['penerima'] ?>" required >
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
            <label class="" for="" style="font-weight: bold;">Tanda Tangan Penerima:</label>
            <br/>
            <div id="sig" style="<?= (empty($keluar['signature']) ? '' : 'display: none;' ) ?>" ></div>
            <br/>
            <button id="clear" style="<?= (empty($keluar['signature']) ? '' : 'display: none;' ) ?>">Clear Signature</button>
            <textarea id="signature64" name="signed" style="display: none"></textarea><br>
            <?php if(!empty($keluar['signature'])): ?>
              <img class="img-fluid" src="<?= base_url() ?>upload/signature/<?= $keluar['signature'] ?>">
            <?php endif; ?>
        </div>
      </div>
      <?php if(empty($keluar['penerima'])): ?>
      <button class="btn btn-success btn-rounded btn-sm btn-block mg-t-15" id="btnSave" ><i class="fa fa-save"></i> Submit</button>
    <?php endif; ?>
    </form>

  </div>
</div>
<?php
  $this->load->view($modal); 
?>
