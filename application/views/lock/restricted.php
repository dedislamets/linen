<div class="col-lg-4 col-md-6 ml-auto mr-auto">
  <div class="card card-lock text-center">
    <div class="card-header ">
      <img src="<?= base_url(); ?>assets/images/restricted.jpg" alt="...">
    </div>
    <div class="card-body ">
      <h4 class="card-title" style="margin-top: 0px;">Informasi</h4>
      <p><?php echo $this->session->flashdata('info'); ?></p>
    <div class="card-footer ">
      <a href="javascript:window.history.back();" class="btn btn-outline-default btn-round">Kembali</a>
    </div>
  </div>
</div>