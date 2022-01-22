<style type="text/css">
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

  /*html,body{
    width: 100%; 
    min-height: 100vh;
    background-image: linear-gradient(90deg, #414850, #131720);
    color: var(--text-color);
  }
  body{
    display:flex;
    justify-content: center;
    align-items: center;
    padding: 40px 0px;
  }*/
  .main-container {
    padding-bottom: 30px;
  }

  a:hover {
      color: green;
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
    text-align: center;
  }

  .card__apply {
    grid-row: 4/5;
    text-align: center;
  }

  /* CARD BACKGROUNDS */

  .card-1 {
    background: radial-gradient(#1fe4f5, #3fbafe);
    
  }

  .card-2 {
    background: radial-gradient(#fbc1cc, #fa99b2);
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
        <div class="col-xl-10">
            <h4><?= $title ?> <a href="<?= base_url() ?>linenbersih" style="color: #000;margin-left: 10px;"> Back </a></h4>
            <span>Halaman ini menampilkan data linen yang tersimpan</span>
        </div>
        
        <div class="col-xl-2">
          <div class="status-trans"><?= $mode=="new" ? "INPUT" : $bersih['STATUS'] ?></div>
          <input type="hidden" id="status" name="status" value="<?= $mode=="new" ? "INPUT" : $bersih['STATUS'] ?>">
        </div>
    </div>
  </div>
  <div class="card-block" style="padding: 10px;">
    <form id="form-routing" name="form-wizard" action="" method="" style="padding-top: 20px;">
      <input type="hidden" name="mode" id="mode" value="<?= $mode ?>">

      
      <div class="main-container">
        <div class="heading">
          <h2 class="heading__title">Data Linen Kotor</h2>
          
        </div>
        <div class="cards">
          <div class="card card-4">
            <div class="row">
              <div class="col-xl-4">
                <h2 class="card__title">
                  <span><?= empty($kotor) ? "" : $kotor['NO_TRANSAKSI'] ?></span> 
                  <input type="hidden" name="NO_TRANSAKSI" id="NO_TRANSAKSI" value="<?= empty($kotor) ? "" : $kotor['NO_TRANSAKSI'] ?>">
                </h2>
                <p class="card__apply">
                  <a class="card__link" href="#">No Transaksi</a>
                </p>
              </div>
              <div class="col-xl-4">
                <h2 class="card__title">
                  <span><?= empty($kotor) ? "" : $kotor['PIC'] ?></span> 
                </h2>
                <p class="card__apply">
                  <a class="card__link" href="#">PIC Linen Kotor</a>
                </p>
              </div>
              <div class="col-xl-4">
                <h2 class="card__title">
                  <span><?= empty($kotor) ? "" : date("Y-m-d", strtotime($kotor['TANGGAL'])) ?></span> 
                </h2>
                <p class="card__apply">
                  <a class="card__link" href="#">Tanggal Input Linen Kotor</a>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>

      
      <div class="form-group row">
        <label class="col-sm-2 col-form-label" style="font-weight: bold;">TANGGAL </label>
        <div class="col-sm-10">
          <input class="form-control form-bg-inverse" type="text" id="tanggal" name="tanggal" value="<?= empty($bersih) ? date("m/d/Y") : date("m/d/Y", strtotime($kotor['TANGGAL'])) ?>" />
        </div>
      </div>
      
      <div class="form-group row">
        <label class="col-sm-2 col-form-label" style="font-weight: bold;">PIC</label>
        <div class="col-sm-10">
          <select id="pic" name="pic" class="form-control" >
            <?php 
            foreach($pic as $row)
            { 
              if( empty($bersih) ? "" : $bersih['PIC'] === $row->nama_user){
                echo '<option value="'.$row->nama_user.'" selected>'.$row->nama_user.'</option>';
              }else{
                echo '<option value="'.$row->nama_user.'">'.$row->nama_user.'</option>';
              }
              
            }?>
            
          </select>
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2 col-form-label" style="font-weight: bold;">TOTAL QTY</label>
        <div class="col-sm-4">
          <input type="text" class="form-control" readonly id="total_qty" name="total_qty" placeholder="" value="<?= empty($bersih) ? $kotor['TOTAL_QTY'] : $bersih['TOTAL_QTY'] ?>">
        </div>
        <label class="col-sm-2 col-form-label" style="font-weight: bold;">TOTAL BERAT</label>
        <div class="col-sm-4">
          <input type="text" class="form-control" readonly id="total_berat" name="total_berat" placeholder="" value="<?= empty($bersih) ? $kotor['TOTAL_BERAT'] : $bersih['TOTAL_BERAT'] ?>">
        </div>
      </div>
      
      
      <h4 class="info-text" style="margin-top: 30px;padding-left: 00px;">Data Linen</h4>
      <div class="form-group row">
        <div class="col-sm-2">
          <button class="btn btn-success btn-sm btn-block" id="btnScan" ><i class="fa fa-barcode"></i> Start Scan</button>
        </div>
        <?php if($mode == 'new') : ?>
        <div class="col-sm-2">
          <button class="btn btn-success btn-sm btn-block" id="btnStop" ><i class="fa fa-undo"></i> Repeat Scan</button>
        </div>
        <?php endif; ?>
        <div class="col-sm-8">
          <input type="text" class="form-control" readonly id="status_koneksi" name="status_koneksi" placeholder="" >
        </div>
      </div>
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
                        <th>
                          Checked
                        </th>
                    </tr>
                </thead>
                <tbody id="tbody-table">
                    <?php 
                    $urut=1;
                    $detail = $data_detail_kotor;
                    if($mode =="edit"){
                      $detail = $data_detail_bersih;
                    }
                    foreach($detail as $row): ?>
                      <tr>
                        <td style="width:1%"><?=$urut?></td>
                        <td width="110">
                          <input type="hidden" id="id_detail<?=$urut?>" name="id_detail<?=$urut?>" class="form-control hidden" value="<?=$row['id']?>">
                        </td>
                        <td> 
                          <input type="text" name="epc<?=$urut?>" id="epc<?=$urut?>" class="form-control" value="<?=$row['epc']?>" readonly /></td>
                        <td><input type="text" name="jenis<?=$urut?>" id="jenis<?=$urut?>" readonly class="form-control" value="<?=$row['jenis']?>"/></td>
                        <td>
                          <input type="text" readonly name="ruangan<?=$urut?>" id="ruangan<?=$urut?>" class="form-control" value="<?=$row['ruangan']?>"/>
                        </td>
                        <td>
                          <input type="text" id="berat<?=$urut?>" name="berat<?=$urut?>" placeholder="Kg" class="form-control" style="width:100%" value="<?=$row['berat']?>" readonly>
                        </td>
                        <td style="width: 150px;">
                          <input type="hidden" id="checked<?=$urut?>" name="checked<?=$urut?>" data-urut="<?=$urut?>" data-epc="<?=$row['epc']?>" class="form-control" value="1" >
                          <?php if($mode == 'edit'){
                              $class = $read = "";
                              if($row["status_linen"] == "RUSAK"){
                                $class = "non-pointer";
                                $read = "readonly";
                              }
                              echo '<select id="flag'.$urut.'" name="flag'.$urut.'" class="form-control '. $class .'" '. $read .'>';
                              echo '<option value="OK" '. ($row["status_linen"] == "OK" ? "selected" : "") .'>Valid</option>';
                              echo '<option value="RUSAK" '. ($row["status_linen"] == "RUSAK" ? "selected" : "") .'>Rusak</option>';
                              echo '<option value="BARU" '. ($row["status_linen"] == "BARU" ? "selected" : "") .'>Tambahan</option>';
                              echo '<option value="exist" '. ($row["status_linen"] == "exist" ? "selected" : "") .'>InProgress</option>';
                              echo '</select>';
                          } ?>                            
                        </td>
                        <td data-checked="<?=$row['epc']?>" style="text-align: center;">
                          <?php if($mode == 'edit'){
                              if($row["status_linen"] == "OK"){
                                echo '<i class="fa fa-check-circle" style="font-size: 30px;color: green;"></i>';
                              }elseif ($row["status_linen"] == "RUSAK") {
                                echo '<i class="fa fa-times-circle" style="font-size: 30px;color: red;"></i>';
                              }elseif ($row["status_linen"] == "BARU") {
                                echo '<i class="fa fa-plus-circle" style="font-size: 30px;color: orange;"></i>';
                              }elseif ($row["status_linen"] == "exist") {
                                echo '<i class="fa fa-ban" style="font-size: 30px;color: red;"></i>';
                              }
                          } ?>
                        </td>
                      </tr>
                      <?php $urut++?>
                    <?php endforeach; ?>

                </tbody>
            </table>
          </div>
        </div>
      </div>
      
      <div class="row">
        <div class="col-sm-12" style="margin-top: 10px;">
          <input type="hidden" name="id_bersih" id="id_bersih" value="<?= empty($bersih) ? "" : $bersih['id'] ?>">
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
