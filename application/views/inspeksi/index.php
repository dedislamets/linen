<style type="text/css">
	/*.cards{
	  background:#fff;
	  border-radius:15px;
	  box-shadow:0px 10px 20px 20px rgba(0,0,0,0.17);
	  display:inline-block;
	  padding:30px 35px;
	  -webkit-perspective:1800px;
	  perspective:1800px;
	  text-align:left;
	  -webkit-transform-origin:50% 50%;
	  transform-origin:50% 50%;
	  -webkit-transform-style:preserve-3d;
	  transform-style:preserve-3d;
	  -webkit-transform:rotateX(11deg) rotateY(16.5deg);
	  transform:rotateX(11deg) rotateY(16.5deg);
	  min-width:595px;
	}
	.card{
	  border-radius:15px;
	  box-shadow:5px 5px 20px -5px rgba(0,0,0,0.6);
	  display:inline-block;
	  height:250px;
	  overflow:hidden;
	  -webkit-perspective:1200px;
	  perspective:1200px;
	  position:relative;
	  -webkit-transform-style:preserve-3d;
	  transform-style:preserve-3d;
	  -webkit-transition:-webkit-transform 200ms ease-out;
	  transition:-webkit-transform 200ms ease-out;
	  transition: transform 200ms ease-out;
	  transition: transform 200ms ease-out, -webkit-transform 200ms ease-out;
	  width:100%;
	  text-align: center;
	}
	.card:not(:last-child){
	  margin-right:30px;
	}
	.card__img{
	  position:relative;
	  height:100%;
	}
	.card__bg{
	  bottom:-50px;
	  left:-50px;
	  right:-50px;
	  top:-50px;
	  position:absolute;
	  -webkit-transform-origin:50% 50%;
	  transform-origin:50% 50%;
	  -webkit-transform:translateZ(-50px);
	  transform:translateZ(-50px);
	  z-index:-1;
	}
	.card__one .card__img{
	  top:14px;
	  right:-10px;
	  height:110%;
	}
	.card__one .card__bg{
	  background: url('<?= base_url() ?>assets/img/damir-bosnjak.jpg') center/cover no-repeat;
	}

	.card__two .card__img{
	  top:25px;
	}
	.card__two .card__bg{
	  background: url('../images/3dr_spirited.jpg') center/cover no-repeat;
	}

	.card__three .card__img{
	  top:5px;
	  left:-4px;
	  height:110%;
	}
	.card__three .card__bg{
	  background: url('../images/3dr_howlbg.jpg') center/cover no-repeat;
	}
	.card__text{
	  -webkit-box-align:center;
	  align-items:center;
	  background:-webkit-gradient(linear, left top, left bottom, from(rgba(0,0,0,0)), to(rgba(0,0,0,0.55)));
	  background:linear-gradient(to bottom, rgba(0,0,0,0) 0%, rgba(0,0,0,0.55) 100%);
	  bottom:0;
	  display:-webkit-box;
	  display:flex;
	  -webkit-box-orient:vertical;
	  -webkit-box-direction:normal;
	  flex-direction: column;
	  bottom: 50%;
    	top: 50%;
	  -webkit-box-pack:center;
	  justify-content:center;
	  position:absolute;
	  width:100%;
	  z-index:2;
	}
	.card__title{
	  color:#fff;
	  font-size:18px;
	  font-weight:700;
	  padding:0 10px;
	  margin-bottom:3px;
	}*/
	.heading {
	    margin: 20px 0;
	}

	.heading {
	    clear: both;
	    font-size: 22px;
	    padding: 8px 0;
	    font-weight: 600;
	    border-bottom: 3px solid rgba(0,0,0,.08);
	}
	.project-list-showcase {
	     margin-left: -10px; 
	     margin-right: -10px; 
	     margin-bottom: -10px; 
	}
	.cardi {
	    background: #fff;
	    border-radius: 4px;
	    border: 2px solid gray;
	    max-width: 400px;
	    display: flex;
	    flex-direction: row;
	    border-radius: 25px;
	    position: relative;
	    margin-left: 5px;
	    margin-right: 5px;
	    margin-top: 4px;
	    margin-bottom: 10px;
	}
	.cardi h2 {
	  margin: 0;
	  padding: 0 1rem;
	}
	.cardi .title {
	  padding: 1rem;
	  text-align: right;
	  color: green;
	  font-weight: bold;
	  font-size: 12px;
	}
	.cardi .desc {
	  padding: 0.5rem 1rem;
	  font-size: 12px;
	}
	.cardi .actions {
	  display: grid;
	  grid-template-columns: repeat(3, 1fr);
	  align-items: center;
	  padding: 0.5rem 1rem;
	}
	.cardi svg {
	    width: 67px;
    	height: 71px;
	  margin: 0 auto;
	}

	.img-avatar {
	  width: 80px;
	  height: 80px;
	  position: absolute;
	  border-radius: 50%;
	  border: 6px solid white;
	  background-image: linear-gradient(-60deg, #16a085 0%, #f4d03f 100%);
	  top: 15px;
	  left: 85px;
	}

	.cardi-text {
	  display: grid;
	  grid-template-columns: 1fr 2fr;
	}

	.title-total {
	  padding: 2.5em 1.5em 1.5em 1.5em;
	}

	path {
	  fill: white;
	}

	.img-portada {
	  width: 100%;
	}

	.portada {
	  width: 100%;
	  height: 100%;
	  border-top-left-radius: 20px;
	  border-bottom-left-radius: 20px;
	  background-image: url("https://m.media-amazon.com/images/S/aplus-media/vc/cab6b08a-dd8f-4534-b845-e33489e91240._CR75,0,300,300_PT0_SX300__.jpg");
	  background-position: bottom center;
	  background-size: cover;
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
	    transform: rotate(22deg)
	  }
	.project-list-showcase .project-grid .project-grid-inner {
		height: 150px;
	}
	.judul{
		font-family: "Roboto", serif;
	    font-size: 36px;
	    color: #222222;
	    margin-bottom: 12px
	}
	
</style>
<div class="row" id="app">
  	<div class="col-lg-12">
    	<div class="" >
      		<div class="" >
      			<h2 class="heading">Silahkan pilih Judul dibawah ini</h2>
                <div class="row project-list-showcase">
                	<?php 
              		foreach($soal as $row): ?>
	                    <div class="cardi">
						  
						  <div class="cardi-text">
						    <div class="portada">
						    	
						    </div>
						    <div class="title-total">   
						    	<h3><?= $row->judul ?></h3>
						  		<div class="desc"><?= $row->deskripsi ?></div>
								<button class="btn btn-success btn-rounded btn-block" v-on:click="getSoal(<?= $row->id ?>)">Mulai</button>
							</div>
						 
						  </div>
						</div>
                    <? endforeach; ?>
                  </div>

                  <h2 class="heading">Silahkan isi pertanyaan dibawah ini</h2>
                  	<template v-for="(log, index) in list_soal">
	                  	<div class="col-md-12 mg-t-20 mg-md-t-0">
			              <div class="card bd-0">
			                <div class="card-header tx-medium bd-0 tx-white bg-gray-800">
			                  Soal {{ (index+1) }}
			                </div>
			                <div class="card-body bd bd-t-0">
			                	<h3>{{ log.soal }}</h3>
			                  <p class="mg-b-0">{{ log.keterangan }}</p>
			                </div>
			              </div>
			           	</div>
            		</template>

      		</div>
  		</div>
  	</div>
</div>