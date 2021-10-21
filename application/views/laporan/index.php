<style type="text/css">
  body{
    margin: 0 !important;
  }
  .az-content .container, .az-content .container-fluid, .az-content .container-sm, .az-content .container-md, .az-content .container-lg, .az-content .container-xl {
    display: contents;
  }
</style>
<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body">
       
        <div class="nav-scroller">
          <ul class="nav nav-tabs tickets-tab-switch" role="tablist">
            <li class="nav-item">
              <a class="nav-link rounded active show" id="open-tab" data-toggle="tab" href="#open-tickets" role="tab" aria-controls="open-tickets" aria-selected="false">Distribusi Linen Bersih</a>
            </li>
            <li class="nav-item">
              <a class="nav-link rounded" id="pending-tab" data-toggle="tab" href="#pending-tickets" role="tab" aria-controls="pending-tickets" aria-selected="false">Linen Tenaga Medis</a>
            </li>
            <li class="nav-item">
              <a class="nav-link rounded " id="onhold-tab" data-toggle="tab" href="#onhold-tickets" role="tab" aria-controls="onhold-tickets" aria-selected="true">Linen Rawat Inap</div>
              </a>
            </li>
          </ul>
        </div>
        <div class="tab-content border-0 tab-content-basic" style="padding: 10px" >
          <div class="tab-pane fade active show" id="open-tickets" role="tabpanel" aria-labelledby="open-tickets">

          <div class="card card-dashboard-table-six" style="padding: 10px">
            <h6 class="card-title">Laporan Distribusi Linen Bersih</h6>
            <div class="card-header">
              <div class="row row-sm">
                <div class="col-4 col-md-4 col-xl">
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label" style="font-weight: bold;">Ruangan</label>
                    <div class="col-sm-10">
                      <select id="ruangan_medis" name="ruangan_medis" class="form-control" >
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
                      <select id="bulan_medis" name="bulan_medis" class="form-control" >
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
                      <select id="tahun_medis" name="tahun_medis" class="form-control" >
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
              </div><!-- row -->
            </div>
            <div class="table-responsive">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th rowspan="2">ID</th>
                    <th rowspan="2" >Jenis Linen</th>
                    <?php 
                    for ($i=1; $i <= 31 ; $i++) { 
                      echo "<th>". $i ."</th>";
                    }
                    ?>
                  </tr>
                  
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">1</th>
                    <td>Tiger Nixon</td>
                    <?php 
                    for ($i=1; $i <= 31 ; $i++) { 
                      echo "<td>". $i ."</td>";
                    }
                    ?>
                  </tr>
                  
                </tbody>
              </table>
            </div>
          </div>
          </div>
          <div class="tab-pane fade" id="pending-tickets" role="tabpanel" aria-labelledby="pending-tickets">
            <div class="card card-dashboard-table-six" style="padding: 10px">
              <h6 class="card-title">Laporan Linen Tenaga Medis</h6>
              <div class="card-header">
                <div class="row row-sm">
                  <div class="col-4 col-md-4 col-xl">
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label" style="font-weight: bold;">Ruangan</label>
                      <div class="col-sm-10">
                        <select id="ruangan_medis" name="ruangan_medis" class="form-control" >
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
                        <select id="bulan_medis" name="bulan_medis" class="form-control" >
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
                        <select id="tahun_medis" name="tahun_medis" class="form-control" >
                          <option value="2021">2021</option>
                          <option value="2022">2022</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-2">
                    <button class="btn btn-indigo btn-rounded btn-block">Lihat</button>
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
                      for ($i=1; $i <= 31 ; $i++) { 
                        echo "<th>". $i ."</th>";
                      }
                      ?>
                    </tr>
                    
                  </thead>
                  <tbody>
                    <tr>
                      <th scope="row">1</th>
                      <td>Tiger Nixon</td>
                      <?php 
                      for ($i=1; $i <= 31 ; $i++) { 
                        echo "<td>". $i ."</td>";
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
              <h6 class="card-title">Laporan Linen Rawat Inap</h6>
              <div class="card-header">
                <div class="row row-sm">
                  <div class="col-4 col-md-4 col-xl">
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label" style="font-weight: bold;">Ruangan</label>
                      <div class="col-sm-10">
                        <select id="ruangan_medis" name="ruangan_medis" class="form-control" >
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
                        <select id="bulan_medis" name="bulan_medis" class="form-control" >
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
                        <select id="tahun_medis" name="tahun_medis" class="form-control" >
                          <option value="2021">2021</option>
                          <option value="2022">2022</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-2">
                    <button class="btn btn-indigo btn-rounded btn-block">Lihat</button>
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
                      for ($i=1; $i <= 31 ; $i++) { 
                        echo "<th>". $i ."</th>";
                      }
                      ?>
                    </tr>
                    
                  </thead>
                  <tbody>
                    <tr>
                      <th scope="row">1</th>
                      <td>Tiger Nixon</td>
                      <?php 
                      for ($i=1; $i <= 31 ; $i++) { 
                        echo "<td>". $i ."</td>";
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