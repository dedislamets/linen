<div class="card z-depth-0">
    <div class="card-header back-green" style="color:#fff;background-color: green;">
        <div class="row">
            <div class="col-xl-10">
                <h4><?= $title ?></h4>
                <span>Halaman Utama ini menampilkan informasi <?= $title ?></span>
            </div>
            <!-- <div class="col-xl-2" style="padding-right: 0;">
                <a class="btn btn-block btn-dark btn-rounded" id="btnHistory" href="<?= base_url() ?>linenkotor/create"><i class="fa fa-history"></i>&nbsp; History</a>
            </div> -->
            <div class="col-xl-2">
                <a class="btn btn-block btn-dark btn-rounded" id="btnAdd" href="<?= base_url() ?>linenkotor/create"><i class="fa fa-plus"></i>&nbsp; Tambah baru</a>
            </div>
        </div>
    </div>
    <div class="card-block" style="padding: 10px;">
        <div class="table-responsive">
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
                          PIC
                        </th>
                        <th>
                          Infeksius
                        </th>
                        <th>
                          Ketagori
                        </th>
                        <th>
                          Qty
                        </th>
                        <th>
                          Berat
                        </th>
                        <th>
                          Timbang
                        </th>
                        <th>
                          Status
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
