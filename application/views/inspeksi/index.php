<style type="text/css">
	.title-sub {
		padding: 5px 10px;
	    background: green;
	    color: #fff;
	    font-size: 15pt;
	    margin-bottom: 0;
	}
	.az-content .container {
	    display: block;
	}
	.heading {
	    clear: both;
	    font-size: 2rem;
	    padding: 8px 0;
	    font-weight: 600;
	}
	.project-list-showcase {
	     margin-left: -10px; 
	     margin-right: -10px; 
	     margin-bottom: -10px; 
	}
	
	ul.item-list {
	    border-top: 1px solid rgba(0,0,0,.08);
	    width: 100%;
	    display: inline-block;
	    list-style: none;
	    clear: both;
	    margin: 0;
	    padding: 10px;
	}
	.tab2 {
      padding-left: 30px !important;
  	}

	ul.item-list li {
	    border-bottom: 1px solid rgba(0,0,0,.08);
	    padding: 20px 10px;
	    margin: 0;
	    position: relative;
	    list-style: none;
	    clear: both;
	    display: block;
	}
	ul.item-list li .item-avatar {
	    text-align: center;
	    overflow: hidden;
	}
	.item-desc {
		padding: 10px;
	    background-color: #e0ffc3;
	    text-align: center;
	    font-weight: 500;
	    font-size: 24px;
	    margin-bottom: 10px;
	}
	.item-desc-small {
		padding: 10px;
	    background-color: #feffaf;;
	    text-align: center;
	    font-weight: 500;
	    font-size: 18px;
	}
	.item-desc-small-sub  {
	    padding: 5px;
	    background-color: #feffaf;
	    text-align: center;
	    font-weight: 500;
	    font-size: 18px;
	    display: inline;
	}

	ul.item-list li a {
	    font-weight: 600;
	    color: #000;
    	padding-left: 10px;
	}
	.item-avatar a {
	    width: 100%;
	}

	ul.item-list li .item-avatar img {
	    border-radius: 4px;
	    -webkit-transition: all .5s ease-in-out;
	    transition: all .5s ease-in-out;
	}
	ul.item-list li div.item-title, ul.item-list li h4 {
	    margin: 0;
	    font-weight: 600;
	    font-size: 25px;
	    background-color: #a3ff4d;
	}
	li .item-meta {
	    display: block;
	    margin-top: 5px;
	    font-size: 11px;
	    line-height: 1.6;
	    color: #bbb;
	}
	.heading-sheet {
		border-bottom: 5px solid rgba(0, 0, 0, 0.08);
	    text-align: center;
	    margin-bottom: 5px;
	}
	.h4-title{
		font-size: 1.1rem;
		font-weight: 500
	}
	.status-sign-left{
		margin-bottom: 5px;
		text-align: left;
		font-size: 18px;
		font-weight: 300;
	}
	.status-sign-right{
		margin-bottom: 5px;
		text-align: right;
		font-size: 18px;
		font-weight: bold;
	}
	@media (max-width: 767px){
		.status-sign-left{
			text-align: center;
		}
		.status-sign-right{
			text-align: center;
		}
		ul.item-list li div.item-desc {
		    clear: both;
		    margin: 10px 0 0;
			font-size: 14px;
		}
		ul.item-list li div.item-title, ul.item-list li h4 {
		    font-size: 20px;
		}
		.h3-title{
			font-size: 1rem;
		}
		.h4-title{
			font-size: 0.8rem;
			font-weight: 500
		}
		.heading {
		    font-size: 1.3rem;
		    padding: 10px 20px 0px 20px;
		}
		.h3-soal{
			display: none;
		}
	}

	button {
	  border: none;
	  background: none;
	  font-size: 24px;
	  color: #8bc34a;
	  cursor: pointer;
	  transition:.5s;
	  &:hover{
	    color: #4CAF50  ;
	    /*transform: rotate(22deg);*/
	  }
	}
	.project-list-showcase .project-grid .project-grid-inner {
		height: 150px;
	}
	.judul{
	    font-size: 36px;
	    color: #222222;
	    margin-bottom: 12px;
	}
	.accordion .card .card-header a {
	    background-color: #e0ffc3;
	    color: #000;
	    padding-right: 27px;
	}
	.accordion .card-body {
	    background-color: #f6f8fd;
	}
	.accordion .card-header a.collapsed:hover, .accordion .card-header a.collapsed:focus {
	    color: #1c273c;
	    background-color: #71ea00;
	}
	.btn-file {
	    padding: 3px 20px;
	}
	[class*=btn-outline-] {
	    line-height: 1;
	}
	.accordion .card {
	    border-radius: .55rem;
	}
	.title-sub-sub {
		border-bottom: 2px solid;
		padding-bottom: 10px;
	    padding-top: 15px;
	    background-color: yellow;
	    padding-left: 10px;
	    font-size: 15pt;
	}
	.ganti-sukses{
		background-color: green !important;
		color: #fff !important;
	}
