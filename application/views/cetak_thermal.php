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
            <img src="<?= base_url(); ?>assets\images\logo rsud gambiran.png" style="height: 80px;width: 80px;padding-left: 105px;">
            <p class="centered">Formulir Distribusi Linen Kotor Bersih<br>
                RSUD Gambiran Kota Kediri<br>
                Instalasi Laundry
            </p>
            <table width="100%">
                <thead>
                    <tr>
                        <th class="quantity">Q.</th>
                        <th class="description">Description</th>
                        <th class="price">$$</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="quantity">1.00</td>
                        <td class="description">ARDUINO UNO R3</td>
                        <td class="price">$25.00</td>
                    </tr>
                    <tr>
                        <td class="quantity">2.00</td>
                        <td class="description">JAVASCRIPT BOOK</td>
                        <td class="price">$10.00</td>
                    </tr>
                    <tr>
                        <td class="quantity">1.00</td>
                        <td class="description">STICKER PACK</td>
                        <td class="price">$10.00</td>
                    </tr>
                    <tr>
                        <td class="quantity"></td>
                        <td class="description">TOTAL</td>
                        <td class="price">$55.00</td>
                    </tr>
                </tbody>
            </table>
            <p class="centered">Thanks for your purchase!
                <br>parzibyte.me/blog</p>
        </div>
        <button id="btnPrint" class="hidden-print">Print</button>
        <script type="text/javascript">
            const $btnPrint = document.querySelector("#btnPrint");
            $btnPrint.addEventListener("click", () => {
                window.print();
            });
        </script>
    </body>
</html>