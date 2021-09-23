<style type="text/css">
  .toolbar{
    display: contents;
  }
  #dealer_chosen {
    width: 50% !important;
  }
</style>
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title" id="title-daftar-cn"> Rekap</h4>
      </div>
      <div class="card-body">

        <div class="row">
          <div class="col-lg-12 col-sm-6">
              <div class="card card-circle-chart" data-background-color="green">
                <div class="card-header text-center">
                      
                </div>
                <div class="card-content">
                  <div class="card card-body bg-gray-500 bd-0">
                    <table class="table" style="color: #fff;">
                      <tr>
                        <td  style="border-top: none;">Campaign</td>
                        <td style="border-top: none;">
                          <select id="campaign" name="campaign" class="dropdown-toggle bs-placeholder btn btn-default btn-block chosen-select" >
                            <?php 
                              foreach($campaign as $row)
                              { 
                                echo '<option value="'.$row->campaignid.'" data-awal="'.$row->awal.'" data-akhir="'.$row->akhir.'">'.$row->campaign.'</option>';
                              }?>
                              
                            </select>
                        </td>
                        <td style="border-top: none;">Start</td>
                        <td style="border-top: none;"><input type="text" disabled="" class="form-control" style="color: #000;" id="txtAwal" value="<?= $awal ?>"></td>
                        <td style="border-top: none;">End</td>
                        <td style="border-top: none;"><input type="text" disabled="" class="form-control" style="color: #000;" id="txtAkhir" value="<?= $akhir ?>"></td>
                        <td style="border-top: none;"><button  id="btnGo" class="btn btn-primary">Cari</button></td>
                      </tr>
                    </table>   
                  </div>
                </div>
              </div>
            </div>
        </div>

        <div class="row">
          <div class="col-md-12 mt-3">
            <div class="row well" style="margin-bottom: 20px;padding: 10px;display: none;">
              <div style="text-align: center;width: 100%">
                <h3>Silahkan lakukan proses untuk semua dealer dibawah dengan klik tombol dibawah ini.</h3>
                <button type="button" class="btn btn-secondary btn-lg" id="btn-proses">Proses</button>
              </div>
            </div>
            <div id="dealer"></div>
            <div id="isi_cn">
              <table id="ViewTable" class="table table-bordered table-hover">
                      <thead>
                        <tr>
                          <th>No PKP</th>
                          <th>Paket ID</th>
                          <th>Customer</th>
                          <th>Nilai CN</th>
                          <th>Qty</th>            
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
  </div>

</div>
<div class="row">
  <div class="col-md-12">
    <div class="card card-circle-chart">
      <div class="card-body">
        <div class="isi">
        
        </div>
      </div>
    </div>
  </div>
</div>