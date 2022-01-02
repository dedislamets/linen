<style type="text/css">
  .az-traffic-detail-item > div:first-child {
     margin-bottom: 0px; 
  }
  .az-traffic-detail-item {
    padding: 5px;
  }
  .az-traffic-detail-item + .az-traffic-detail-item {
    margin-top: 5px;
  }
</style>

<div class="row" >
  <?php if(!empty($notifikasi)){ ?>
    <div class="col-md-12" id="card-notifikasi">
        <div class="alert alert-info" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
          <strong>Notifikasi</strong> <span id="msg_notif">Anda mempunyai <?= count($notifikasi) ?> notifikasi yang belum dibaca.</span>
        </div>
    </div>

  <?php } ?>
  <div class="col-lg-3 col-md-6 col-sm-6">
    <div class="card card-stats">
      <div class="card-body ">
        <div class="row">
          <div class="col-5 col-md-4">
            <div class="icon-big text-center icon-warning">
              <i class="fa fa-clipboard text-warning"></i>
            </div>
          </div>
          <div class="col-7 col-md-8">
            <div class="numbers">
              <p class="card-category">Total Linen</p>
              <p class="card-title"><?= $total_linen['jml'] ?></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-md-6 col-sm-6">
    <div class="card card-stats">
      <div class="card-body ">
        <div class="row">
          <div class="col-5 col-md-4">
            <div class="icon-big text-center icon-warning">
              <i class="fa fa-database text-danger"></i>
            </div>
          </div>
          <div class="col-7 col-md-8">
            <div class="numbers">
              <p class="card-category">Linen Kotor</p>
              <p class="card-title"><?= $total_kotor['total'] ?></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-md-6 col-sm-6">
    <div class="card card-stats">
      <div class="card-body ">
        <div class="row">
          <div class="col-5 col-md-4">
            <div class="icon-big text-center icon-warning">
              <i class="fa fa-database text-success"></i>
            </div>
          </div>
          <div class="col-7 col-md-8">
            <div class="numbers">
              <p class="card-category">Linen Bersih</p>
              <p class="card-title"><?= $total_bersih['total'] ?></p>
            </div>
          </div>
        </div>
      </div>
      
    </div>
  </div>
  <div class="col-lg-3 col-md-6 col-sm-6">
    <div class="card card-stats">
      <div class="card-body ">
        <div class="row">
          <div class="col-5 col-md-4">
            <div class="icon-big text-center icon-warning">
              <i class="fa fa-random text-primary"></i>
            </div>
          </div>
          <div class="col-7 col-md-8">
            <div class="numbers">
              <p class="card-category">Linen Keluar</p>
              <p class="card-title"><?= $total_keluar['total'] ?></p>
            </div>
          </div>
        </div>
      </div>
      
    </div>
  </div>
