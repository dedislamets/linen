<script type="text/javascript">
    $("#btnReset").on('click', function(e) {
        Swal.fire({
            title: 'Yakin menghapus semua data transaksi?',
            showDenyButton: false,
            showCancelButton: true,
            confirmButtonText: 'Iya',
            denyButtonText: `Tidak`,
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {

                var link = '<?= base_url(); ?>Setup/Reset';
                $.post(link,null, function(data){
                    if(data.error==false){  
                        Swal.fire('Sukses reset data transaksi', '', 'success')
                    }else{
                        Swal.fire(data.msg, '', 'error')
                    }
                },'json');
              
            }
        })

  })
  
</script>