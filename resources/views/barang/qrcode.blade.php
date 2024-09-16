<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Barcode</title>

    <style>
        .text-center {
            text-align: center;
        }
    </style>
</head>

<body>
    <table width="100%">
        <tr>
            @foreach ($databarang as $barang)
                <td class="text-center">
                    {{-- <p>{{ $produk->nama_barang }} - Rp. {{ format_uang($produk->harga) }}</p> --}}
                    <div class="row" style="margin-top: 25px; margin-bottom: -25px">
                        <img src="{{ asset('assets/images/Layo-Seng-Fong.jpg') }}" alt=""
                            style="height:90px; width:90px;">
                        <img src="data:image/png;base64, {{ base64_encode(QrCode::format('svg')->size(80)->errorCorrection('H')->generate(env('APP_URL') . '/barang/show?kode_barang=' . $barang->kode_barang)) }}"
                            style="margin-left:20px">
                    </div>
                    <br>
                    <hr>
                    {{ $barang->kode_barang }}
                </td>
                @if ($no++ % 3 == 0)
        </tr>
        <tr>
        <tr></tr>
        <tr></tr>
        <tr></tr>
        <tr></tr>
        <tr></tr>
        </tr>
        <tr>
        <tr></tr>
        <tr></tr>
        <tr></tr>
        <tr></tr>
        <tr></tr>
        </tr>
        <tr>
        <tr></tr>
        <tr></tr>
        <tr></tr>
        <tr></tr>
        <tr></tr>
        </tr>
        <tr>
        <tr></tr>
        <tr></tr>
        <tr></tr>
        <tr></tr>
        <tr></tr>
        </tr>
        <tr>
        <tr></tr>
        <tr></tr>
        <tr></tr>
        <tr></tr>
        <tr></tr>
        </tr>
        <tr>
        <tr></tr>
        <tr></tr>
        <tr></tr>
        <tr></tr>
        <tr></tr>
        @endif
        @endforeach
        </tr>
    </table>
</body>

</html>
