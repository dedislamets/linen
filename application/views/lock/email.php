<div class="col-lg-6 col-md-6 ml-auto mr-auto">
  <div class="card card-lock text-center">
    <div class="card-header ">
      <img src="<?= base_url(); ?>assets/images/attention.png" alt="...">
    </div>
    <?php if(isset($error)) { echo $error; }; ?>
    <form method="POST" action="<?php echo base_url() ?>index.php/login/email">
    <div class="card-body ">
      <p class="card-title" style="margin-top: 0px;">Email anda kosong, silahkan isi email anda untuk mendapatkan notifikasi expired password.!!</p>
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
     <p style="font-weight: bold;">Masukkan Email Modena anda</p>
      <div class="form-group">
        <div class="row">
          <div class="col-md-6" style="padding-right: 0">
            <input type="text" name="email" class="form-control" placeholder="Nama Depan Email Anda">
            <?php echo form_error('email'); ?>
          </div>
          <div class="col-md-6" style="padding-left: 0">
            <select id="long_email" name="long_email" class="form-control" style="font-weight: bold;background-color: darkorange;color:#fff;" >
              <option value="@modena.co.id">@modena.co.id</option>
			  <option value="@modena.id">@modena.com</option>
              <option value="@modena.id">@modena.id</option>
            </select>
          </div>
        </div>
        
      </div>
      
    </div>
    <div class="card-footer ">
      <input type="hidden" id="apps" name="apps" value="<?php echo $this->input->get('apps') ?>">
      <input type="hidden" id="user_id" name="user_id" value="<?php echo $this->input->get('username') ?>">
      <input type="hidden" id="csrf_token" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" >
      <a href="https://air.modena.co.id/dm/login.php" class="btn btn-round btn-default">Kembali Ke Aplikasi <?php echo $this->input->get('apps') ?></a>
      <button type="submit" class="btn btn-warning btn-round">
        <i class="ace-icon fa fa-key"></i>
        <span class="bigger-110">Update Email</span>
      </button>
    </div>
    </form>
  </div>
</div>