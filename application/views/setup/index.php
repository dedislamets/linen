<style type="text/css">
  .card-content{
    padding: 15px;
  }
</style>
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header" style="color:#fff;background-color: green !important;">
        <h4 class="card-title" style="color: #fff;">Setup</h4>
      </div>
      <div class="card-content" >
        <?php echo $this->session->flashdata('message'); ?>
        <form method="post" action="<?php echo base_url() ?>setup/simpan" class="form-horizontal">
          <fieldset>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Serial COM</label>
              <div class="col-sm-4">
                <input type="text" id="serial_com" name="serial_com" class="form-control" value="<?php echo $setup[0]->port_com ?>">
              </div>
              <label class="col-sm-2 col-form-label">Baud Rate</label>
              <div class="col-sm-4">
                <select id="baud" name="baud" class="form-control" >
                  <option value="0">9600bps</option>
                  <option value="1">19200bps</option>
                  <option value="2">38400bps</option>
                  <option value="5" selected="selected">57600bps</option>
                  <option value="6">115200bps</option>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Power</label>
              <div class="col-sm-4">
                <input type="text" id="power" name="power" class="form-control" value="<?php echo $setup[0]->power ?>">
              </div>
              <label class="col-sm-2 col-form-label">Speed</label>
              <div class="col-sm-4">
                <input type="text" id="speed" name="speed" class="form-control" value="<?php echo $setup[0]->speed ?>">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">IP Address</label>
              <div class="col-sm-4">
                <input type="text" id="ip" name="ip" class="form-control" value="<?php echo $setup[0]->ip ?>">
              </div>
              <label class="col-sm-2 col-form-label">Port</label>
              <div class="col-sm-4">
                <input type="text" id="port_ip" name="port_ip" class="form-control" value="<?php echo $setup[0]->port_ip ?>">
              </div>
            </div>
          </fieldset>
          <fieldset>
            <div class="form-group">
              <input type="hidden" id="csrf_token" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" >
              <button type="submit" class="btn btn-fill btn-info" style="margin-left: 10px">Submit</button>
            </div>
          </fieldset>
        </form>
      </div>
    </div>  <!-- end card -->
  </div> <!-- end col-md-12 -->
</div>