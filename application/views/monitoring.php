
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <!-- <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url(); ?>assets/img//apple-icon.png"> -->
  <!-- <link rel="icon" type="image/png" href="<?= base_url(); ?>assets/img//favicon.png"> -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <META NAME="GENERATOR" Content="Microsoft Developer Studio">
  <META HTTP-EQUIV="Content-Type" content="text/html; charset=gb_2312-80">
  <title>
    Management Linen
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
 
 
  <!-- <link href="<?= base_url(); ?>assets/azia/lib/fontawesome-free/css/all.min.css" rel="stylesheet"> -->
  <link href="<?= base_url(); ?>assets/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">
  <link href="<?= base_url(); ?>assets/azia/lib/ionicons/css/ionicons.min.css" rel="stylesheet">
  <link href="<?= base_url(); ?>assets/azia/lib/typicons.font/typicons.css" rel="stylesheet">
  <link href="<?= base_url(); ?>assets/azia/lib/flag-icon-css/css/flag-icon.min.css" rel="stylesheet">
  <link href="<?= base_url(); ?>assets/azia/lib/datatables.net-dt/css/jquery.dataTables.min.css" rel="stylesheet">
  <link href="<?= base_url(); ?>assets/azia/lib/datatables.net-responsive-dt/css/responsive.dataTables.min.css" rel="stylesheet">
  <!-- azia CSS -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/azia/css/azia.css">
  <link rel="stylesheet" href="<?= base_url(); ?>assets/css/chosen.min.css" />
  <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/buttons.dataTables.min.css">
  <link rel="stylesheet" href="<?= base_url(); ?>assets/css/animate.min.css"/>
  <!--<link rel="stylesheet" href="<?= base_url(); ?>assets/css/bootstrap-tagsinput.css"> -->
  <!-- <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/jstree/css/style.min.css"> -->
  <style type="text/css">
    .bg-dark {
      background-color: #1c7116 !important;
    }
    .icon-big {
      font-size: 45px;
    }
    .card-category {
      font-size: 22px;
      font-weight: bold;
      margin-bottom: 0.5rem;
    }
    .card-title {
      font-size: 18px;
    }
    .status-trans{
      font-size: 22px;
      font-weight: bold;
      color: darkorange;
      background-color: black;
      padding:4px;
      text-align: center;
    }
    .info-text {
      margin-bottom: 12px;
      padding-left: 10%;
      font-size: 36px;
      font-weight: bold;
    }
    .btn-mini {
      padding: 5px 10px;
      line-height: 14px;
      font-size: 10px;
    }

    .btn-inverse {
        background-color: #404E67;
        border-color: #404E67;
        color: #fff;
        cursor: pointer;
        -webkit-transition: all ease-in 0.3s;
        transition: all ease-in 0.3s;
    }
    .loader {
        font-size: 10px;
        margin: 17% auto;
        text-indent: -9999em;
        width: 11em;
        height: 11em;
        border-radius: 50%;
        background: #400000;
        background: -moz-linear-gradient(left, #400000 10%, rgba(64,0,0, 0) 42%);
        background: -webkit-linear-gradient(left, #400000 10%, rgba(64,0,0, 0) 42%);
        background: -o-linear-gradient(left, #400000 10%, rgba(64,0,0, 0) 42%);
        background: -ms-linear-gradient(left, #400000 10%, rgba(64,0,0, 0) 42%);
        background: linear-gradient(to right, #400000 10%, rgba(64,0,0, 0) 42%);
        position: relative;
        -webkit-animation: load3 1.4s infinite linear;
        animation: load3 1.4s infinite linear;
        -webkit-transform: translateZ(0);
        -ms-transform: translateZ(0);
        transform: translateZ(0);
      }
      .loader:before {
        width: 50%;
        height: 50%;
        background: #400000;
        border-radius: 100% 0 0 0;
        position: absolute;
        top: 0;
        left: 0;
        content: '';
      }
      .loader:after {
        background: #f8f8f8;
        width: 75%;
        height: 75%;
        border-radius: 50%;
        content: '';
        margin: auto;
        position: absolute;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
      }
      #loadingDiv {
              position:absolute;;
              top:0;
              left:0;
              width:100%;
              height:100%;
              background-color:#f8f8f8;
              opacity: 0.8;
          }
      @-webkit-keyframes load3 {
        0% {
          -webkit-transform: rotate(0deg);
          transform: rotate(0deg);
        }
        100% {
          -webkit-transform: rotate(360deg);
          transform: rotate(360deg);
        }
      }
      @keyframes load3 {
        0% {
          -webkit-transform: rotate(0deg);
          transform: rotate(0deg);
        }
        100% {
          -webkit-transform: rotate(360deg);
          transform: rotate(360deg);
        }
      }
    .label-info {
      background-color: #411588;
      padding: 7px;
    }
    .bootstrap-tagsinput {
      padding: 10px;
    }
    .bootstrap-tagsinput input { display: none; }
    #overlay {
      position: fixed; 
      display: none; 
      width: 100%; /* Full width (cover the whole page) */
      height: 100%; /* Full height (cover the whole page) */
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: rgba(0,0,0,0.5); /* Black background with opacity */
      z-index: 2; /* Specify a stack order in case you're using a different order for other elements */
      cursor: pointer; /* Add a pointer on hover */
    }
    #text{
      width: 50%;
      position: absolute;
      top: 50%;
      left: 50%;
      font-size: 50px;
      color: white;
      transform: translate(-50%,-50%);
      -ms-transform: translate(-50%,-50%);
      background-color: #fff;
    }
    .text-loading {
      font-size: 20px;
      text-align: center;
      position: absolute;
      left: 26%;
      bottom: 52px;
    }
    .az-logo {
      color: green;
    }
    .back-green {
      background-color: rgb(46 182 63);
    }
  </style>
</head>

<body >
  <OBJECT
    id=TUHF2000 
    codebase="UHF2000.ocx"
    classid="clsid:FACF7D39-9E21-40F7-A30A-80BDE4558AE3"
      width=0
      height=0
      align=center
      hspace=0
      vspace=0
    >
  </OBJECT>
  <div class="az-header">
    <div class="container">
      <div class="az-header-left">
        <a href="<?= base_url()?>accpac" class="az-logo"><span></span>Management Linen</a>
        <a href="#" id="azMenuShow" class="az-header-menu-icon d-lg-none"><span></span></a>
      </div><!-- az-header-left -->
      <div class="az-header-menu">
        
        <div class="az-header-menu-header">
          <a href="<?= base_url()?>accpac" class="az-logo"><span></span> Linen</a>
          <a href="#" class="close">&times;</a>
        </div><!-- az-header-menu-header -->

        <?php $this->load->view('nav'); ?>

        
      </div><!-- az-header-menu -->
      <div class="az-header-right">
        <a href="#" class="az-header-search-link"><?php echo $this->session->userdata('nama'); ?></a>  
        <div class="dropdown az-profile-menu">
          <a href="#" class="az-img-user">
            <img src='https://avataaars.io/?avatarStyle=Circle&topType=ShortHairShortFlat&accessoriesType=Prescription02&hairColor=Black&facialHairType=Blank&clotheType=CollarSweater&clotheColor=Blue03&eyeType=Surprised&eyebrowType=UpDownNatural&mouthType=Twinkle&skinColor=Light'/>
          </a>
          <div class="dropdown-menu">
            <div class="az-dropdown-header d-sm-none">
              <a href="#" class="az-header-arrow"><i class="icon ion-md-arrow-back"></i></a>
            </div>
            <div class="az-header-profile">
              <div class="az-img-user">
                <img src='https://avataaars.io/?avatarStyle=Circle&topType=ShortHairShortFlat&accessoriesType=Prescription02&hairColor=Black&facialHairType=Blank&clotheType=CollarSweater&clotheColor=Blue03&eyeType=Surprised&eyebrowType=UpDownNatural&mouthType=Twinkle&skinColor=Light'/>
              </div><!-- az-img-user -->
              <h6><?= $this->session->userdata('user_name') ?></h6>
              <span><?= $this->session->userdata('role_name') ?></span>
            </div><!-- az-header-profile -->

            <!-- <a href="#" class="dropdown-item"><i class="typcn typcn-user-outline"></i> My Profile</a>
            <a href="#" class="dropdown-item"><i class="typcn typcn-edit"></i> Edit Profile</a>
            <a href="#" class="dropdown-item"><i class="typcn typcn-time"></i> Activity Logs</a>
            <a href="#" class="dropdown-item"><i class="typcn typcn-cog-outline"></i> Account Settings</a> -->
            <a href="<?= base_url() ?>login/keluar" class="dropdown-item"><i class="typcn typcn-power-outline"></i> Sign Out</a>
          </div><!-- dropdown-menu -->
        </div>
      </div><!-- az-header-right -->
    </div><!-- container -->
  </div>
  
  <div class="landing-sass-header-content bg-dark">
    <div class="container">
        <h1 class="text-center font-weight-bold pt-5 pb-30px mb-10 text-white">Security your linen<br> 
        Detect UHF RFID automatically
        </h1>
        <div class="text-center mb-5 "><button class="btn btn-light mr-3">Get started</button><button class="btn btn-outline-light">Demo video</button></div>
    </div>
  </div>
  <div class="text-center landing-sass-header-img-wrapper">
    <img src="<?= base_url(); ?>assets/images/security-linen.png" alt="header-img" class="img-fluid" width="707px">
  </div>

  <script src="<?= base_url(); ?>assets/js/core/jquery.min.js"></script>
  <script src="<?= base_url(); ?>assets/js/core/popper.min.js"></script>
  <script src="<?= base_url(); ?>assets/js/core/bootstrap.min.js"></script>
  <script src="<?= base_url(); ?>assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  
  <script src="<?= base_url(); ?>assets/js/jquery-ui.min.js"></script>
  <!-- <script src="<?= base_url(); ?>assets/azia/lib/jquery/jquery.min.js"></script>
  <script src="<?= base_url(); ?>assets/azia/lib/bootstrap/js/bootstrap.bundle.min.js"></script> -->
  <script src="<?= base_url(); ?>assets/azia/lib/ionicons/ionicons.js"></script>
  <script src="<?= base_url(); ?>assets/azia/lib/jquery.flot/jquery.flot.js"></script>
  <script src="<?= base_url(); ?>assets/azia/lib/jquery.flot/jquery.flot.resize.js"></script>
  <script src="<?= base_url(); ?>assets/azia/lib/chart.js/Chart.bundle.min.js"></script>
  <script src="<?= base_url(); ?>assets/azia/lib/peity/jquery.peity.min.js"></script>

  <script src="<?= base_url(); ?>assets/azia/js/azia.js"></script>
  <script src="<?= base_url(); ?>assets/js/chosen.jquery.min.js"></script>
  <script src="<?= base_url(); ?>assets/azia/lib/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="<?= base_url(); ?>assets/azia/lib/datatables.net-dt/js/dataTables.dataTables.min.js"></script>
  <script src="<?= base_url(); ?>assets/azia/lib/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
  <script src="<?= base_url(); ?>assets/azia/lib/datatables.net-responsive-dt/js/responsive.dataTables.min.js"></script>
  <script type="text/javascript" src="<?= base_url(); ?>assets/js/dataTables.buttons.min.js"></script>
  <script src="<?= base_url(); ?>assets/js/plugins/moment.min.js"></script>
  <script src="<?= base_url(); ?>assets/js/sweetalert2.js"></script>
  <script src="<?= base_url(); ?>assets/js/bootstrap-tagsinput.min.js"></script>
  <script src="<?= base_url(); ?>assets/js/plugins/jquery.validate.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/vue"></script>
  <script type="text/javascript" src="<?= base_url(); ?>assets/jstree/js/jstree.min.js"></script>
  <script type="text/javascript" src="<?= base_url(); ?>assets\switchery\js\switchery.min.js"></script>

  <script>
    $.ajaxSetup({
        data: {
            csrf_token: <?php echo "'". $this->security->get_csrf_hash()."'" ?>
        }
    });
    function showloader(val){
      $(val).append('<div style="" id="loadingDiv"><div class="loader">Loading...</div></div>');
    }
    function hideloader(){
      $( "#loadingDiv" ).fadeOut(500, function() {
          $( "#loadingDiv" ).remove(); 
        }); 
    }

    function chosen(){
      $('.chosen-select').chosen({allow_single_deselect:true}); 
      //resize the chosen on window resize

      $(window)
      .off('resize.chosen')
      .on('resize.chosen', function() {
        $('.chosen-select').each(function() {
           var $this = $(this);
           $this.next().css({'width': $this.parent().width()});
        })
      }).trigger('resize.chosen');
      //resize chosen on sidebar collapse/expand
      $(document).on('settings.ace.chosen', function(e, event_name, event_val) {
        if(event_name != 'sidebar_collapsed') return;
        $('.chosen-select').each(function() {
           var $this = $(this);
           $this.next().css({'width': $this.parent().width()});
        })
      });
    }
  </script>

</body>

</html>