<div class="card z-depth-0">
    <div class="card-header back-green" style="color:#fff;background-color: green;">
        <div class="row">
            <div class="col-xl-10">
                <h4><?= $title ?></h4>
                <span>Halaman Utama ini menampilkan <?= $title ?></span>
            </div>
            <div class="col-xl-2">
                <button class="btn btn-success" id="btnAdd"><i class="icofont icofont-ui-add"></i> Tambah baru</button>
            </div>
        </div>
    </div>
    <div class="card-block" style="padding: 10px;">
        <div class="dt-responsive table-responsive">
            <table id="ViewTable" class="table table-striped">
                <thead class="text-primary">
                    <tr>
                        <th>
                          Supplier Code
                        </th>
                        <th>
                          Supplier Name
                        </th>
                        <th>
                          Alamat
                        </th>
                        <th>
                          Phone
                        </th>
                        <th>
                          Contact
                        </th>
                        
                        <th class="text-left" style="width: 120px;">
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
