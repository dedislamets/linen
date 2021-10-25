<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="<?= base_url(); ?>assets\css\print-thermal.css">
        <title>Formulir Distribusi Linen Kotor Bersih</title>
    </head>
    <body>
        <div class="ticket">
            <img class="watermark" src="<?= base_url(); ?>assets\images\logo rsud gambiran.png" >
            <div class="judul">Formulir Distribusi Linen Bersih</div>
            <p class="centered" style="margin-block-start: 0;">
                RSUD Gambiran Kota Kediri<br>
                Instalasi Laundry
            </p>

              <div class="headerTitle">
                <?= $keluar['RUANGAN'] ?>
              </div>
              <div class="headerSubTitle">
                <?= $no_transaksi ?>
              </div>
              <div id="location">
                <?= $keluar['PIC'] ?>
              </div>
              <div id="location" style="background: beige;">
                <?= $keluar['NO_REFERENSI'] ?>
              </div>
              <div id="date">
               Waktu : <?= tgl_waktu_indo($keluar['CURRENT_INSERT']) ?>
              </div>

            <!-- <table width="100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th class="quantity">Serial</th>
                        <th class="description">Jenis</th>
                        <th class="price">Berat</th>
                        <th class="price">Harga</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no=1;
                    foreach($data_detail_keluar as $row) : ?> 
                        <tr>
                            <td style="width: 20px;"><?= $no ?></td>
                            <td><?= $row['epc'] ?></td>
                            <td><?= $row['jenis'] ?></td>
                            <td><?= $row['berat'] ?></td>
                            <td><?= $row['harga'] ?></td>
                        </tr>
                    <?php 
                    $no++;
                    endforeach; ?>
                </tbody>
            </table> -->
            <div class="flex">
                <div id="qrcode"></div>  
            </div>
            <p class="centered">Struk ini merupakan bukti sah</p>
        </div>
        <button id="btnPrint" class="hidden-print">Print</button>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/davidshimjs-qrcodejs@0.0.2/qrcode.min.js"></script>
        <script type="text/javascript">
            const $btnPrint = document.querySelector("#btnPrint");
            $btnPrint.addEventListener("click", () => {
                window.print();
            });

            var qrcode = new QRCode(document.getElementById("qrcode"), {
                text: "https://gg.bronyhouse.com/r/122424",
                colorDark : "#000000",
                colorLight : "#ffffff",
              width : 100,
              height : 100,
                correctLevel : QRCode.CorrectLevel.H,
            });
        </script>
    </body>
</html>