<style type="text/css">
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
	    font-size: 28px;
	}
	.item-desc-small {
		padding: 10px;
	    background-color: #d6ffaf;
	    text-align: center;
	    font-weight: 500;
	    font-size: 18px;
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
	    margin-bottom: 20px;
	}
	.h4-title{
		font-size: 1.1rem;
		font-weight: 500
	}
	@media (max-width: 767px){
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
	    transform: rotate(22deg);
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
	}
	.accordion .card-header a.collapsed:hover, .accordion .card-header a.collapsed:focus {
	    color: #1c273c;
	    background-color: #71ea00;
	}
	.btn-file {
	    padding: 3px 20px;
	}

</style>
<div class="row" id="app" style="display: block;">
	<h2 class="heading">Formulir Pengawasan</h2>
	<ul id="course-list" class="item-list" role="main">
	<?php 
		foreach($soal as $row): ?>
        <li class="course_single_item course_id_5073 course_status_publish course_author_103"  v-on:click="getSoal(<?= $row->id ?>)">
	   			<div class="row">
	   				<div class="col-md-4 col-sm-4">
						<div class="item-avatar" data-id="5073">
							<a class="" href="#" title="Time Management (Call Center)">
								<img src="http://academy.modena.com/wp-content/uploads/2020/09/Cover-Course-Time-Management.jpg" class="attachment-full size-full wp-post-image" style="max-height: 200px;">
							</a>					
						</div>
					</div>
					<div class="col-md-8 col-sm-8">
						<div class="item">
							<div class="item-title" style="padding-left: 10px;">
								<a href="#"><?= $row->judul ?>
								</a>
							</div>
							
		
	                 		<div class="item-desc">
	                 			<?= $row->deskripsi ?>
							</div>
							
						</div>
					</div>
				</div>
		</li>	
    <? endforeach; ?>
	</ul>

    <h2 class="heading heading-sheet" >{{ judul_soal }}</h2>
    <form id="frm" method="post" class="needs-validation" novalidate="">
      	<div class="accordion" id="accordion" role="tablist" aria-multiselectable="true" v-for="(log, index) in list_soal">
          <div class="card mg-b-20">
            <div class="card-header tx-medium bd-0 tx-white bg-gray-800" :id="'headingOne'+ (index+1)">
            	<a data-toggle="collapse" :href="'#collapseOne'+ (index+1) " aria-expanded="false" :aria-controls="'collapseOne'+ (index+1) ">
                  Soal {{ (index+1) }}
                </a>
            </div>
            <div :id="'collapseOne'+ (index+1) " data-parent="#accordion" class="collapse" role="tabpanel" :aria-labelledby="'headingOne'+ (index+1)">
	            <div class="card-body bd bd-t-0" >
	            	<h3 class="h3-title" style="border-bottom: solid 2px;padding-bottom: 10px;padding-top: 15px;">{{ log.soal }}</h3>
	            	<h4 class="mg-t-10 h4-title">Dokumen yang harus disiapkan</h4>
	              	<div class="item-desc-small">{{ log.keterangan }}</div>
	              	<h4 class="mg-t-10 h4-title">Masukkan Catatan/Keterangan pendukung</h4>
	              	<textarea name="catatan" id="catatan" rows="3" class="form-control" placeholder="" style="height: 50px;" ></textarea>
	         		<h4 class="mg-t-10 h4-title">Lampirkan dokumen pendukung</h4>
		
				    <input id="file-demo" type="file" class="file" multiple=true data-preview-file-type="any">

	            </div>
            </div>
          </div>
       	</div>
       	<button class="btn btn-success btn-rounded btn-block" v-if="judul_soal != ''">Simpan</button>
    </form>
</div>