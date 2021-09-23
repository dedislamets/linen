<div class="col-lg-6 col-md-6 ml-auto mr-auto">
  <div class="card card-lock text-center">
    <div class="card-header ">
      <img src="<?= base_url(); ?>assets/images/attention.png" alt="...">
    </div>
    <?php if(isset($error)) { echo $error; }; ?>
    <form method="POST" action="<?php echo base_url() ?>index.php/login/reset" class="form-horizontal">
    <div class="card-body ">
      <p class="card-title" style="margin-top: 0px;"></p>
      <h2>Reset Akun Anda</h2>
      <?php echo $this->session->flashdata('message_error'); ?>

      <div class="form-group">
        <label class="col-md-4 control-label" style="float: left;font-size: 16px;font-weight: bold;text-align: left;padding-top: 7px;">Pilih Aplikasi</label>
        <div class="col-md-8" style="float: left;padding-right: 0">
          <select id="apps" name="apps" class="form-control" style="font-weight: bold;background-color: darkorange;color:#fff;" >
            <option value="dm">DM</option>
            <option value="sales">Sales</option>
          </select>
        </div>
      </div>
      <h4 style="margin-top: 100px">Masukkan Username anda</h4>
      <div class="form-group">
        <div class="row">
          <div class="col-md-12">
          <input type="text" name="username" class="form-control" placeholder="Username Anda">
            <?php echo form_error('username'); ?>
          </div>
        </div>
      </div>
      <h4>Masukkan Email Modena anda</h4>
      <div class="form-group">
        <div class="row">
          <div class="col-md-6" style="padding-right: 0">
            <input type="text" name="email" class="form-control" placeholder="Nama Depan Email Anda">
            <?php echo form_error('email'); ?>
          </div>
          <div class="col-md-6" style="padding-left: 0">
            <select id="long_email" name="long_email" class="form-control" style="font-weight: bold;background-color: darkorange;color:#fff;" >
              <option value="@modena.co.id">@modena.co.id</option>
			        <option value="@modena.com">@modena.com</option>
					<option value="@ambiente.co.id">@ambiente.co.id</option>
					<option value="@prive.co.id">@prive.co.id</option>
              <option value="@modena.id">@modena.id</option>
			 
            </select>
          </div>
        </div>
        
      </div>
      <p>Link reset akan dikirimkan ke email anda. Cek email anda untuk mereset akun anda</p>
    </div>
    <div class="card-footer ">
      <input type="hidden" id="csrf_token" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" >
      <button type="submit" class="btn btn-warning btn-round">
        <i class="ace-icon fa fa-key"></i>
        <span class="bigger-110">Reset</span>
      </button>
    </div>
    </form>
  </div>
</div>