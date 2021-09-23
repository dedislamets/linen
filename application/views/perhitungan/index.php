<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title"> <?= $title ?></h4>
      </div>
      <div class="card-body">

        <div class="row">
          <div class="col-lg-12 col-sm-6">
              <div class="card card-circle-chart mb-5">
                <div class="card-content">
                  <div class="card card-body bg-gray-200 bd-0">
                    <table class="table" style="color: #fff;">
                      
                      <tr>
                        <td>Campaign</td>
                        <td>
                          <select id="campaign" class="dropdown-toggle bs-placeholder btn btn-default btn-block chosen-select" >
                            <?php 
                              foreach($campaign as $row)
                              { 
                                echo '<option value="'.$row->campaignid.'" data-awal="'.$row->awal.'" data-akhir="'.$row->akhir.'">'.$row->campaign.'</option>';
                              }?>
                              
                            </select>
                        </td>
                        <td>Start</td>
                        <td><input type="text" disabled="" class="form-control" style="color: #000;" id="txtAwal" value="<?= $awal ?>"></td>
                        <td>End</td>
                        <td><input type="text" disabled="" class="form-control" style="color: #000;" id="txtAkhir" value="<?= $akhir ?>"></td>
                        
                      </tr>
                      <tr>
                        <td>Paket ID</td>
                        <td>
                          <select id="paketid" class="dropdown-toggle bs-placeholder btn btn-default btn-block chosen-select" >
                            
                          </select>
                        </td>
                        <td colspan="4"><button  id="btnGo" class="btn btn-purple btn-block">Generate Log</button></td>
                      </tr>
                    </table>   
                  </div>
                </div>
              </div>
            </div>
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
