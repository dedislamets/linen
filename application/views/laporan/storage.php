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
    
    <div class="card" style="padding: 10px">
      <h6 class="card-title">Laporan Penyimpanan Linen</h6>
      <div class="card-header">
        <div class="row">
          
          <div class="col-4 col-md-4 col-xl">
            <div class="form-group row">
          
              <div class="col-2">
                <button class="btn btn-light btn-rounded btn-block" id="btnCetakMedis" ><i class="fa fa-print"></i>&nbsp; Print</button>
              </div>
            </div>
          </div>
          
        </div>
      </div>
      <div class="table-responsive">
        <table id="ViewTableBrg" class="table table-striped" style="margin-top: 0 !important;width: 100% !important;">
          <thead class="text-primary">
              <tr>
                  <th>
                    No
                  </th>
                  <th>
                    Serial/EPC
                  </th>
                  <th>
                    Nama Barang
                  </th>
                  <th>
                    Spesifikasi
                  </th>
                  <th>
                    Berat Kg
                  </th>
              </tr>
          </thead>
          <tbody id="tbody-table">
              <?php 
              $urut=1;
              foreach($laporan_storage as $row): ?>
                <tr>
                  <td width="10"><?=$urut?></td>
                  <td><?=$row->epc ?></td>
                  <td><?=$row->jenis?></td>
                  <td><?=$row->spesifikasi ?></td>
                  <td><?=$row->berat?></td>
                  
                </tr>
                <?php $urut++?>
              <?php endforeach; ?>

          </tbody>
      </table>
      </div>
    </div>
        
  </div>
</div>