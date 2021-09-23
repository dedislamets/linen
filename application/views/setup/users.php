<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title"> List User</h4>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table id="ViewTable" class="table table-striped">
            <thead class="text-primary">
              <tr>
                <th>
                  User ID
                </th>
                <th>
                  App
                </th>
                <th class="text-center">
                  Nama Pengguna
                </th>
                <th class="text-left">
                  Email
                </th>
                <th class="text-left">
                  Update Terakhir
                </th>
                <th class="text-left">
                  Aktif
                </th>
                <th class="text-left">
                  Eternal
                </th>
                <th>
                  Status
                </th>
                <th class="text-center">
                  Action
                </th>
            </tr></thead>
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