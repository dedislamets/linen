<div class="col-lg-6 col-md-6 ml-auto mr-auto">
  <div class="card card-lock text-center">
    <div class="card-header ">
      <img src="<?= base_url(); ?>assets/images/attention.png" alt="...">
    </div>
    <?php if(isset($error)) { echo $error; }; ?>
    <form method="POST" action="<?php echo base_url() ?>index.php/login/forgot">
    <div class="card-body ">
      <p class="card-title" style="margin-top: 0px;"></p>
      <h3>Permintaan Reset Akun</h3>
      <?php echo $this->session->flashdata('message_error'); ?>
      <table class="table table-bordered" style="text-align: left;">
        <tr>
          <td>Aplikasi</td><td>:</td><td><?php echo $this->input->get('apps') ?></td>
        </tr>
        <tr>
          <td>User ID</td><td>:</td><td><?php echo $this->input->get('username') ?></td>
        </tr>
        <tr>
          <td>Nama Pengguna</td><td>:</td><td><?php echo $this->input->get('nama_pengguna') ?></td>
        </tr>
        <tr>
          <td>Terakhir Update</td><td>:</td><td><?php echo $this->input->get('last_update_date') ?></td>
        </tr>
      </table>
      <div class="form-group">
        <input type="password" name="password" class="form-control" placeholder="Password Baru" />
        <?php echo form_error('password'); ?>
      </div>
      <div class="form-group">
        <input type="password" name="ulangi_password" class="form-control" placeholder="Ulangi Password Baru" />
        <?php echo form_error('ulangi_password'); ?>
      </div>
    </div>
    <div class="card-footer ">
      <input type="hidden" id="apps" name="apps" value="<?php echo $this->input->get('apps') ?>">
      <input type="hidden" id="token" name="token" value="<?php echo $this->input->get('token') ?>">
      <input type="hidden" id="user_id" name="user_id" value="<?php echo $this->input->get('username') ?>">
      <input type="hidden" id="csrf_token" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" >
      <button type="submit" class="btn btn-warning btn-round">
        <i class="ace-icon fa fa-key"></i>
        <span class="bigger-110">Reset</span>
      </button>
    </div>
    </form>
  </div>
</div>