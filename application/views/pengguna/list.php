<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title"> Real Data Accpac Akumulasi</h4>
      </div>
      <div class="card-body">

        <div class="row">
          <div class="col-lg-12 col-sm-6">
              <div class="card card-circle-chart mb-5">
                <div class="card-content">
                  <div class="card card-body bg-gray-200 bd-0">
                    <table class="table" style="color: #fff;">
                      <tr>
                        <td style="border-top: none;">Customer</td>
                        <td style="border-top: none;">
                          <select id="dealer" class="dropdown-toggle bs-placeholder btn btn-default btn-block chosen-select" >
                            <?php 
                              foreach($dealer as $row)
                              { 
                                echo '<option value="'.$row->IDCUST.'">'.$row->NAMECUST.'</option>';
                              }?>
                              
                            </select>
                        </td>
                        <td style="border-top: none;">Code</td>
                        <td style="border-top: none;"><input type="text" id="txtCode" disabled="" class="form-control" style="color: #000;" value=""></td>
                        <td style="border-top: none;" colspan="5">
                          <div class="form-group">
                            <div class="checkbox" style="width: auto;">
                                <input id="chkRingkas" type="checkbox" style="float: left;">
                                <label for="chkRingkas" style="display: grid;">Ringkas</label>
                            </div>
                          </div>
                        </td>
                      </tr>
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
                        <td><input type="text" disabled="" class="form-control" style="color: #000;" id="txtAwal" value=""></td>
                        <td>End</td>
                        <td><input type="text" disabled="" class="form-control" style="color: #000;" id="txtAkhir" value=""></td>
                        <td><button  id="btnGo" class="btn btn-purple">Cari</button></td>
                      </tr>
                    </table>   
                  </div>
                </div>
              </div>
            </div>
        </div>
        <div class="table-responsive" id="detail">
          <table id="ViewTable" class="table table-striped">
            <thead class="text-primary">
              <tr>
                <th>
                  ORDDATE
                </th>
                <th>
                  ORDNUMBER
                </th>
                <th class="text-center">
                  INVNUMBER
                </th>
                <th class="text-left">
                  paketid
                </th>
                <th class="text-left">
                  ITEMNO
                </th>
                <th class="text-left">
                  model
                </th>
                <th class="text-left">
                  QTY
                </th>
                
                
                
            </tr></thead>
            <tbody>
              
            </tbody>
          </table>
        </div>
        <div class="table-responsive" id="ringkas" style="display: none">
          <table id="ViewRingkas" class="table table-striped" >
            <thead class="text-primary">
              <tr>
                <th>
                  Paketid
                </th>
                <th>
                  Model
                </th>
                <th class="text-left">
                  QTY
                </th>
                <th class="text-left">
                  Target
                </th>  
                <th class="text-left">
                  Selisih
                </th>        
              </tr>
            </thead>
            <tbody>
              
            </tbody>
          </table>
        </div>
        <!-- <div class="card-header text-center">
            <h5 class="card-title">Total Qty 5 Unit</h5>
            <p class="description">Monthly sales target</p>
        </div>
        <div class="card-content">
          
        </div> -->
      </div>
    </div>
  </div>

</div>
