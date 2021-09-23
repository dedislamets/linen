<div class="row" id="app">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        
        <h4 class="card-title" >Dealer Terdaftar</h4>
        
      </div>
      <div class="card-body">

        <div class="row">
          <div class="col-lg-12 col-sm-6">
              <div class="card card-circle-chart mb-5" >
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
        <div class="table-responsive" id="detail">
          <table id="ViewTable2" class="table table-striped">
            <thead class="text-primary">
              <tr>
                <th>
                  Paket ID
                </th>
                <th>
                  Kode
                </th>
                <th>
                  Nama Dealer
                </th>  
              </tr>
            </thead>
            <tbody>
              
            </tbody>
            <tfoot>
              <tr>
                <th>Paket ID</th>
                <th>Kode</th>
                <th>Nama Dealer</th>  
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
  </div>
  
</div>
