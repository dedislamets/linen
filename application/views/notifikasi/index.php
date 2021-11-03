<div class="az-content-body az-content-body-mail">
          <div class="az-mail-header">
            <div>
              <h4 class="az-content-title mg-b-5">Notifikasi</h4>
              <!-- <p>You have 2 unread messages</p> -->
            </div>
            <div>
              <span>1-50 of 1200</span>
              <div class="btn-group" role="group">
                <button type="button" class="btn btn-outline-secondary disabled"><i class="fa fa-arrow-left"></i></button>
                <button type="button" class="btn btn-outline-secondary"><i class="fa fa-arrow-right"></i></button>
              </div>
            </div>
          </div><!-- az-mail-list-header -->


          <div class="az-mail-list">
            <!-- <div class="az-mail-item unread">
              <div class="az-mail-checkbox">
                <label class="ckbox">
                  <input type="checkbox">
                  <span></span>
                </label>
              </div>
              <div class="az-mail-star">
                <i class="typcn typcn-star"></i>
              </div>
              <div class="az-img-user"><img src="../img/faces/face1.jpg" alt=""></div>
              <div class="az-mail-body">
                <div class="az-mail-from">Adrian Monino</div>
                <div class="az-mail-subject">
                  <strong>Someone who believes in you</strong>
                  <span>enean commodo li gula eget dolor cum socia eget dolor enean commodo li gula eget dolor cum socia eget dolor</span>
                </div>
              </div>
              <div class="az-mail-attachment"><i class="typcn typcn-attachment"></i></div>
              <div class="az-mail-date">11:30am</div>
            </div> -->
            
            
            <?php 
              	foreach($notif as $row)
              	{ ?>
              	<a href="<?= base_url().$row->url ?>?rd=yes&id=<?= $row->id ?>">
	              	<div class="az-mail-item">
		  
		              <div class="az-mail-body">
		                <div class="az-mail-from">Unit Laundry</div>
		                <div class="az-mail-subject">
		                  <strong><?= $row->short_msg ?></strong>
		                  <span><?= $row->short_msg ?></span>
		                </div>
		              </div>
		              <div class="az-mail-date"><?= tgl_waktu_indo( $row->insert_date ) ?></div>
		            </div>
		        </a>
              	<?php
              	}
              	?>
          </div><!-- az-mail-list -->

          <div class="mg-lg-b-30"></div>

        </div>