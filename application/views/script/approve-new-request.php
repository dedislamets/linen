<link href="https://cdn.shopify.com/s/files/1/0067/5617/1846/t/2/assets/timber.scss.css" rel="stylesheet" type="text/css" media="all" />
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
<link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.css" rel="stylesheet" type="text/css" media="all" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.css" rel="stylesheet" type="text/css"/>


<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/elevatezoom/3.0.8/jquery.elevatezoom.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>

<script>
    $(document).ready(function() {
        $('.fancybox').fancybox();

        $("#btnApprove").on('click', function(e) {
            e.preventDefault();
            $.get('<?=base_url()?>newrequest/approved', { id: $(this).data('id') }, function(data){ 
                    Swal.fire({ title: "Berhasil disimpan..!",
                        text: "",
                        timer: 2000,
                        icon: 'success',
                        showConfirmButton: false,
                        willClose: () => {
                            window.location.reload();
                        }
                    });
               
            });
        })
        $("#btnRejected").on('click', function(e) {
            e.preventDefault();
            $.get('<?=base_url()?>newrequest/rejected', { id: $(this).data('id') }, function(data){ 
                    Swal.fire({ title: "Berhasil disimpan..!",
                        text: "",
                        timer: 2000,
                        icon: 'success',
                        showConfirmButton: false,
                        willClose: () => {
                            window.location.reload();
                        }
                    });
               
            });
        })
    });
</script>
<script>
    function productZoom(){
        $(".product-zoom").elevateZoom({
          gallery: 'ProductThumbs',
          galleryActiveClass: "active",
          zoomType: "inner",
          cursor: "crosshair"
        });$(".product-zoom").on("click", function(e) {
          var ez = $('.product-zoom').data('elevateZoom');
          $.fancybox(ez.getGalleryList());
          return false;
        });
        
    };
    function productZoomDisable(){
        if( $(window).width() < 767 ) {
          $('.zoomContainer').remove();
          $(".product-zoom").removeData('elevateZoom');
          $(".product-zoom").removeData('zoomImage');
        } else {
          productZoom();
        }
    };

    productZoomDisable();

    $(window).resize(function() {
        productZoomDisable();
    });
</script>
<script>
    $('.product-thumbnail').owlCarousel({
        loop: false,
        center: true,
        nav: true,dots:false,
        margin:10,
        autoplay: true,
        autoplayTimeout: 5000,
        navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
        item: 3,
        responsive: {
            0: {
                items: 2
            },
            480: {
                items: 3
            },
            992: {
                items: 3,
            },
            1170: {
                items: 3,
            },
            1200: {
                items: 3
            }
        }
    });
</script>