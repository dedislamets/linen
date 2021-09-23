<div class="row" id="app">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        
        <h4 class="card-title" ><?= $title ?></h4>
        
      </div>
      <div class="card-body">

        <div class="row">
          <div class="col-lg-12 col-sm-6">
              <div class="card card-circle-chart mb-3" >
                <div class="card-header text-center">
                      <!-- <h5 class="card-title">Dashboard</h5>
                      <p class="description">Monthly sales target</p> -->
                </div>
                <div class="card-content">
                  <table class="table" style="color: #fff;">
                    <tr>
                      <td  style="border-top: none;">Campaign</td>
                      <td style="border-top: none;">
                        <select id="campaign" class="dropdown-toggle bs-placeholder btn btn-default btn-block chosen-select" >
                          <?php 
                            foreach($campaign as $row)
                            { 
                              echo '<option value="'.$row->campaignid.'" data-awal="'.$row->awal.'" data-akhir="'.$row->akhir.'">'.$row->campaign.'</option>';
                            }?>
                            
                          </select>
                      </td>
                      <td style="border-top: none;">Start</td>
                      <td style="border-top: none;width: 135px;"><input type="text" disabled="" class="form-control" style="color: #000;" id="txtAwal" value="<?= $awal ?>"></td>
                      <td style="border-top: none;">End</td>
                      <td style="border-top: none;width: 135px;"><input type="text" disabled="" class="form-control" style="color: #000;" id="txtAkhir" value="<?= $akhir ?>"></td>
                      <td style="border-top: none;"><button  id="btnGo" class="btn btn-secondary btn-rounded"><i class="fas fa-search"></i>&nbsp;&nbsp;Cari</button></td>
                    </tr>

                  </table>   
                </div>
              </div>
            </div>
        </div>
        <div class="table-responsive" id="detail">
          FILTER : <input type="text" value="" id="tags" data-role="tagsinput" id="tags" class="form-control">
          <div class="dt-buttons hidden" id="btnRemoveSelected"  style="float: right;">
            <button class="dt-button" type="button"><span>Hapus Data Dipilih</span></button>
          </div>
          <div class="dt-buttons hidden" id="btnAllSelected"  style="float: right;">
            <button class="dt-button" type="button"><span>Checklist Semua</span></button>
          </div>
          <hr>
          <div class="row row-xs wd-xl-80p mb-3 hidden-log-panel" style="display: none;">
            <div class="col-sm-6 col-md-3">
              <button class="btn btn-success btn-rounded btn-block" id="btnTrfSelected"><i class="fas fa-random"></i>&nbsp;&nbsp;Transfer Log Terpilih</button>
            </div>
            <div class="col-sm-6 col-md-3">
              <button class="btn btn-warning btn-rounded btn-block" id="btnTrfAll"><i class="fas fa-random"></i>&nbsp;&nbsp;Transfer Semua Log</button>
            </div>
            <div class="col-sm-6 col-md-3">
              <button class="btn btn-indigo btn-rounded btn-block" id="btnExport"> <i class="fas fa-download"></i>&nbsp;&nbsp;Download Excel</button>
            </div>
          </div>
          <table id="ViewTable2" class="table table-striped">
            <thead class="text-primary">
              <tr>
                <th>
                  #
                </th>
                <th>
                  Invoice
                </th>
                <th>
                  Kode
                </th>
                <th>
                  Nama Dealer
                </th>
                <th>
                  Value
                </th>  
                <th>
                  Paket ID
                </th>
              </tr>
            </thead>
            <tbody>
              
            </tbody>
            
          </table>
        </div>
      </div>
    </div>
  </div>
  
</div>

<div id="overlay" >
  <div id="text" class="row">
    <div class="col-md-12" style="padding: 0">
      <div class="card-body" style="height: 400px;padding: 0">
         <img style="width: 100%;height: 400px;" src="<?= base_url() ?>assets/img/sonic.gif">
         <div class="text-loading" id="tunggu">Harap Tunggu Proses sedang berlangsung....</div>
         <div class="text-loading" id="selesai" style="color: chartreuse">Proses generate data sudah selesai....</div>
         <div>
           <button id="btnClosed" class="btn btn-purple btn-block">Lihat Data</button>
         </div>
      </div>
    </div>
  </div>
</div>
