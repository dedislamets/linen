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
    <div class="ticket_dua">
        <table style="width: 100%;" class="full-border">
            <tr style="border-top: unset;">
                <td style="border-top: unset;width: 20%;padding: 10px;text-align:center;">
                    <img src="<?= base_url() . 'upload/logo/' . $setup[0]->Logo ?>" style="width: 60px;height: 60px;">
                </td>
                <td style="border-top: unset;width: 40%;padding: 10px;text-align:center;">
                    <h1>Linen Kotor</h1>
                </td>
                <td style="border-top: unset;width: 20%;padding: 10px;text-align:center;">
                    <img src="<?= base_url() . 'upload/logo/' . $setup[0]->Logo ?>" style="width: 60px;height: 60px;">
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <div class="headerSubTitleNormal">
                        UNIT INSTALASI LAUNDRY <?= $setup[0]->company ?>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <table style="width: 100%" class="no-border">
                        <tr class="no-border">
                            <td style="width:50%;border-right: 1px solid black;" class="no-border">
                                <table width="100%" class="no-border">
                                    <tr class="no-border">
                                        <td class="no-border">Servered By</td>
                                        <td class="no-border">:</td>
                                        <td class="no-border"><?= $kotor['PIC'] ?></td>
                                    </tr>
                                    <tr class="no-border">
                                        <td colspan="3" class="no-border">UNIT INSTALASI LAUNDRY</td>
                                    </tr>
                                </table>
                                <table width="100%">
                                    <tr class="no-border">
                                        <td class="no-border" width="90px;">Collected By</td>
                                        <td class="no-border" width="10px">:</td>
                                        <td class="no-border">-</td>
                                    </tr>
                                    <tr class="no-border">
                                        <td colspan="3" class="no-border"><?= $setup[0]->company ?></td>
                                    </tr>
                                </table>
                            </td>
                            <td style="width:50%" class="no-border">
                                <div style="font-size: 18pt;text-align: center;font-weight: bold;">
                                    <?= $no_transaksi ?>
                                </div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <table style="width: 100%" class="no-border">
                        <tr class="no-border">
                            <td style="width:50%;border-right: 1px solid black;" class="no-border">
                                <table width="100%" class="no-border">
                                    <tr class="no-border">
                                        <td class="no-border">
                                            <div class="flex">
                                                <div id="qrcode"></div>
                                            </div>
                                        </td>
                                        <td class="no-border">
                                            <table width="100%" class="no-border">
                                                <tr class="no-border">
                                                    <td class="no-border">Description</td>
                                                    <td class="no-border">:</td>
                                                    <td class="no-border">-</td>
                                                </tr>
                                                <tr class="no-border">
                                                    <td colspan="3" class="no-border">LINEN </td>
                                                </tr>
                                            </table>
                                            <table width="100%">
                                                <tr class="no-border">
                                                    <td class="no-border" width="90px;">Instruksi Khusus</td>
                                                    <td class="no-border" width="10px">:</td>
                                                    <td class="no-border">-</td>
                                                </tr>
                                                <tr class="no-border">
                                                    <td colspan="3" class="no-border">FILE TERLAMPIR</td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>

                            </td>
                            <td style="width:50%" class="no-border">
                                <input type="hidden" name="id" id="id" value="<?= $kotor['id'] ?>">
                                <table width="100%" class="no-border">
                                    <tr class="no-border">
                                        <td class="no-border" width="90px;" style="vertical-align: top;">Tanggal</td>
                                        <td class="no-border" width="10px">:</td>
                                        <td class="no-border"><?= tgl_waktu_indo($kotor['CURRENT_INSERT']) ?></td>
                                    </tr>
                                    <tr class="no-border">
                                        <td class="no-border" width="90px;">Infeksius</td>
                                        <td class="no-border" width="10px">:</td>
                                        <td class="no-border"><?= $kotor['F_INFEKSIUS'] ?></td>
                                    </tr>
                                    <tr class="no-border">
                                        <td class="no-border" width="90px;">Jenis Cucian</td>
                                        <td class="no-border" width="10px">:</td>
                                        <td class="no-border"><?= $kotor['KATEGORI'] ?></td>
                                    </tr>
                                    <tr class="no-border">
                                        <td class="no-border" width="90px;">Total Berat</td>
                                        <td class="no-border" width="10px">:</td>
                                        <td class="no-border"><?= $berat ?></td>
                                    </tr>
                                    <tr class="no-border">
                                        <td class="no-border" width="90px;">Jumlah</td>
                                        <td class="no-border" width="10px">:</td>
                                        <td class="no-border"><?= $jml ?></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <p style="margin: 0;font-weight: bold;text-align: center;">Struk ini merupakan bukti sah</p>
                </td>
            </tr>
        </table>


    </div>
    <button id="btnPrint" class="hidden-print">Print</button>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/davidshimjs-qrcodejs@0.0.2/qrcode.min.js"></script>
    <script type="text/javascript">
        const $btnPrint = document.querySelector("#btnPrint");
        $btnPrint.addEventListener("click", () => {
            window.print();
        });
        var id_kotor_encrypted = btoa(document.querySelector("#id").value);
        var qrcode = new QRCode(document.getElementById("qrcode"), {
            text: "<?= base_url() ?>linenkotor/detail/" + id_kotor_encrypted,
            colorDark: "#000000",
            colorLight: "#ffffff",
            width: 100,
            height: 100,
            correctLevel: QRCode.CorrectLevel.H,
        });
    </script>
</body>

</html>