<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title"> List Aplikasi
          <div class="col-sm-2 pull-right no-padding">
            <button type="button" id="btnAdd" class="btn btn-primary btn-block"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add</button>
          </div>
        </h4>

      </div>
      <div class="card-body">

        <div class="table-responsive">
          <table id="ViewTable" class="table table-striped">
            <thead class="text-primary">
              <tr>
                <th>
                  Code
                </th>
                <th>
                  Base URL
                </th>
                <th class="text-center">
                  Tabel User
                </th>
                <th class="text-left">
                  Key 
                </th>
                <th class="text-left">
                  Field Password
                </th>
                <th class="text-left">
                  Driver
                </th>
                <th class="text-left">
                  Encrypt Type
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