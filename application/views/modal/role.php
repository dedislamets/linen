<div id="ModalUser" class="modal" >
  <div class="modal-dialog" role="document" style="margin: 10% auto;">
      <div class="modal-content">
        <div class="modal-header" style="background-color: #404E67;color:#fff">
            <h4 class="modal-title" id="myModalLabel" style="color:#fff"><label >Pilih User</label> <label id="lbl-title-cust"></label></h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body" >
          <div class="dt-responsive table-responsive">
            <table id="ModalTableUser" class="table table-striped" style="width: 100%">
                <thead class="text-primary">
                    <tr>
                      <th>Pilih</th>
                      <th>Username</th>
                      <th>Nama User</th>
                    </tr>
                </thead>
                <tbody>
                  
                </tbody>
            </table>
          </div>
          <div style="display: none">
              <input type="text" id="txtSelected" name="txtSelected">
          </div>
        </div>
        <div class="modal-footer" >
            <button type="button" class="btn btn-success" id="btnsubmit">Submit</button>
        </div>
      </div>
  </div>
</div>