<div class="card z-depth-0">
    <div class="card-header back-green" style="color:#fff;background-color: green;">
        <div class="row">
            <div class="col-xl-10">
                <h4><?= $title ?></h4>
                <span>Halaman Utama ini menampilkan informasi <?= $title ?></span>
            </div>
            <div class="col-xl-2">
                <a class="btn btn-block btn-dark btn-rounded" id="btnTambah" href="<?= base_url() ?>listrequest/create"><i class="fa fa-plus"></i>&nbsp; Tambah baru</a>
            </div>
           
        </div>
    </div>
    <div class="card-block" style="padding: 10px;">
        <div class="row">
            <div class="col-xl-12">
                <div class="table-responsive">
                    <table id="ViewTable" class="table table-striped dt-responsive display nowrap"  style="width: 100%">
                        <thead class="text-primary">
                            <tr>
                                <th>
                                  No Request
                                </th>
                                <th>
                                  Tanggal
                                </th>
                                <th>
                                  Requestor
                                </th>
                                <th>
                                  Ruangan
                                </th>
                                <th>
                                  Total
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
                    <table id="ViewTableDetail" class="table table-striped" width="100%">
                        <thead class="text-primary">
                            <tr>
                                <th>
                                  Tanggal
                                </th>
                                <th>
                                  Ruangan
                                </th>
                                <th>
                                  No Request
                                </th>
                                <th>
                                  Requestor
                                </th>
                                <th>
                                  Jenis
                                </th>
                                <th>
                                  Qty
                                </th>
                                
                            </tr>
                        </thead>
                        <tbody>
                          
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
  $this->load->view($modal); 
?>
