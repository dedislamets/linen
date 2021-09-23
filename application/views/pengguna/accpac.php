<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title"> Data Order Accpac</h4>
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
                        <td style="border-top: none;"><input type="text" id="txtCode" disabled="" class="form-control" style="color: #000;" value="<?= $code ?>"></td>
                        <td style="border-top: none;" colspan="5">
                          
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
                        <td><input type="text" disabled="" class="form-control" style="color: #000;" id="txtAwal" value="<?= $awal ?>"></td>
                        <td>End</td>
                        <td><input type="text" disabled="" class="form-control" style="color: #000;" id="txtAkhir" value="<?= $akhir ?>"></td>
                        <td><button  id="btnGo" class="btn btn-purple">Cari</button></td>
                      </tr>
                    </table>   
                  </div>
                </div>
              </div>
            </div>
        </div>
        <h1>Summary</h1>
        <div class="table-responsive" id="ringkas" style="display: block">
          <table id="ViewRingkas" class="table table-striped" >
            <thead class="text-primary">
              <tr>
                <th>
                  Model
                </th>
                <th class="text-left">
                  QTY
                </th>   
              </tr>
            </thead>
            <tbody>
              
            </tbody>
          </table>
        </div>
        
        <div class="row row-xs wd-xl-80p mb-3 mt-5">
          <div class="col-sm-6 col-md-6">
            <h1>Detail <button class="btn btn-indigo btn-rounded" id="btnExport"> <i class="fas fa-download"></i>&nbsp;&nbsp;Download Excel</button></h1>
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
