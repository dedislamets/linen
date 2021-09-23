<div class="card z-depth-0">
        <div class="card-header back-green" style="color:#fff">
          <div class="row">
              <div class="col-xl-10">
                  <h4><?= $title ?> <a href="<?= base_url() ?>linenbersih" style="color: #000;margin-left: 10px;"> Back </a></h4>
                  <span>Halaman ini menampilkan data linen yang tersimpan</span>
              </div>
              <!-- <div class="col-xl-2" >
                <a v-if="mode == 'edit'" href="<?= base_url() ?>cetak/rs?id=<?= empty($data) ? "" : $data['id'] ?>" id="btnCetak" class="btn btn-block btn-warning" target="_blank">  <i class="icofont icofont-print" ></i>Cetak</a>
              </div>
       -->
              <div class="col-xl-2">
                <div class="status-trans"><?= empty($data) ? "INPUT" : $data['STATUS'] ?></div>
              </div>
          </div>
        </div>
        <div class="card-block" style="padding: 10px;">
          <form id="form-routing" name="form-wizard" action="" method="" style="padding-top: 20px;">
            <input type="hidden" name="mode" id="mode" value="<?= $mode ?>">

            <div class="form-group row">
              <label class="col-sm-2 col-form-label" style="font-weight: bold;">NO TRANSAKSI</label>
              <div class="col-sm-10">
                <input type="text" class="form-control form-bg-inverse" id="no_transaksi" name="no_transaksi" value="<?= empty($data) ? "" : $data['NO_TRANSAKSI'] ?>" required readonly>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label" style="font-weight: bold;">TANGGAL </label>
              <div class="col-sm-10">
                <input class="form-control form-bg-inverse" type="date" id="tanggal" name="tanggal" value="<?= empty($data) ? "" : $data['TANGGAL']  ?>" />
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label" style="font-weight: bold;">KATEGORI</label>
              <div class="col-sm-10">
                <select name="kategori" id="kategori" class="form-control">
                  <?php 
                  foreach($kategori as $row)
                  { 
                    if( empty($data) ? "" : $data['KATEGORI'] === $row->kategori){
                      echo '<option value="'.$row->kategori.'" selected >'.$row->kategori.'</option>';
                    }else{
                      echo '<option value="'.$row->kategori.'">'.$row->kategori.'</option>';
                    }
                  }
                  ?>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label" style="font-weight: bold;">PIC</label>
              <div class="col-sm-10">
                <input type="text" class="form-control form-bg-inverse" id="pic" name="pic" placeholder="" value="<?= empty($data) ? "" : $data['PIC'] ?>">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label" style="font-weight: bold;">TOTAL QTY</label>
              <div class="col-sm-4">
                <input type="text" class="form-control" readonly id="total_qty" name="total_qty" placeholder="" value="<?= empty($data) ? "" : $data['TOTAL_QTY'] ?>">
              </div>
              <label class="col-sm-2 col-form-label" style="font-weight: bold;">TOTAL BERAT</label>
              <div class="col-sm-4">
                <input type="text" class="form-control" readonly id="total_berat" name="total_berat" placeholder="" value="<?= empty($data) ? "" : $data['TOTAL_BERAT'] ?>">
              </div>
            </div>
            
            

            <div class="row" id="barang">
              <h4 class="info-text" style="margin-top: 30px;padding-left: 10px;">Data Linen
                  <button class="btn btn-success btn-sm" id="btnAdd" v-if="last_status != 'CLOSED'"><i class="fa fa-plus"></i> Tambah baru</button>
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
                                Serial/EPC
                              </th>
                              <th>
                                Nama Barang
                              </th>
                              <th>
                                Ruangan
                              </th>
                              <th>
                                Berat Kg
                              </th>
                              
                              
                          </tr>
                      </thead>
                      <tbody id="tbody-table">
                          <?php 
                          $urut=1;
                          foreach($data_detail as $row): ?>
                            <tr>
                              <td style="width:1%"><?=$urut?></td>
                              <td width="200">
                                <input type="hidden" id="id_detail<?=$urut?>" name="id_detail<?=$urut?>" class="form-control hidden" value="<?=$row['id']?>">
                                <a href="#" id="cari<?=$urut?>" class="btn hor-grd btn-success" onclick="cari_dealer(this)" v-if="last_status != 'CLOSED'">
                                  <i class="fa fa-search"></i>&nbsp; Cari
                                </a>
                                <a href="javascript:void(0)" class="btn hor-grd btn-danger" onclick="cancel(this)" v-if="last_status != 'CLOSED'"><i class="fa fa-trash"></i>&nbsp; Del</a>
                              </td>
                              <td> 
                                <input type="text" name="epc<?=$urut?>" id="epc<?=$urut?>" class="form-control" value="<?=$row['epc']?>" readonly /></td>
                              <td><input type="text" name="jenis<?=$urut?>" id="jenis<?=$urut?>" readonly class="form-control" value="<?=$row['jenis']?>"/></td>
                              <td>
                                <input type="text" readonly name="ruangan<?=$urut?>" id="ruangan<?=$urut?>" class="form-control" value="<?=$row['ruangan']?>"/>
                              </td>
                              <td>
                                <input type="text" id="berat<?=$urut?>" name="berat<?=$urut?>" placeholder="Kg" class="form-control" style="width:100%" value="<?=$row['berat']?>" readonly>
                              </td>
                            </tr>
                            <?php $urut++?>
                          <?php endforeach; ?>

                      </tbody>
                  </table>
                </div>
              </div>
            </div>
            
            <div class="row">
              <div class="col-sm-12" style="margin-top: 10px;">
                <input type="hidden" name="id_bersih" id="id_bersih" value="<?= empty($data) ? "" : $data['id'] ?>">
                <input type="hidden" id="csrf_token" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" >

                <button class="btn btn-block btn-success" id="btn-finish" v-if="last_status != 'CLOSED'"><i class="fa fa-save"></i>&nbsp; Simpan</button>
              </div>
            </div>
          
          </form>

        </div>
      </div>
<?php
  $this->load->view($modal); 
?>