</div>
<div class="row row-sm mg-b-20 mg-lg-b-0 mg-t-20">
  <?php if($jemput_count>0 && ($this->session->userdata('role') == "Administrator" && $this->session->userdata('role') == "Unit Laundry")): ?> 
  <div class="col-md-6 col-xl-12">
    <div class="card card-table-two">
      <h6 class="card-title">Permintaan Jemput</h6>
      <span class="d-block mg-b-20">Segera proses permintaan dari ruangan berikut</span>
      <div class="table-responsive">
        <table class="table table-striped table-dashboard-two">
          <thead>
            <tr>
              <th class="wd-lg-25p">Tanggal</th>
              <th class="wd-lg-25p tx-right">No Jemput</th>
              <th class="wd-lg-25p tx-right">Ruangan</th>
              <th class="wd-lg-25p tx-right">Requestor</th>

            </tr>
          </thead>
          <tbody>
            <?php 
            foreach($jemput as $row) : ?>
            <tr>
              <td><?= $row->created_date ?></td>
              <td class="tx-right tx-medium tx-inverse">
                <a href="javascript:void(0)" onclick="editModal(this)" data-id="<?= $row->id ?>" style="font-weight:500;"><?= $row->no_request ?></a>
              </td>
              <td class="tx-right tx-medium tx-inverse"><?= $row->ruangan ?></td>
              <td class="tx-right tx-medium tx-inverse"><?= $row->requestor ?></td>

            </tr>
            <?php endforeach; ?>
            
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <?php endif; ?>
  <div class="col-md-6 col-xl-12">
    <div class="card card-table-two">
      <h6 class="card-title">Permintaan Linen Jenis Baru</h6>
      <span class="d-block mg-b-20">butuh evaluasi anda</span>
      <div class="table-responsive">
        <table class="table table-striped table-dashboard-two">
          <thead>
            <tr>
              <th class="wd-lg-25p">Tanggal</th>
              <th class="wd-lg-25p tx-right">No Transaksi</th>
              <th class="wd-lg-25p tx-right">Ruangan</th>
              <th class="wd-lg-25p tx-right">Requestor</th>
              <th class="wd-lg-25p tx-right">Tipe Linen</th>
              <th class="wd-lg-25p tx-right">Jenis</th>
              <th class="wd-lg-25p tx-right">Qty</th>

            </tr>
          </thead>
          <tbody>
            <?php 
            foreach($pengajuan_linen_baru as $row) : ?>
            <tr>
              <td><?= $row->tgl_request ?></td>
              <td class="tx-right tx-medium tx-inverse">
                <a href="<?= base_url() ?>newrequest/edit/<?= $row->no_request ?>" style="font-weight:500;"><?= $row->no_request ?></a>
              </td>
              <td class="tx-right tx-medium tx-inverse"><?= $row->ruangan ?></td>
              <td class="tx-right tx-medium tx-inverse"><?= $row->requestor ?></td>
              <td class="tx-right tx-medium tx-danger"><?= $row->jenis_linen ?></td>
              <td class="tx-right tx-medium tx-danger"><?= $row->jenis ?></td>
              <td class="tx-right tx-medium tx-danger"><?= $row->qty ?></td>

            </tr>
            <?php endforeach; ?>
            
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<div class="row row-sm mg-b-20 mg-t-20">
  <div class="col-lg-4">
    <div class="card card-table-one" style="max-height: 400px;">
      <h6 class="card-title">Pemakaian Linen</h6>
      <!-- <p class="az-content-text mg-b-20">Part of this date range occurs before the new users metric had been calculated, so the old users metric is displayed.</p> -->
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th class="wd-50p">Ruangan</th>
              <th style="text-align: right;">Total Linen</th>
             
            </tr>
          </thead>
          <tbody>
            <?php 
            foreach($ruangan as $row)
            { ?>
              <tr>
                <td><strong><?= $row->ruangan ?></strong></td>
                <td style="text-align: right;"><strong><?= $row->total ?></strong></td>
              </tr>
            <?php
            }
            ?>
            
            
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="col-lg-8 mg-t-20 mg-lg-t-0">
    <div class="card card-dashboard-four">
      <div class="card-header">
        <h6 class="card-title">Room Request Linen</h6>
      </div>
      <div class="card-body row">
        <div class="col-md-6 d-flex align-items-center">
          <div class="chart"><canvas id="chartDonut"></canvas></div>
        </div>
        <div class="col-md-6 col-lg-5 mg-lg-l-auto mg-t-20 mg-md-t-0" >
          <h6 class="card-title" style="padding-bottom: 10px;">Jumlah Request</h6>
          <?php 
          foreach($data_req_chart as $row): ?>
          <div class="az-traffic-detail-item" style="background-color: <?= $row['backgroundColor'] ?>">
            <div>
              <span><?= $row['ruangan'] ?></span>
              <span><?= $row['jml'] ?></span>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row row-sm mg-b-20 mg-lg-b-0">
  <div class="col-md-6 col-xl-7">
    <div class="card card-table-two">
      <h6 class="card-title">Umur Linen Keluar</h6>
      <span class="d-block mg-b-20">Hanya menampilkan 10 data teratas</span>
      <div class="table-responsive">
        <table class="table table-striped table-dashboard-two">
          <thead>
            <tr>
              <th class="wd-lg-25p">Tanggal</th>
              <th class="wd-lg-25p tx-right">Ruangan</th>
              <th class="wd-lg-25p tx-right">No Transaksi</th>
              <th class="wd-lg-25p tx-right">Jenis</th>
              <th class="wd-lg-25p tx-right">Serial</th>
              <th class="wd-lg-25p tx-right">Hari</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            foreach($data_umur_keluar as $row) : ?>
            <tr>
              <td><?= $row->TANGGAL ?></td>
              <td class="tx-right tx-medium tx-inverse"><?= $row->RUANGAN ?></td>
              <td class="tx-right tx-medium tx-inverse"><?= $row->no_transaksi ?></td>
              <td class="tx-right tx-medium tx-inverse"><?= $row->jenis ?></td>
              <td class="tx-right tx-medium tx-danger"><?= $row->epc ?></td>
              <td class="tx-right tx-medium tx-danger"><?= $row->umur ?></td>
            </tr>
            <?php endforeach; ?>
            
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-xl-5 mg-t-20 mg-md-t-0">
    <div class="card card-dashboard-eight">
      <h6 class="card-title">Riwayat Linen Rusak</h6>
      <hr>
      <div class="table-responsive">
        <table class="table table-striped table-dashboard-two">
          <thead>
            <tr>
              <th class="wd-lg-25p">Defect</th>
              <th class="wd-lg-25p tx-right">Total</th>
              
            </tr>
          </thead>
          <tbody>
            <?php 
            foreach($defect as $row) : ?>
            <tr>
              <td><?php echo $row->defect ?></td>
              <td class="tx-right tx-medium tx-inverse"><?php echo $row->jml ?></td>
            </tr>
            <?php endforeach; ?>  
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<?php
  if(isset($modal))
    $this->load->view($modal); 
?>
