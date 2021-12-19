<style type="text/css">
  select[readonly]
  {
      pointer-events: none;
  }
  .left-view-card {
    display: block;
    position: relative;
    height: 36px;
    border-radius: 100%;
    flex-shrink: 0;
    top: 3px;
  }
  .az-chat-list .media {
    padding: 11px 0px;
  }

  .az-chat-list .media.new {
      background-color: #f7f7f7;
      margin-bottom: 10px;
      border-radius: 6px;
      padding: 15px 10px;
      text-align: center;
      color: #7987a1;
      font-weight: 500;
      border: none;
      width: 100%;
  }

  .btn-mobile {
    /*padding: 5px 8px;
    min-height: auto;
    margin-top: 10px;*/
  }
  @media only screen and (max-width: 600px) {
      .table th, .table td {
        padding: 5px;
      }

      .az-header {
        display: none;
      }
      #back {
        display: none;
      }
      .card-header {
        display: none;
      }
      .form-control {
          height: 45px;
          border-radius: 5px;
      }
  }
</style>
<div class="card z-depth-0">
  <div class="card-header back-green" style="color:#fff">
    <div class="row">
        <div class="col-xl-10">
            <h4><?= $title ?> <a href="<?= base_url() ?>pembelian" id="back" style="color: #000;margin-left: 10px;"> Back </a></h4>
            <span>Halaman ini untuk mengatur pembelian linen</span>
        </div>
        
        <div class="col-xl-2">
          <div class="status-trans"><?= empty($data) ? "Input" : $data['status'] ?></div>
        </div>
    </div>
  </div>
  <div class="card-block" style="padding: 20px;">
    <form id="form-request" name="form-request" action="" method="">
      <input type="hidden" name="mode" id="mode" value="<?= $mode ?>">

      <div class="form-group row">
        <label class="col-sm-2 col-form-label" style="font-weight: bold;">NO TRANSAKSI</label>
        <div class="col-sm-10">
          <input type="text" class="form-control form-bg-inverse" id="no_penerimaan" name="no_penerimaan" value="<?= empty($data) ? "" : $data['no_penerimaan']?>" readonly required >
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2 col-form-label" style="font-weight: bold;">TANGGAL </label>
        <div class="col-sm-10">
          <input class="form-control form-bg-inverse" type="text" id="tanggal" name="tanggal" value="<?= empty($data) ? date("m/d/Y") : date("m/d/Y", strtotime($data['current_insert'])) ?>" readonly />
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2 col-form-label" style="font-weight: bold;">KETERANGAN</label>
        <div class="col-sm-10">
          <input type="text" class="form-control form-bg-inverse" id="deskripsi" name="deskripsi" value="<?= empty($data) ? "" : $data['deskripsi']?>" readonly required >
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2 col-form-label" style="font-weight: bold;">SUPPLIER</label>
        <div class="col-sm-10">
          <input type="text" class="form-control form-bg-inverse" id="vendor_name" name="vendor_name" value="<?= empty($data) ? "" : $supplier['vendor_name'] ?>" readonly required >
        </div>
      </div>
      <div class="row" style="padding-left: 10px">
        <h4 class="info-text" style="padding-left: 10px;">
            <button class="btn btn-success btn-sm" id="btnAdd" ><i class="fa fa-plus"></i> Tambah</button>
            <input type="hidden" id="total-row" name="total-row" value="<?= $totalrow ?>">
        </h4>
        <div class="col-sm-12" style="padding: 10px">
          <div class="dt-responsive table-responsive table-brg">
            <table id="ViewTableBrg" class="table table-striped" style="margin-top: 0 !important;width: 100% !important;">
                <thead class="text-primary">
                    <tr>
                        <th>
                          No
                        </th>
                        <th>
                          Aksi
                        </th>
                        <th>
                          Nama Barang
                        </th>
                        <th>
                          Jumlah
                        </th>
                        
                    </tr>
                </thead>
                <tbody id="tbody-table">
            
                </tbody>
            </table>
          </div>
        </div>                  
      </div>
      
      <div class="row">
        <div class="col-sm-12" style="margin-top: 10px;">
          <input type="hidden" name="id_penerimaan" id="id_penerimaan" value="<?= empty($data) ? "" : $data['id']?>">
          <input type="hidden" id="csrf_token" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" >

          <button class="btn btn-block btn-success btn-mobile" id="btn-finish" v-if="last_status != 'CLOSED'"><i class="fa fa-save"></i>&nbsp; Simpan</button>
        </div>
      </div>
    
    </form>
  </div>
</div>
<?php
  $this->load->view($modal); 
?>
