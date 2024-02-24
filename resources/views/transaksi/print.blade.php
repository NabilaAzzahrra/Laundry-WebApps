<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faktur Laundry {{ $transaksi->kode_invoice }}</title>
    <style>
        body {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
            background-color: #FAFAFA;
            font: 12pt "Tahoma";
        }

        * {
            box-sizing: border-box;
            -moz-box-sizing: border-box;
        }

        .page {
            width: 210mm;
            min-height: 297mm;
            padding: 15mm;
            margin: 10mm auto;
            border: 1px #D3D3D3 solid;
            border-radius: 5px;
            background: white;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .subpage {
            padding: 1cm;
            border: 5px red solid;
            height: 257mm;
            outline: 2cm #FFEAEA solid;
        }

        .notrans {
            color: red;
        }

        td {
            padding-top: 5px;
        }

        @page {
            size: A4;
            margin: 0;
        }

        @media print {

            html,
            body {
                width: 210mm;
                height: 297mm;
            }

            .page {
                margin: 0;
                border: initial;
                border-radius: initial;
                width: initial;
                min-height: initial;
                box-shadow: initial;
                background: initial;
                page-break-after: always;
            }
        }
    </style>
</head>

<body>
    <div class="book">
        <div class="page" id="result">
            <h2 style="text-align: center;">FAKTUR LAUNDRY</h2>
            <p style="margin-top: 50px; margin-bottom: 30px;"><b> Nomor Transaksi : </b> <span
                    class="notrans">{{ $transaksi->kode_invoice }}</span></p>
            <table>
                <tr>
                    <td>Pelanggan</td>
                    <td>:</td>
                    <td>{{ $transaksi->member->nama }}</td>
                </tr>
                <tr>
                    <td>Terima</td>
                    <td>:</td>
                    <td>{{ date('d-m-Y', strtotime($transaksi->tgl)) }}</td>
                </tr>
                <tr>
                    <td>Pembayaran</td>
                    <td>:</td>
                    <td>{{ date('d-m-Y', strtotime($transaksi->tgl_bayar)) }}</td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td>:</td>
                    <td>{{ $transaksi->status }}</td>
                </tr>
            </table>
            <p style="margin-top: 20px; margin-bottom: 20px;"><b> Detail Biaya </b> </p>
            <table style="border-collapse: collapse; margin: 0 auto;">
                <tr>
                    <th style="border: 1px solid black; padding: 8px;">No</th>
                    <th style="border: 1px solid black; padding: 8px;">Paket</th>
                    <th style="border: 1px solid black; padding: 8px;">Keterangan</th>
                    <th style="border: 1px solid black; padding: 8px;">Harga</th>
                    <th style="border: 1px solid black; padding: 8px;">Qty</th>
                    <th style="border: 1px solid black; padding: 8px;">Total</th>
                </tr>
                @php
                    $no = 1;
                    $totalHarga = 0;
                @endphp
                @foreach ($transaksi->detailtransaksi as $detail)
                    @php
                        $total = $detail->qty * $detail->paket->harga;
                        $totalHarga += $total;
                        $pajak = $transaksi->pajak * ($totalHarga+$transaksi->biaya_tambahan);
                        $diskon = $transaksi->diskon / 100;
                        $totaldiskon = ($totalHarga + $transaksi->biaya_tambahan + $pajak)*$diskon;
                        $totalbayar = ($totalHarga + $transaksi->biaya_tambahan + $pajak)-$totaldiskon;
                    @endphp
                    <tr>
                        <td style="border: 1px solid black; padding: 8px;">{{ $no++ }}.</td>
                        <td style="border: 1px solid black; padding: 8px;">{{ $detail->paket->nama_paket }}</td>
                        <td style="border: 1px solid black; padding: 8px;">{{ $detail->keterangan }}</td>
                        <td style="border: 1px solid black; padding: 8px;">{{ $detail->paket->harga }}</td>
                        <td style="border: 1px solid black; padding: 8px;">{{ $detail->qty }}</td>
                        <td style="border: 1px solid black; padding: 8px;">{{ $total }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td style="border: 1px solid black; padding: 8px;" colspan="5">Total Harga</td>
                    <td style="border: 1px solid black; padding: 8px;">{{ $totalHarga }}</td>
                </tr>
                <tr>
                    <td style="border: 1px solid black; padding: 8px;" colspan="5">Biaya Tambahan</td>
                    <td style="border: 1px solid black; padding: 8px;">{{ $transaksi->biaya_tambahan }}</td>
                </tr>
                <tr>
                    <td style="border: 1px solid black; padding: 8px;" colspan="5">Pajak</td>
                    <td style="border: 1px solid black; padding: 8px;">{{ $pajak }}</td>
                </tr>
                <tr>
                    <td style="border: 1px solid black; padding: 8px;" colspan="5">Diskon</td>
                    <td style="border: 1px solid black; padding: 8px;">{{ $totaldiskon }}</td>
                </tr>
                <tr style="background-color: red; color:white">
                    <td style="border: 1px solid black; padding: 8px;" colspan="5"><b>Total Bayar</b></td>
                    <td style="border: 1px solid black; padding: 8px;"> <b>{{$totalbayar }}</b></td>
                </tr>
            </table>
        </div>
    </div>
</body>
<script>
    window.print()
</script>
</html>
