<div class="card z-depth-0">
    <div class="card-header back-green" style="color:#fff;background-color: green;">
        <div class="row">
            <div class="col-xl-10">
                <h4><?= $title ?></h4>
                <span>Ini adalah halaman riwayat proses Linen Bersih.</span>
            </div>
        </div>
    </div>
    <div class="card-block" style="padding: 10px;">
        <div class="dt-responsive table-responsive">
            <table id="ViewTable" class="table table-striped">
                <thead class="text-primary">
                    <tr>
                        <th>
                          Tanggal
                        </th>
                        <th>
                          No Transaksi
                        </th>
                        <th>
                          Kategori
                        </th>
                        <th>
                          PIC
                        </th>
                        <th>
                          Total Qty
                        </th>
                        <th>
                          Total Berat
                        </th>
                        <th>
                          Aksi
                        </th>
                    </tr>
                </thead>
                <tbody>
                  
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php
  $this->load->view($modal); 
?>
