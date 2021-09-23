<div class="container mn-ht-100p">
  <div class="content-wrapper w-100">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title"> Log CN</h4>
          </div>
          <div class="card-body">

            <div class="row">
              <div class="col-lg-12 col-sm-6">
                  <div class="card card-circle-chart mb-5">
    
                    <div class="card-content">
                      <div class="card card-body bg-gray-500 bd-0">
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
                            <td style="border-top: none;"><button  id="btnGo" class="btn btn-purple">Cari</button></td>
                          </tr>
                        </table>  
                      </div> 
                    </div>
                  </div>
                </div>
            </div>
            <div class="row row-xs wd-xl-80p mb-3">
              <div class="col-sm-6 col-md-3">
                <button class="btn btn-indigo btn-rounded btn-block" id="btnExport"> <i class="fas fa-download"></i>&nbsp;&nbsp;Download Excel</button>
              </div>
            </div>
            <div class="table-responsive" id="detail">
              <table id="ViewTable2" class="table table-striped">
                <thead class="text-primary">
                  <tr>
                    <th>
                      Nomor CN
                    </th>
                    <th>
                      Tanggal
                    </th>
                    <th>
                      Paket ID
                    </th>
                    <th>
                      Ord Number
                    </th>
                    <th>
                      Inv Number
                    </th>  
                    <th>
                      Kode Dealer
                    </th>
                    <th>
                      Nama Dealer
                    </th>
                    <th>
                      Model
                    </th>
                    <th>
                      Status
                    </th>
                    <th>
                      Qty
                    </th>
                    <th>
                      Total Sblm Disc
                    </th>
                    <th>
                      Nilai CN
                    </th>
                  </tr>
                </thead>
                <tbody>
                  
                </tbody>
                <tfoot>
                  <tr>
                    <th>
                      Nomor CN
                    </th>
                    <th>
                      Tanggal
                    </th>
                    <th>
                      Paket ID
                    </th>
                    <th>
                      Ord Number
                    </th>
                    <th>
                      Inv Number
                    </th>  
                    <th>
                      Kode Dealer
                    </th>
                    <th>
                      Nama Dealer
                    </th>
                    <th>
                      Model
                    </th>
                    <th>
                      Status
                    </th>
                    <th>
                      Qty
                    </th>
                    <th>
                      Total Sblm Disc
                    </th>
                    <th>
                      Nilai CN
                    </th>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
