<?php
  if(empty($notifikasi)){
    $arr_notif = notifikasi();
    $notifikasi = $arr_notif['notifikasi'];
    $notifikasi_count= $arr_notif['notifikasi_count'];
  }
?>
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
  <link href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet">
  <link href="<?= base_url(); ?>assets/signature/css/jquery.signature.css" rel="stylesheet">
  <link rel="stylesheet" href="<?= base_url(); ?>assets/css/jquery.gritter.min.css">
  <!--<link rel="stylesheet" href="<?= base_url(); ?>assets/css/bootstrap-tagsinput.css"> -->
  <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/jstree/css/style.min.css">
  <!-- the fileinput plugin styling CSS file -->
  <link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.6/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.min.css" crossorigin="anonymous">

  <style type="text/css">
    .hidden{
      display: none;
    }
    mark {
      -webkit-border-radius: 20px;
      -moz-border-radius: 20px;
      border-radius: 20px;
      border: 2px solid #FFF;
      width: 20px;
      height: 20px;
      background-color: #ed1f1f;
      position: absolute;
      top: -5px;
      left: 14px;
      font-size: 9px;
      line-height: 14px;
      color: #FFF;
      font-weight: 700;
      text-align: center;
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
  
  <div class="az-header">
    <div class="container">
      <div class="az-header-left">
        <a href="<?= base_url()?>" class="az-logo"><span></span>Management Linen</a>
        <a href="#" id="azMenuShow" class="az-header-menu-icon d-lg-none"><span></span></a>
      </div><!-- az-header-left -->
      <div class="az-header-menu">
        
        <div class="az-header-menu-header">
          <a href="<?= base_url()?>accpac" class="az-logo"><span></span>Menu</a>
          <a href="#" class="close">&times;</a>
        </div>
        <?php $this->load->view('nav'); ?>

        
      </div>
      <div class="az-header-right">
        <!-- <a href="#" class="az-header-search-link"></a>   -->

        <div class="dropdown az-header-notification">
          <a href="#" class="<?= $notifikasi_count == 0 ? '': 'new' ?>">
            <i class="typcn typcn-bell" id="mark">
                <?php if($notifikasi_count > 0 ) : ?>
                  <mark><?= $notifikasi_count ?></mark>
                <?php endif; ?>
            </i>
          </a>
          <div class="dropdown-menu">
            <div class="az-dropdown-header mg-b-20 d-sm-none">
              <a href="#" class="az-header-arrow"><i class="fa fa-times"></i></a>
            </div>
            <h6 class="az-notification-title">Notifikasi</h6>
            <?php if($notifikasi_count == 0 ) : ?>
              <p class="az-notification-text">Tidak ada notifikasi baru</p>
            <?php endif; ?>
            <div class="az-notification-list">
            
              <?php 
              foreach($notifikasi as $row)
              { ?>
                <a href="<?= base_url().$row->url ?>?rd=yes&id=<?= $row->id ?>">
                  <div class="media new">
                    <div class="media-body">
                      <p><strong><?= $row->short_msg ?></strong></p>
                      <span><?= tgl_waktu_indo( $row->insert_date ) ?></span>
                    </div>
                  </div>
                </a>
              <?php
              }
              ?>
            </div><!-- az-notification-list -->
            <div class="dropdown-footer"><a href="<?= base_url() ?>notifikasi">Lihat semua</a></div>
          </div><!-- dropdown-menu -->
        </div>
        <div class="dropdown az-profile-menu">
          <a href="#" class="az-img-user">
            <img src='<?= base_url() ?>assets/images/avaco.png'/>
          </a>
          <div class="dropdown-menu">
            <div class="az-dropdown-header d-sm-none">
              <a href="#" class="az-header-arrow"><i class="icon ion-md-arrow-back"></i></a>
            </div>
            <div class="az-header-profile">
              <div class="az-img-user">
                <img src='<?= base_url() ?>assets/images/avaco.png'/>
              </div>
              <h6><?= $this->session->userdata('username') ?></h6>
              <span><?= $this->session->userdata('role') ?></span>
              <input type="hidden" name="id_user" id="id_user" value="<?= $this->session->userdata('user_id') ?>">
            </div>

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
  <div class="az-content az-content-dashboard">
    <div class="container">
      <div class="az-content-body">
          <?php 
          if ($this->router->fetch_class() != 'dashboard'){            
              $this->load->view($main); 
          }
          else {                  
              $this->load->view('dashboard/index'); 
          } 
          ?>  
      </div>
    </div>
  </div>

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
  <script src="<?= base_url(); ?>assets/signature/js/jquery.signature.js"></script>
  <script type="text/javascript" src="<?= base_url(); ?>assets/signature/js/jquery.ui.touch-punch.min.js"></script>
  <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
  <script src="<?= base_url(); ?>assets/js/jquery.gritter.min.js"></script>

 
  
  <!-- <script src="https://cdn.jsdelivr.net/npm/promise-polyfill@8/dist/polyfill.min.js"></script> -->
   <!-- <script src="<?= base_url(); ?>assets/js/plugins/sweetalert2.min.js"></script> -->
   <script type="text/javascript">
      // function alertOK(href="") {
      //    Swal.fire({ title: "Berhasil disimpan..!",
      //        text: "",
      //        timer: 2000,
      //        icon: 'success',
      //        showConfirmButton: false,
      //        willClose: () => {
      //          if(href != "")
      //             href;
      //       }
      //     });
      // }

      // function alertError(textError = "'Silahkan cek kembali data anda!'") {
      //     Swal.fire({
      //       icon: 'error',
      //       title: 'Oops...',
      //       text: textError,
      //       showConfirmButton: false,
      //       timer: 2000,
      //     })
      // }
      Pusher.logToConsole = true;
      var pusher = new Pusher('3d5d9fdecf424e5c99f4', {
        cluster: 'ap1'
      });

      var channel = pusher.subscribe('linen');
      channel.bind('my-event', function(data) {
        addNotif(JSON.stringify(data));
        // alert(JSON.stringify(data));
      });
   </script>
      <?php
      $this->load->view($js); 
      ?>
  <script>
    $.ajaxSetup({
        data: {
            csrf_token: <?php echo "'". $this->security->get_csrf_hash()."'" ?>
        }
    });
    function addNotif(message) {
      var json = JSON.parse(message);
      $.get('<?= base_url() ?>dashboard/notifikasi/' + json.sent_to, { }, function(data){ 
        if(data.notifikasi.length > 0){   
          if($("#id_user").val() == json.sent_to){          
            $.gritter.add({
              title   : 'Notification',   
              text    : json.short_msg,      
              time    : 5000,    
            });
            $("#card-notifikasi").html('');
            $(".az-notification-list").html('');
            $("#mark").html('');
            var alert = "<div class='alert alert-info' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><strong>Notifikasi</strong> <span id='msg_notif'>Anda mempunyai " + data.notifikasi.length +" notifikasi yang belum dibaca.</span></div>";
            $(alert).appendTo("#card-notifikasi");
            alert="";
            $.each(data['notifikasi'], function(index, obj) {
              alert += "<a href='<?= base_url()?>"+obj.url+"?rd=yes&id="+ obj.id +"'><div class='media new'><div class='media-body'><p><strong>"+ obj.short_msg +"</strong></p><span>"+ obj.insert_date+"</span></div></div></a>";
            })
            $(alert).appendTo(".az-notification-list");
            if(data['notifikasi_count'] > 0){
              $("<mark>"+data['notifikasi_count']+"</mark>").appendTo("#mark");
            }
          }
        }

      });
    }
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