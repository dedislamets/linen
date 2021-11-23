<div class="card z-depth-0">
    <div class="card-header back-green" style="color:#fff;background-color: green;">
        <div class="row">
            <div class="col-xl-10">
                <h4>Master Linen</h4>
                <span>Halaman Utama ini menampilkan informasi linen</span>
            </div>
            <div class="col-xl-2">
                <a class="btn btn-block btn-dark btn-rounded" id="btnAdd" href="<?= base_url() ?>barang/create"><i class="fa fa-plus"></i>&nbsp; Tambah baru</a>
            </div>
        </div>
    </div>
    <div class="card-block" style="padding: 10px;">
        <div class="dt-responsive table-responsive">
            <table id="ViewTable" class="table table-striped">
                <thead class="text-primary">
                    <tr>
                        <th style="width: 100px">
                          Serial
                        </th>
                        <th style="width: 250px">
                          Nama Barang
                        </th>
                        <th>
                          Spesifikasi
                        </th>
                        <th>
                          Ruangan
                        </th>
                        <th>
                          Jenis
                        </th>
                        <th>
                          Berat (Kg)
                        </th>
                        <th>
                          Harga
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
