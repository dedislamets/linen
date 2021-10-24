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
            <!-- <li class="nav-item">
              <a class="nav-link rounded active show" id="open-tab" data-toggle="tab" href="#open-tickets" role="tab" aria-controls="open-tickets" aria-selected="false">Distribusi Linen Bersih</a>
            </li> -->
            <li class="nav-item">
              <a class="nav-link rounded active show" id="pending-tab" data-toggle="tab" href="#pending-tickets" role="tab" aria-controls="pending-tickets" aria-selected="false">Linen Tenaga Medis</a>
            </li>
            <li class="nav-item">
              <a class="nav-link rounded " id="onhold-tab" data-toggle="tab" href="#onhold-tickets" role="tab" aria-controls="onhold-tickets" aria-selected="true">Linen Rawat Inap</div>
              </a>
            </li>
          </ul>
        </div>
        <div class="tab-content border-0 tab-content-basic" style="padding: 10px" >
          <!-- <div class="tab-pane fade " id="open-tickets" role="tabpanel" aria-labelledby="open-tickets">
            <div class="card card-dashboard-table-six" style="padding: 10px">
              <h6 class="card-title">Laporan Distribusi Linen Bersih</h6>
              <div class="card-header">
                <div class="row row-sm">
                  <div class="col-4 col-md-4 col-xl">
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label" style="font-weight: bold;">Ruangan</label>
                      <div class="col-sm-10">
                        <select id="ruangan_distribusi" name="ruangan_distribusi" class="form-control" >
                          <?php 
                          foreach($ruangan as $row)
                          { 
                            if( empty($keluar) ? "" : $keluar['PIC'] === $row->ruangan){
                              echo '<option value="'.$row->ruangan.'" selected>'.$row->ruangan.'</option>';
                            }else{
                              echo '<option value="'.$row->ruangan.'">'.$row->ruangan.'</option>';
                            }
                            
                          }?>
                          
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-6 col-md-4 col-xl">
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label" style="font-weight: bold;">Bulan</label>
                      <div class="col-sm-5">
                        <select id="bulan_distribusi" name="bulan_distribusi" class="form-control" >
                          <option value="01">Januari</option>
                          <option value="02">Februari</option>
                          <option value="03">Maret</option>
                          <option value="04">April</option>
                          <option value="05">Mei</option>
                          <option value="06">Juni</option>
                          <option value="07">Juli</option>
                          <option value="08">Agustus</option>
                          <option value="09">September</option>
                          <option value="10">Oktober</option>
                          <option value="11">November</option>
                          <option value="12">Desember</option>
                        </select>
                      </div>
                      <div class="col-sm-5">
                        <select id="tahun_distribusi" name="tahun_distribusi" class="form-control" >
                          <option value="2021">2021</option>
                          <option value="2022">2022</option>
                          <option value="2023">2023</option>
                          <option value="2024">2024</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-2">
                    <button class="btn btn-indigo btn-rounded btn-block">Lihat</button>
                  </div>
                </div>
              </div>
              <div class="table-responsive">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th rowspan="2" class="vcenter">No</th>
                      <th rowspan="2" class="vcenter">Ruangan</th>
                      <th colspan="2" class="vcenter">Jumlah</th>
                      <th rowspan="2" class="vcenter">Berat (Kg)</th>
                      <th rowspan="2" class="vcenter">Biaya</th>
                    </tr>
                    <tr>
                      <th>Infeksius</th>
                      <th>Non Infeksius</th>
                    </tr>
                    
                  </thead>
                  <tbody>
                    
                  </tbody>
                </table>
              </div>
            </div>
          </div> -->
          <div class="tab-pane fade active show" id="pending-tickets" role="tabpanel" aria-labelledby="pending-tickets">
            <div class="card card-dashboard-table-six" style="padding: 10px">
              <h6 class="card-title">Laporan Linen Tenaga Medis</h6>
              <div class="card-header">
                <div class="row">
                  
                  <div class="col-4 col-md-4 col-xl">
                    <div class="form-group row">
                      <label class="col-sm-1 col-form-label" style="font-weight: bold;">Bulan</label>
                      <div class="col-sm-3">
                        <?
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
                      <!-- <div class="col-2">
                        <button class="btn btn-light btn-rounded btn-block" id="btnRawat"><i class="fa fa-download"></i>&nbsp; Download</button>
                      </div> -->
                      <div class="col-2">
                        <button class="btn btn-light btn-rounded btn-block" id="btnCetakMedis" ><i class="fa fa-print"></i>&nbsp; Print</button>
                      </div>
                    </div>
                  </div>
                  
                </div><!-- row -->
              </div>
              <div class="table-responsive">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th rowspan="2">ID</th>
                      <th rowspan="2" >Jenis Linen</th>
                      <?php 
                      for ($i=1; $i <= $jml_hari ; $i++) { 
                        echo "<th>". $i ."</th>";
                      }
                      ?>
                    </tr>
                    
                  </thead>
                  <tbody>
                    <?
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
          <div class="tab-pane fade " id="onhold-tickets" role="tabpanel" aria-labelledby="onhold-tickets">
            <div class="card card-dashboard-table-six" style="padding: 10px">
              
              <div class="card-header">
                <div class="row row-sm">
                  
                  <div class="col-6 col-md-4 col-xl">
                    <div class="form-group row">
                      <label class="col-sm-1 col-form-label" style="font-weight: bold;">Bulan</label>
                      <div class="col-sm-3">
                        <?
                          $month = date('m');
                          if(!empty($this->input->get("b", TRUE))){
                            $month=$this->input->get("b", TRUE);
                            $thn=$this->input->get("t", TRUE);
                          }
                        ?>
                        <select id="bulan_rawat" name="bulan_rawat" class="form-control" >

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
                        <select id="tahun_rawat" name="tahun_rawat" class="form-control" >
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
                        <button class="btn btn-secondary btn-rounded btn-block" id="btnRawat"><i class="fa fa-eye"></i>&nbsp; Lihat</button>
                      </div>
                      
                    </div>
                  </div>
                  
                </div>
              </div>
              <div class="row">
                <div class="col-8">
                  <h6 class="card-title">Laporan Linen Rawat Inap Infeksius (Kg)</h6>    
                </div>
                <!-- <div class="col-2 pd-t-15 pd-b-15">
                  <button class="btn btn-light btn-rounded btn-block" id="btnRawat"><i class="fa fa-download"></i>&nbsp; Download</button>
                </div> -->
                <div class="col-2 pd-t-15 pd-b-15">
                  <button class="btn btn-light btn-rounded btn-block" id="btnCetakRawat1"><i class="fa fa-print"></i>&nbsp; Print</button>
                </div>
              </div>
              
              <div class="table-responsive">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th rowspan="2">ID</th>
                      <th rowspan="2" >Ruangan</th>
                      <?php 
                      for ($i=1; $i <= $jml_hari ; $i++) { 
                        echo "<th>". $i ."</th>";
                      }
                      ?>
                    </tr>
                    
                  </thead>
                  <tbody>
                    <?
                      $no=1;
                      foreach($laporan_rawat_inf as $row => $ruangan){
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
                        foreach($laporan_rawat_inf_sum as $tgl => $row){
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
              <div class="row">
                <div class="col-8">
                  <h6 class="card-title">Laporan Linen Rawat Inap Non Infeksius (Kg)</h6> 
                </div>
                <!-- <div class="col-2 pd-t-15 pd-b-15">
                  <button class="btn btn-light btn-rounded btn-block" id="btnRawat"><i class="fa fa-download"></i>&nbsp; Download</button>
                </div> -->
                <div class="col-2 pd-t-15 pd-b-15">
                  <button class="btn btn-light btn-rounded btn-block" id="btnCetakRawat2"><i class="fa fa-print"></i>&nbsp; Print</button>
                </div>
              </div>
              
              <div class="table-responsive">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th rowspan="2">ID</th>
                      <th rowspan="2" >Jenis Linen</th>
                      <?php 
                      for ($i=1; $i <= $jml_hari ; $i++) { 
                        echo "<th>". $i ."</th>";
                      }
                      ?>
                    </tr>
                    
                  </thead>
                  <tbody>
                    <?
                      $no=1;
                      foreach($laporan_rawat_non_inf as $row => $ruangan){
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
                        foreach($laporan_rawat_non_inf_sum as $tgl => $row){
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

              <div class="row">
                <div class="col-8">
                  <h6 class="card-title">Laporan Linen Rawat Inap Infeksius (Lembar)</h6>
                </div>
                <!-- <div class="col-2 pd-t-15 pd-b-15">
                  <button class="btn btn-light btn-rounded btn-block" id="btnRawat"><i class="fa fa-download"></i>&nbsp; Download</button>
                </div> -->
                <div class="col-2 pd-t-15 pd-b-15">
                  <button class="btn btn-light btn-rounded btn-block" id="btnCetakRawat3"><i class="fa fa-print"></i>&nbsp; Print</button>
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
                    <?
                      $no=1;
                      foreach($laporan_rawat_inf_2 as $row => $ruangan){
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
                        foreach($laporan_rawat_inf_sum_2 as $tgl => $row){
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
              <div class="row">
                <div class="col-8">
                  <h6 class="card-title">Laporan Linen Rawat Inap Non Infeksius (Lembar)</h6>
                </div>
                <!-- <div class="col-2 pd-t-15 pd-b-15">
                  <button class="btn btn-light btn-rounded btn-block" id="btnRawat"><i class="fa fa-download"></i>&nbsp; Download</button>
                </div> -->
                <div class="col-2 pd-t-15 pd-b-15">
                  <button class="btn btn-light btn-rounded btn-block" id="btnCetakRawat4"><i class="fa fa-print"></i>&nbsp; Print</button>
                </div>
              </div>
              
              <div class="table-responsive">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th rowspan="2">ID</th>
                      <th rowspan="2" >Jenis Linen</th>
                      <?php 
                      for ($i=1; $i <= $jml_hari ; $i++) { 
                        echo "<th>". $i ."</th>";
                      }
                      ?>
                    </tr>
                    
                  </thead>
                  <tbody>
                    <?
                      $no=1;
                      foreach($laporan_rawat_non_inf_2 as $row => $ruangan){
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
                        foreach($laporan_rawat_non_inf_sum_2 as $tgl => $row){
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