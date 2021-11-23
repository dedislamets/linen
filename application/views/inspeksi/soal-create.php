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
  .v-align-center{
    vertical-align: middle !important;
  }

  .btn-mobile {
    /*padding: 5px 8px;
    min-height: auto;
    margin-top: 10px;*/
  }
  .tab2 {
      padding-left: 30px !important;
  }
  .tab1 {
      background-color: green;
      color: #fff;
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
<div class="card z-depth-0" id="app">
  <div class="card-header back-green" style="color:#fff">
    <div class="row">
        <div class="col-xl-10">
            <h4><?= $title ?> <a href="<?= base_url() ?>soal" id="back" style="color: #000;margin-left: 10px;"> Back </a></h4>
            <span>Halaman ini untuk merequest linen yang bersih</span>
        </div>
        
        <div class="col-xl-2">
          <div class="status-trans">INPUT</div>
        </div>
    </div>
  </div>
  <div class="card-block" style="padding: 10px;">
    <form id="form-soal" name="form-soal" action="" method="">
      <input type="hidden" name="mode" id="mode" value="<?= $mode ?>">

      <div class="form-group row">
        <label class="col-sm-2 col-form-label" style="font-weight: bold;">JUDUL</label>
        <div class="col-sm-10">
          <input type="text" class="form-control form-bg-inverse" id="judul" name="judul" value="<?= empty($soal) ? "" : $soal->judul?>" required >
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2 col-form-label" style="font-weight: bold;">DESKRIPSI </label>
        <div class="col-sm-10">
          <textarea name="deskripsi" id="deskripsi" rows="3" class="form-control" placeholder="" value="<?= empty($soal) ? "" : $soal->deskripsi ?>" ><?= empty($soal) ? "" : $soal->deskripsi ?></textarea>
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Background</label>
        <div class="col-sm-10">
          <select name="class" id="class" class="form-control">
            <option value="card-one" <?= empty($soal) ? "" : ($soal->class == 'card-one' ? 'selected' : '') ?> >Background 1</option>
            <option value="card-two" <?= empty($soal) ? "" : ($soal->class == 'card-two' ? 'selected' : '') ?> >Background 2</option>
          </select>
        </div>
      </div>  
     <div class="form-group row">
        <label class="col-sm-2 col-form-label" style="font-weight: bold;">TOTAL SKOR</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" readonly id="total_skor" name="total_skor" placeholder="" :value="total_skor">
        </div>
      </div>

      <div class="row" id="barang" v-if="mode == 'edit'">
        <h4 class="info-text" style="padding-left: 10px;">
            <button class="btn btn-success btn-sm" id="btnAdd" v-on:click="addModal"> <i class="fa fa-plus"></i> Tambah</button>
        </h4>
        <div class="col-sm-12">
          <div class="dt-responsive table-responsive table-brg">
            <table id="ViewTableBrg" class="table table-bordered" style="margin-top: 0 !important;width: 100% !important;">
                <thead class="text-primary">
                    <tr>
                        <th>No</th>
                        <th>
                          Komponen
                        </th>
                        <th>
                          Bobot
                        </th>
                        <th>
                          Nilai
                        </th>
                        <th>
                          Skor
                        </th>
                        <th>Dokumen</th>
                    </tr>
                </thead>
                <tbody id="tbody-table">
                  <template v-for="(log, index) in list_soal">       
                    <tr  >
                      <td :rowspan="log.count_sub+1" :class="`${log.count_sub > 0 ? 'v-align-center' : ''}`">{{ index +1 }}</td>
                      <td><a href="javascript::void(0)" v-on:click="editModal($event,log.id)">{{log.soal}}</a></td>
                      <td>{{ log.bobot==0 ? '' : log.bobot }}</td>
                      <td>{{ log.nilai_max==0 ? '' : log.nilai_max }}</td>
                      <td>{{ log.skor_max==0 ? '' : log.skor_max }}</td>
                      <td :rowspan="log.count_sub+1" :class="`${log.count_sub > 0 ? 'v-align-center' : ''}`" >{{log.keterangan}}</td>
                    </tr v-if="log.count_sub > 0">
                    <template v-for="(li, ind) in log.sub">
                      <tr>
                        <td class="tab1">{{ind}}</td>
                        <td class="tab1">{{ li.total_bobot }}</td>
                        <td></td>
                        <td></td>
                      </tr>
                      <tr v-for="l in li.data">
                        <td class="tab2"><a href="javascript::void(0)" v-on:click="editModal($event, l.id)">{{l.soal}}</a></td>
                        <td>{{l.bobot}}</td>
                        <td>{{l.nilai_max}}</td>
                        <td>{{l.skor_max}}</td>
                      </tr>
                    </template>
                  </template>
                  
                </tbody>
            </table>
          </div>
        </div>                  
      </div>
      
      <div class="row">
        <div class="col-sm-12" style="margin-top: 10px;">
          <input type="hidden" name="id_soal" id="id_soal" :value="id_soal">
          <input type="hidden" id="csrf_token" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" >

          <button class="btn btn-block btn-success btn-mobile" id="btn-finish"><i class="fa fa-save"></i>&nbsp; Simpan</button>
        </div>
      </div>
    
    </form>
  </div>
<?php
  $this->load->view($modal); 
?>
</div>
