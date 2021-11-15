<style type="text/css">
  #area_chosen{
    width: 100% !important;
  }
</style>
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header"  style="color:#fff;background-color: green;">
        <h4 class="card-title" style="color: #fff;"> List Users 
          <button id="btnAdd" class="btn btn-outline-warning" style="float: right;">Tambah</button>
        </h4>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table id="ViewTable" class="table table-striped">
            <thead class="text-primary">
              <tr>
                <th>
                    ID
                </th>
                <th>
                  Nama Users
                </th>
                <th>
                  Email
                </th>
                <th>
                  Gender
                </th>
                <th>
                  Dept
                </th>
       
                <th>
                  Status
                </th>
                <th class="text-left">
                  Aksi
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