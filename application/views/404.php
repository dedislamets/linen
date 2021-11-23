<style type="text/css">
	a {
	  color: #fff;
	  text-decoration: none;
	  -webkit-transition: all 0.3s;
	      -moz-transition: all 0.3s;
	      -ms-transition: all 0.3s;
	      -o-transition: all 0.3s;
	      transition: all 0.3s;
	}
	ul {
	  margin: 0;
	  padding: 0;
	  list-style: none;
	}

	.img-error {
	  display: block;
	  width: 100%;
	}
	.container-error {
	  background: #cc0c0c;
	  position: relative;
	  margin: 0 auto 5%;
	  padding: 5%;
	  text-align: center;
	  color: #fff;
	}
	.container-error h1 {
	  font-weight: normal;
	  font-size: 24px;
	  margin-bottom: 2em;
	}
	.container-error a.btn {
	  border: 3px solid #fff;
	  border-radius: 2px;
	  padding: 10px 30px;
	  color: #fff;
	  text-transform: uppercase;
	  text-decoration: none;
	  display: inline-block;
	}
	.container-error a.btn.search {
	  border-radius: 0px 2px 2px 0;
	}
	.container-error a.btn:hover {
	  background-color: #fff;
	  color: #d88705;
	}
	input[type="text"] {
	  border: 3px solid #fff;
	  border-right: none;
	  border-radius: 2px 0 0 2px;
	  padding: 10px 30px;
	  color: #fff;
	  background-color: transparent;
	  display: inline-block;
	  outline: none;
	  font-size: inherit;
	  font-family: inherit;
	}
	.scene {
	  padding: 0;
	  margin: 0;
	}

	/* DD Bottom Bar */
	.dd-bar {
	  position: fixed;
	  bottom: 0;
	  left: 0;
	  width: 100%;
	  padding: 15px;
	  background-color: rgba(0, 0, 0, 0.3);
	  text-align: center;
	}
	.dd-bar ul {
	  padding: 0 4%;
	}
	.dd-bar ul li {
	  display: inline-block;
	  padding: 0 10px;
	  font-size: 14px;
	}
	.dd-bar ul li a {
	  opacity: 0.6;
	}
	.dd-bar ul li a:hover {
	  opacity: 1;
	}

	@media only screen and (max-width: 480px), only screen and (max-width: 480px) {
	  input[type="text"] {
	      width: 50%;
	      padding: 10px;
	  }

	  .container-error a.btn {
	    padding: 10px 20px;
	  }

	  .container-error span {
	    display: block;
	    margin: 10px 0;
	  }
	}
	.page-wrapper {
		padding: 0 !important;
	}
</style>
<div id="container-error" class="container-error">
	<ul id="scene" class="scene">
		<li class="layer" data-depth="1.00"><img class="img-error" src="<?= base_url(); ?>assets/images/404-01.png"></li>
		<li class="layer" data-depth="0.60"><img class="img-error" src="<?= base_url(); ?>assets/images/shadows-01.png"></li>
		<li class="layer" data-depth="0.20"><img class="img-error" src="<?= base_url(); ?>assets/images/monster-01.png"></li>
		<li class="layer" data-depth="0.40"><img class="img-error" src="<?= base_url(); ?>assets/images/text-01.png"></li>
		<li class="layer" data-depth="0.10"><img class="img-error" src="<?= base_url(); ?>assets/images/monster-eyes-01.png"></li>
	</ul>
</div>