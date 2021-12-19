<style type="text/css">
  body{
    margin: 0 !important;
  }
  .az-content .container, .az-content .container-fluid, .az-content .container-sm, .az-content .container-md, .az-content .container-lg, .az-content .container-xl {
    display: contents;
  }
  .vcenter {
    text-align: center;
    vertical-align: middle !important;
  }
  .tickets-tab-switch .nav-item {
    width: 50%;
  }
</style>
<div class="row">
  <div class="col-lg-12">
    <div class="card" >
      <div class="card-body" style="padding-bottom: 0">
       
        <div class="nav-scroller">
          <ul class="nav nav-tabs tickets-tab-switch" role="tablist">
            <li class="nav-item">
              <a class="nav-link rounded active show" id="pending-tab" data-toggle="tab" href="#pending-tickets" role="tab" aria-controls="pending-tickets" aria-selected="false">Pembelian By Date</a>
            </li>
            <li class="nav-item">
              <a class="nav-link rounded " id="vendor-tab" data-toggle="tab" href="#vendors" role="tab" aria-controls="vendors" aria-selected="true">Pembelian By Vendor</div>
              </a>
            </li>
          </ul>
        </div>
        <div class="tab-content border-0 tab-content-basic" style="padding: 10px" >
         
          <div class="tab-pane fade active show" id="pending-tickets" role="tabpanel" aria-labelledby="pending-tickets">
            <div class="card card-dashboard-table-six" style="padding: 10px">
              <h6 class="card-title">Laporan Pembelian By Date</h6>
              <div class="card-header">
                <div class="row">
                  
                  <div class="col-4 col-md-4 col-xl">
                    <div class="form-group row">
                      <label class="col-sm-1 col-form-label" style="font-weight: bold;">Bulan</label>
                      <div class="col-sm-3">
                        <?php
                          $month = date('m');
                          $thn = date('Y');
                          if(!empty($this->input->get("b", TRUE))){
                            $month=$this->input->get("b", TRUE);
                            $thn=$this->input->get("t", TRUE);
                          }
                          $jml_hari=  cal_days_in_month(CAL_GREGORIAN, $month, $thn) ;
                        ?>
                        <select id="bulan_medis" name="bulan_medis" class="form-control" >

                          <option value="01" <?= ($month == '01' ? 'selected' : '') ?>>Januari</option>
                          <option value="02" <?= ($month == '02' ? 'selected' : '') ?>>Februari</option>
                          <option value="03" <?= ($month == '03' ? 'selected' : '') ?>>Maret</option>
                          <option value="04" <?= ($month == '04' ? 'selected' : '') ?>>April</option>
                          <option value="05" <?= ($month == '05' ? 'selected' : '') ?>>Mei</option>
                          <option value="06" <?= ($month == '06' ? 'selected' : '') ?>>Juni</option>
                          <option value="07" <?= ($month == '07' ? 'selected' : '') ?>>Juli</option>
                          <option value="08" <?= ($month == '08' ? 'selected' : '') ?>>Agustus</option>
                          <option value="09" <?= ($month == '09' ? 'selected' : '') ?> >September</option>
                          <option value="10" <?= ($month == '10' ? 'selected' : '') ?>>Oktober</option>
                          <option value="11" <?= ($month == '11' ? 'selected' : '') ?>>November</option>
                          <option value="12" <?= ($month == '12' ? 'selected' : '') ?>>Desember</option>
                        </select>
                      </div>
                      <div class="col-sm-2">
                        <select id="tahun_medis" name="tahun_medis" class="form-control" >
                          <option value="2021" <?= ($thn == '2021' ? 'selected' : '') ?>>2021</option>
                          <option value="2022" <?= ($thn == '2022' ? 'selected' : '') ?>>2022</option>
                          <option value="2023" <?= ($thn == '2023' ? 'selected' : '') ?>>2022</option>
                          <option value="2024" <?= ($thn == '2024' ? 'selected' : '') ?>>2022</option>
                          <option value="2025" <?= ($thn == '2025' ? 'selected' : '') ?>>2022</option>
                          <option value="2026" <?= ($thn == '2026' ? 'selected' : '') ?>>2022</option>
                          <option value="2027" <?= ($thn == '2027' ? 'selected' : '') ?>>2022</option>
                          <option value="2028" <?= ($thn == '2028' ? 'selected' : '') ?>>2022</option>
                          <option value="2029" <?= ($thn == '2029' ? 'selected' : '') ?>>2022</option>

                        </select>
                      </div>
                      <div class="col-2">
                        <button class="btn btn-indigo btn-rounded btn-block" id="btnMedis"><i class="fa fa-eye"></i>&nbsp; Lihat</button>

                      </div>
                      <div class="col-2">
                        <button class="btn btn-light btn-rounded btn-block" id="btnCetakMedis" ><i class="fa fa-print"></i>&nbsp; Print</button>
                      </div>
                    </div>
                  </div>
                  
                </div>
              </div>
              <div class="table-responsive">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th rowspan="2">ID</th>
                      <th rowspan="2" >Jenis</th>
                      <?php 
                      for ($i=1; $i <= $jml_hari ; $i++) { 
                        echo "<th>". $i ."</th>";
                      }
                      ?>
                    </tr>
                    
                  </thead>
                  <tbody>
                    <?php
                      $no=1;
                      foreach($laporan_medis as $row => $ruangan){
                          echo "<tr>";
                          echo "<td>".$no."</td>";
                          echo "<td>".$row."</td>";
                          for ($i=1; $i <= $jml_hari ; $i++) { 
                            $total = 0;
                            foreach($ruangan as $tgl => $row_tgl){
                              if($tgl == $i){
                                $total = $row_tgl;
                              }
                            }
                            echo "<td>".$total."</td>";
                          }
                          echo "</tr>";
                          $no++;
                      }
                    ?>
                    <tr>
                      <td colspan="2">Total</td>
                      <?php 
                      for ($i=1; $i <= $jml_hari ; $i++) { 
                        $total = 0;
                        foreach($laporan_medis_sum as $tgl => $row){
                          if($tgl == $i){
                            $total = $row;
                          }
                        }
                        echo "<td>".$total."</td>";
                      }
                      ?>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="tab-pane fade " id="vendors" role="tabpanel" aria-labelledby="vendors">
            <div class="card card-dashboard-table-six" style="padding: 10px">
              <h6 class="card-title">Laporan Pembelian By Vendor</h6>
              <div class="card-header">
                <div class="row">
                  
                  <div class="col-4 col-md-4 col-xl">
                    <div class="form-group row">
                      <label class="col-sm-1 col-form-label" style="font-weight: bold;">Bulan</label>
                      <div class="col-sm-3">
                        <?php
                          $month = date('m');
                          $thn = date('Y');
                          if(!empty($this->input->get("b", TRUE))){
                            $month=$this->input->get("b", TRUE);
                            $thn=$this->input->get("t", TRUE);
                          }
                          $jml_hari=  cal_days_in_month(CAL_GREGORIAN, $month, $thn) ;
                        ?>
                        <select id="bulan_medis" name="bulan_medis" class="form-control" >

                          <option value="01" <?= ($month == '01' ? 'selected' : '') ?>>Januari</option>
                          <option value="02" <?= ($month == '02' ? 'selected' : '') ?>>Februari</option>
                          <option value="03" <?= ($month == '03' ? 'selected' : '') ?>>Maret</option>
                          <option value="04" <?= ($month == '04' ? 'selected' : '') ?>>April</option>
                          <option value="05" <?= ($month == '05' ? 'selected' : '') ?>>Mei</option>
                          <option value="06" <?= ($month == '06' ? 'selected' : '') ?>>Juni</option>
                          <option value="07" <?= ($month == '07' ? 'selected' : '') ?>>Juli</option>
                          <option value="08" <?= ($month == '08' ? 'selected' : '') ?>>Agustus</option>
                          <option value="09" <?= ($month == '09' ? 'selected' : '') ?> >September</option>
                          <option value="10" <?= ($month == '10' ? 'selected' : '') ?>>Oktober</option>
                          <option value="11" <?= ($month == '11' ? 'selected' : '') ?>>November</option>
                          <option value="12" <?= ($month == '12' ? 'selected' : '') ?>>Desember</option>
                        </select>
                      </div>
                      <div class="col-sm-2">
                        <select id="tahun_medis" name="tahun_medis" class="form-control" >
                          <option value="2021" <?= ($thn == '2021' ? 'selected' : '') ?>>2021</option>
                          <option value="2022" <?= ($thn == '2022' ? 'selected' : '') ?>>2022</option>
                          <option value="2023" <?= ($thn == '2023' ? 'selected' : '') ?>>2022</option>
                          <option value="2024" <?= ($thn == '2024' ? 'selected' : '') ?>>2022</option>
                          <option value="2025" <?= ($thn == '2025' ? 'selected' : '') ?>>2022</option>
                          <option value="2026" <?= ($thn == '2026' ? 'selected' : '') ?>>2022</option>
                          <option value="2027" <?= ($thn == '2027' ? 'selected' : '') ?>>2022</option>
                          <option value="2028" <?= ($thn == '2028' ? 'selected' : '') ?>>2022</option>
                          <option value="2029" <?= ($thn == '2029' ? 'selected' : '') ?>>2022</option>

                        </select>
                      </div>
                      <div class="col-2">
                        <button class="btn btn-indigo btn-rounded btn-block" id="btnMedis"><i class="fa fa-eye"></i>&nbsp; Lihat</button>

                      </div>
                      <div class="col-2">
                        <button class="btn btn-light btn-rounded btn-block" id="btnCetakMedis" ><i class="fa fa-print"></i>&nbsp; Print</button>
                      </div>
                    </div>
                  </div>
                  
                </div>
              </div>
              <div class="table-responsive">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th rowspan="2">ID</th>
                      <th rowspan="2" >Vendor</th>
                      <?php 
                      for ($i=1; $i <= $jml_hari ; $i++) { 
                        echo "<th>". $i ."</th>";
                      }
                      ?>
                    </tr>
                    
                  </thead>
                  <tbody>
                    <?php
                      $no=1;
                      foreach($laporan_vendor as $row => $ruangan){
                          echo "<tr>";
                          echo "<td>".$no."</td>";
                          echo "<td>".$row."</td>";
                          for ($i=1; $i <= $jml_hari ; $i++) { 
                            $total = 0;
                            foreach($ruangan as $tgl => $row_tgl){
                              if($tgl == $i){
                                $total = $row_tgl;
                              }
                            }
                            echo "<td>".$total."</td>";
                          }
                          echo "</tr>";
                          $no++;
                      }
                    ?>
                    <tr>
                      <td colspan="2">Total</td>
                      <?php 
                      for ($i=1; $i <= $jml_hari ; $i++) { 
                        $total = 0;
                        foreach($laporan_vendor_sum as $tgl => $row){
                          if($tgl == $i){
                            $total = $row;
                          }
                        }
                        echo "<td>".$total."</td>";
                      }
                      ?>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        
      </div>
    </div>
  </div>
</div>