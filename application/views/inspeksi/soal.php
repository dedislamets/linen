<style type="text/css">
	.az-content .container {
	    display: block;
	}
	.heading {
	    clear: both;
	    font-size: 2rem;
	    padding: 8px 0;
	    font-weight: 600;
	    border-bottom: solid 4px grey;
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
		    padding: 10px 20px 12px 20px;
		}
		.h3-soal{
			display: none;
		}
		.card__owner {
		    color: #084d4a;
		    font-size: 14px;
		    font-weight: 400;
		    margin-bottom: 0;
		}
		.card__integral, .card__amount {
		    font-size: 10.5px;
		    color: #fff;
		    font-weight: 300;
		    letter-spacing: 0.25px;
		}
		.deskripsi {
			display: none;
		}
	}

	.card{
		border-radius: 30px;
		margin-bottom: 10px;
	}

	.card {
	  margin: 0 auto;
	  margin-bottom: 12.5px;
	  /*border-radius: 5px;*/
	      padding: 10px 20px 0px 20px;
	  box-shadow: 0 10px 25px #dcdcdc;
	}
	.card__amount { margin-left: 10px }
	.card__info {display: flex }
	.card__owner_main {
	    color: #084d4a;
	    margin-bottom: 0;
	    font-size: 20px;
	    font-weight: 500;
	    line-height: 1;
	  }
	.card__owner {
	    color: #084d4a;
	    font-size: 18px;
	    font-weight: 400;
	    margin-bottom: 0;
	}

	.card__integral, .card__amount {
	    font-size: 14px;
	    color: #fff;
	    font-weight: 300;
	    letter-spacing: 0.25px;
	}
	.card__number {
	    font-size: 18px;
	    font-weight: bold;
	    text-align: center;
	    letter-spacing: 1.2px;
    	color: #383837;
	    margin-bottom: 10px;
	    border-bottom: solid 1px;
	    padding-bottom: 7px;
	}
	.card-one {
		background: linear-gradient(to right, #d194ff, #9389ff)
	}
	.card-two {
		background: linear-gradient(to right, #7cbfee, #00d0b8);
	}
	.card-three {
		background: linear-gradient(to right, #ff77a7, #ff7b7e)
	}


	.card-body {
	    padding: 1rem;
	}
	h4{
		padding-top: 10px;
		font-size: 16px;
		padding-left: 10px;
    	font-weight: 500;
	}
	.ui-datepicker {
	    z-index: 3000 !important;
	}
</style>
<div class="row" id="app" style="display: block;">
	<h2 class="heading">Master Soal Inspeksi
		<div style="float: right;padding-left: 10px;" data-toggle="modal" data-target="#ModalAdd">
			<span class="fa fa-filter"></span>
		</div>
		<div style="float: right;" >
			<a href="<?= base_url()?>soal/create"><span class="fa fa-plus"></span></a>
		</div>
	</h2>
	<h4></h4>
	<div class="row">
		<?php 
		foreach($soal as $row): ?>
		      	<div class="col-12 col-md-6 col-xl-6">
					<div class="card <?= $row->class ?>">
				      	<p class="card__number"><?= $row->judul ?></p>
				      	<div class="row">
					      	<div class="col-4">
					      		<img src="<?= base_url() ?>assets/images/checklist.png" class="img img-fluid" style="max-height: 200px;border: solid 2px darkgray;padding: 10px;">
					      	</div>
					      	<div class="col-8">
						      	<p class="card__owner_main"><?= $row->deskripsi ?></p>
						      	<!-- <p class="card__owner"><?= $row->task ?></p> -->
						      	<p class="card__owner deskripsi"  style="font-size: 13px"><?= $row->task ?></p>
						      	<div class="card__info">
						        	<p class="card__integral">Dibuat : <?= $row->insert_date ?></p>
						      	</div>
								<div style="padding-bottom: 10px;" class="row">
									<div class="col-6">
							      		<a href="<?= base_url() ?>soal/edit/<?= $row->id ?>" class="btn btn-success btn-rounded btn-block"><span class="fa fa-edit"></span>&nbsp; Edit</a>
							      	</div>
							      	<div class="col-6">
						      			<a href="<?= base_url() ?>soal/delete/<?= $row->id ?>" class="btn btn-danger btn-rounded btn-block"><span class="fa fa-edit"></span>&nbsp; Hapus</a>
						      		</div>
								</div>
					      	</div>
					    </div>
				    </div>
				</div>
		<? endforeach; ?>
	</div>

</div>
<?php
  $this->load->view($modal); 
?>