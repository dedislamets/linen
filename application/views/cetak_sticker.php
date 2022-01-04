<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="<?= base_url(); ?>assets\css\print-thermal.css">
        <title>Cetak</title>
    </head>
    <body>
        <div class="ticket_dua">
            <table style="width: 100%;padding: 10px;" class="full-border">
                <tr>
                    <td style="padding: 10px;">
                        <table style="width: 100%;padding: 10px;" class="no-border">
                            <tr class="no-border">
                                <td style="width:50%;vertical-align: top;" class="no-border">
                                    <img src="<?= base_url(); ?>assets\images\logo.jpeg" style="width: 100px;height: auto;">
                                    <table width="100%" class="no-border">
                                        <tr class="no-border">
                                            <td class="no-border" style="font-weight: bold;font-size: 20px;">GOWN ( Surgical Apparel )</td>
                                        </tr>
                                        <tr class="no-border">
                                            <td class="no-border">Sponbound</td>
                                        </tr>
                                        <tr class="no-border">
                                            <td class="no-border">Long Dress</td>
                                        </tr>
                                    </table>
                                    <table width="100%" class="no-border"style="margin-top: 10px">
                                        <tr class="no-border">
                                            <td class="no-border" style="font-weight: bold;font-size: 20px;">Sachia Ayunda, CV</td>
                                        </tr>
                                        <tr class="no-border">
                                            <td class="no-border">
                                                Jl.M Khafi 1 Brigif IV No. 36<br>
                                                Ciganjur - Jagakarsa<br>
                                                Jakarta Selatan - DKI Jakarta
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td style="width:50%" class="no-border">
                                    <h1 style="text-align: right;font-weight: bold;margin-block-start: 0;">SIZE : ALL SIZE</h1>
                                    <div class="flex" style="flex: 0;float: right;">
                                        <div id="qrcode" style="flex: 0"></div>  
                                    </div>
                                    <div>
                                        <svg id="barcode" ></svg>
                                    </div>
                                    <input type="hidden" name="id" id="id" value="14">
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
           
            
        </div>
        <button id="btnPrint" class="hidden-print">Print</button>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/davidshimjs-qrcodejs@0.0.2/qrcode.min.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>assets/js/JsBarcode.all.min.js"></script>
        <script type="text/javascript">
            JsBarcode("#barcode", "TP-7A8B84",{ height: 50, marginRight: -5});
            const $btnPrint = document.querySelector("#btnPrint");
            $btnPrint.addEventListener("click", () => {
                window.print();
            });

            var qrcode = new QRCode(document.getElementById("qrcode"), {
                text: "RASB",
                colorDark : "#000000",
                colorLight : "#ffffff",
                width : 50,
                height : 50,
                correctLevel : QRCode.CorrectLevel.H,
            });
        </script>
    </body>
</html>