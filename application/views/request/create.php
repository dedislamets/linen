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
            <h4><?= $title ?> <a href="<?= base_url() ?>listrequest" id="back" style="color: #000;margin-left: 10px;"> Back </a></h4>
            <span>Halaman ini untuk merequest linen yang bersih</span>
        </div>
        
        <div class="col-xl-2">
          <div class="status-trans"><?= empty($data) ? "Input" : $data['status_request'] ?></div>
        </div>
    </div>
  </div>
  <div class="card-block" style="padding: 10px;">
    <form id="form-request" name="form-request" action="" method="">
      <input type="hidden" name="mode" id="mode" value="<?= $mode ?>">

      <div class="form-group row">
        <label class="col-sm-2 col-form-label" style="font-weight: bold;">NO REQUEST</label>
        <div class="col-sm-10">
          <input type="text" class="form-control form-bg-inverse" id="no_request" name="no_request" value="<?= empty($data) ? $no_request : $data['no_request']?>" readonly required >
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2 col-form-label" style="font-weight: bold;">TANGGAL </label>
        <div class="col-sm-10">
          <input class="form-control form-bg-inverse" type="text" id="tanggal" name="tanggal" value="<?= empty($data) ? date("m/d/Y") : date("m/d/Y", strtotime($data['tgl_request'])) ?>" />
        </div>
      </div>

      <div class="form-group row">
        <label class="col-sm-2 col-form-label" style="font-weight: bold;">REQUESTOR</label>
        <div class="col-sm-10">
          <select name="requestor" id="requestor" class="form-control" readonly>
          <?php 
            foreach($user as $row)
            { 
              if( empty($data) ? ($this->session->userdata('nama') === $row->nama_user ) : $data['requestor'] === $row->nama_user){
                echo '<option value="'.$row->nama_user.'" selected >'.$row->nama_user.'</option>';
              }else{
                echo '<option value="'.$row->nama_user.'">'.$row->nama_user.'</option>';
              }
            }
            ?>
          </select>
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2 col-form-label" style="font-weight: bold;">RUANGAN</label>
        <div class="col-sm-4">
          <select name="ruangan" id="ruangan" class="form-control">
            <?php 
            foreach($ruangan as $row)
            { 
              if( empty($data) ? "" : $data['ruangan'] === $row->ruangan){
                echo '<option value="'.$row->ruangan.'" selected >'.$row->ruangan.'</option>';
              }else{
                echo '<option value="'.$row->ruangan.'">'.$row->ruangan.'</option>';
              }
            }
            ?>
          </select>
        </div>
        <label class="col-sm-2 col-form-label" style="font-weight: bold;">TOTAL ITEM</label>
        <div class="col-sm-4">
          <input type="text" class="form-control" readonly id="total_qty" name="total_qty" placeholder="" value="<?= empty($data) ? 0 : $data['total_request']?>">
        </div>
      </div>

      

      <?php
      $detect = new Mobile_Detect;
      if ( $detect->isMobile() ): ?>
          <div class="row">
            <div class="col-12">
                <button class="btn btn-success btn-sm btn-mobile" id="btnAddMobile" style="float: right;margin-bottom: 10px;" ><i class="fa fa-plus"></i>&nbsp; Tambah</button>
              <input type="hidden" id="total-row" name="total-row" value="<?= $totalrow ?>">
            </div>
          </div>
          <div id="azChatList" class="az-chat-list ps ps--active-y">
              <!-- <div class="media new">
                <div class="left-view-card" style="padding: 10px;">1</div>
                <div class="left-view-card">
                  <button class="btn hor-grd btn-danger"> <i class="fa fa-trash"></i></button> 
                </div>
                <div class="media-body">
                  <div class="media-contact-name">
                    <span>Nama Barang</span>
                    <select name="jenis[]" id="jenis" class="form-control">
                      <option>Seprei</option>
                    </select>
                  </div>
                  <div class="media-contact-name">
                    <span style="width: 85px">Jumlah</span>
                    <input type="number" id="berat" name="berat" placeholder="" class="form-control" value="0">
                  </div>
                </div>
              </div> -->
              
          </div>
      <?php else: ?>
          <div class="row" id="barang">
            <h4 class="info-text" style="margin-top: 30px;padding-left: 10px;">
                <button class="btn btn-success btn-sm" id="btnAdd" ><i class="fa fa-plus"></i> Tambah baru</button>
            </h4>
            <div class="col-sm-12">
              <div class="dt-responsive table-responsive table-brg">
                <input type="hidden" id="total-row" name="total-row" value="<?= $totalrow ?>">
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
      <?php endif;?>
      
      <div class="row">
        <div class="col-sm-12" style="margin-top: 10px;">
          <input type="hidden" name="id_request" id="id_request" value="<?= empty($data) ? "" : $data['id']?>">
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
