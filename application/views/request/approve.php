<style type="text/css">
  select[readonly]
  {
      pointer-events: none;
  }
  .back-green {
    background-color: rgb(46 182 63) !important;
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

  .gallery-wrap .img-big-wrap img {
    height: auto;
    width: 100%;
    display: inline-block;
    cursor: zoom-in;
  }


  .gallery-wrap .img-small-wrap .item-gallery {
      width: 80px;
      height: 80px;
      border: 1px solid #ddd;
      margin: 7px 2px;
      display: inline-block;
      overflow: hidden;
  }

  .gallery-wrap .img-small-wrap {
      text-align: center;
  }
  .gallery-wrap .img-small-wrap img {
      max-width: 100%;
      max-height: 100%;
      object-fit: cover;
      border-radius: 4px;
      cursor: zoom-in;
  }
  .com-text{
    white-space: pre-wrap;
      word-wrap: break-word;
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
      .back-green{

      }
  }
</style>
<div class="card z-depth-0">
  <div class="card-header back-green" style="color:#fff;background-color: green;">
    <div class="row">
        <div class="col-xl-10">
            <h4><?= $title ?> <a href="<?= base_url() ?>newrequest" id="back" style="color: #000;margin-left: 10px;"> Back </a></h4>
            <span>Halaman ini untuk melakukan approval request linen yang baru/belum terdaftar</span>
        </div>
        
        <!-- <div class="col-xl-2">
          <div class="status-trans"><?= empty($data_detail) ? "Pending" : $data_detail['status'] ?></div>
        </div> -->
    </div>
  </div>
  <div class="card-block" style="padding: 10px;">

      <div class="card" style="margin-top: 10px;background: #f4f4f4">
        <div class="row">
          <div class="col-md-5">
            <div class="product-details-large" id="ProductPhoto" style="padding: 10px;">
                <img id="ProductPhotoImg" class="product-zoom" data-image-id="" alt="" data-zoom-image="<?= base_url() . 'upload/baru/' . $data_detail['images_default'] ?>" src="<?= base_url() . 'upload/baru/' . $data_detail['images_default'] ?>"> 

            </div>
            <div id="ProductThumbs" class="product-thumbnail owl-carousel">
              <?php
                foreach ($data_detail['images'] as $k => $value) {
                  echo '<a class="product-single__thumbnail '. ($k == 0 ? 'active': '') .'" href="'.base_url() .'upload/baru/'. $value['filename'] .'" data-image="'.base_url() .'upload/baru/'. $value['filename'] .'" data-zoom-image="'.base_url() .'upload/baru/'. $value['filename'] .'" data-image-id=" '. $value['id'] .'">';
                  echo '<img src="'.base_url() .'upload/baru/'. $value['filename'] .'" alt=""></a>';
                }
              ?>

            </div>
          </div>
          <aside class="col-sm-7">
            <article class="card-body p-5">
              <h3 class="title mb-3"><?= empty($data_detail) ? "" : $data_detail['jenis']?></h3>

              <p class="price-detail-wrap"> 
                <a href="<?= empty($detail) ? "#" : $detail['link']?>"><span class="price h3 text-warning"> 
                  <span class="currency">Klik untuk buka link referensi</span>
                  </span> 
                </a>
              </p> <!-- price-detail-wrap .// -->
              <dl class="param param-feature">
                <dt>Status#</dt>
                <dd><?= empty($data_detail) ? "" : $data_detail['status']?></dd>
              </dl>
              <dl class="param param-feature">
                <dt>No Request#</dt>
                <dd><?= empty($data_detail) ? "" : $data_detail['no_request']?></dd>
              </dl>
              <dl class="item-property">
                <dt>Spesifikasi</dt>
                <dd class="com-text"><?= empty($data_detail) ? "" : $data_detail['spesifikasi']?></dd>
              </dl>
              <dl class="param param-feature">
                <dt>Qty#</dt>
                <dd><?= empty($data_detail) ? "" : $data_detail['qty']?></dd>
              </dl> 
              
              <hr>
              <?php if($data_detail['status'] == 'Pending' ) { ?>
              <a href="#" class="btn btn-lg btn-primary text-uppercase" id="btnApprove" data-id="<?= empty($data_detail) ? "" : $data_detail['id']?>"> Approve</a>
              <a href="#" class="btn btn-lg btn-outline-danger text-uppercase" id="btnRejected" data-id="<?= empty($data_detail) ? "" : $data_detail['id']?>"> Reject </a>
            <?php } ?>
            </article> 
          </aside> <!-- col.// -->
        </div> <!-- row.// -->
      </div>
  </div>
</div>