</style>
<div class="row" id="app" style="display: block;">
	<form id="frm" method="post" class="needs-validation" enctype='multipart/form-data'>
		<section id="section-judul" v-if="section_judul">
			<h2 class="heading">Formulir Pengawasan <a href="<?= base_url() ?>pengawasan/history" class="btn btn-dark btn-with-icon" style="float: right"><i class="typcn typcn-folder"></i> History</a></h2>
			<ul id="course-list" class="item-list" role="main">
			<?php 
				foreach($soal as $row): ?>
		        <li class="li-soal"  v-on:click="getSoal(<?= $row->id ?>)">
			   			<div class="row">
			   				<div class="col-md-4 col-sm-4">
								<div class="item-avatar" >
									<a class="" href="#" title="">
										<img src="<?= base_url() ?>assets/images/checklist.png" class="attachment-full size-full wp-post-image" style="max-height: 200px;border: solid 2px darkgray;padding: 10px;">
									</a>					
								</div>
							</div>
							<div class="col-md-8 col-sm-8">
								<div class="item" style="padding: 10px;">
									<div class="item-title" style="text-align: center;">
										<a href="#"><?= $row->judul ?>
										</a>
									</div>
				
			                 		<div class="item-desc">
			                 			<?= $row->deskripsi ?>
									</div>
									<input type="hidden" name="tanggal" id="tanggal" value="<?= $row->tanggal ?>">
									<?php if(!empty($row->current_date)): ?>
										<p style="background-color: yellow;padding: 5px 10px;display: inline;font-style: italic;">Terakhir diubah : <?= tgl_waktu_indo($row->current_date) ?></p>
									<?php endif; ?>
								</div>
							</div>
						</div>
				</li>	
		    <?php endforeach; ?>
			</ul>
		</section>
		<section id="section-isi" v-if="section_isi">
		    <h2 class="heading heading-sheet" >{{ judul_soal }}</h2>
	    	<div class="row">
				<div class="col-sm-6 col-12">
					<p class="status-sign-left" v-html="task"></p>
				</div>
				<div class="col-sm-6 col-12">
					<p class="status-sign-right">Skor : {{ total_penilaian }}</p>
				</div>
			</div>
	    	<input type="hidden" name="id_soal" id="id_soal" :value="id_soal">
	    	<input type="hidden" name="tanggal" id="tanggal" :value="tanggal">
	      	<div class="accordion" id="accordion" role="tablist" aria-multiselectable="true" v-for="(log, index) in list_soal">
	          <div class="card mg-b-20">
	            <div class="card-header tx-medium bd-0 tx-white bg-gray-800" :id="'headingOne'+ (index+1)">
	            	<a data-toggle="collapse" :href="'#collapseOne'+ (index+1) " aria-expanded="false" :aria-controls="'collapseOne'+ (index+1) " :class="`${log.flag || (log.count_sub > 0 && (log.count_sub_submit == log.count_sub)) ? 'ganti-sukses' : ''}`">
	            		<table>
	            			<tr>
	            				<td width="30" style="vertical-align: top;">{{(index+1)}}. </td>
	            				<td>{{ log.soal }} <span v-if="log.flag" class="fa fa-check" style="font-size: 25px"></span></td>
	            			</tr>
	            		</table>
	                 
	                 
	                 <span v-if="log.count_sub > 0 && (log.count_sub_submit < log.count_sub)" style="color: #d66e14;">{{ log.count_sub_submit }} Task submit dari {{ log.count_sub }} Task</span>
	                 <span v-if="log.count_sub > 0 && (log.count_sub_submit == log.count_sub)" style="color: rgb(68 240 8);">Task Completed</span>
	                </a>
	            </div>
	            <div :id="'collapseOne'+ (index+1) " data-parent="#accordion" class="collapse" role="tabpanel" :aria-labelledby="'headingOne'+ (index+1)">
	            	<div class="card-body bd bd-t-0" v-if="log.punya_sub != '1'" >
		            	<!-- <h3 class="h3-title h3-soal" style="border-bottom: solid 2px;padding-bottom: 10px;padding-top: 15px;">{{ log.soal }}</h3> -->
		            	<h3 class="h3-title h3-soal" style="border-bottom: solid 2px;padding-bottom: 10px;padding-top: 15px;"></h3>
		            	<h4 class="mg-t-10 h4-title">Dokumen yang harus disiapkan</h4>
		              	<div class="item-desc-small">{{ log.keterangan }}</div>
		              	<h4 class="mg-t-10 h4-title">Masukkan Catatan/Keterangan pendukung</h4>
		              	<input type="hidden" name="id_soal_detail[]" :value="log.id" >
		              	<textarea name="catatan[]" id="catatan" rows="3" class="form-control" placeholder="" style="height: 50px;" :value="log.catatan" ></textarea>
		         		<h4 class="mg-t-10 h4-title">Lampirkan dokumen pendukung</h4>
			
					    <input :id="'filefoto'+ log.id" name="filefoto[]" type="file" class="file" multiple=true accept=".jpg,.gif,.png,.jpeg,.xls,.xlsx,.pdf,.mp4">

		            </div>
	            	<template v-for="(lo, ind) in log.sub">
	            		<h2 class="title-sub">{{ ind }}</h2>
	            		<template v-for="l in lo.data">
				            <div class="card-body bd bd-t-0" style="margin-bottom: 10px;">
				            	<h3 class="h3-title h3-soal title-sub-sub" >{{ l.soal }}</h3>
				            	<h4 class="mg-t-10 h4-title" style="border-bottom: solid 2px;padding-bottom: 15px;padding-top: 10px;">Dokumen yang harus disiapkan : 
				            		<div class="item-desc-small-sub">{{ log.keterangan }}</div>
				            	</h4>
				              	
				              	<h4 class="mg-t-10 h4-title">Masukkan Catatan/Keterangan pendukung</h4>
				              	<input type="hidden" name="id_soal_detail[]" :value="l.id" >
				              	<textarea name="catatan[]" :id="'catatan'+ l.id" rows="3" class="form-control" placeholder="" style="height: 50px;" :value="l.catatan" >{{l.catatan}}</textarea>
				         		<h4 class="mg-t-10 h4-title">Lampirkan dokumen pendukung</h4>
					
							    <input :id="'filefoto'+ l.id" name="filefoto[]" type="file" class="file" multiple=true accept=".jpg,.gif,.png,.jpeg,.xls,.xlsx,.pdf,.mp4">

				            </div>
				        </template>
		            </template>
	            </div>
	          </div>
	       	</div>
	       	<input type="hidden" id="csrf_token" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" >
	       	<div class="row">
	       		<div class="col-sm-6 col-md-3 col-6">
		       		<button class="btn btn-info btn-rounded btn-block" v-on:click="kembali($event)"><< Kembali</button>  
		       	</div>
		       	<?php 
		       	if($this->session->userdata('role') == "Pengawas"): ?>
		       	<div class="col-sm-6 col-md-9 col-6">
	       			<button class="btn btn-success btn-rounded btn-block" v-if="judul_soal != ''" v-on:click="submitForm($event)"><span class="fa fa-save"></span>&nbsp;&nbsp;Simpan</button> 
	       		</div> 
	       		<?php endif; ?>
	       	</div>
	    </section>
    </form>
</div>