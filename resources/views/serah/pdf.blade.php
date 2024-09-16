<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Surat Jalan</title>

    <style>
        table td {
            /* font-family: Arial, Helvetica, sans-serif; */
            font-size: 14px;
        }

        table.data td,
        table.data th {
            border: 1px solid #ccc;
            padding: 5px;
        }

        table.data {
            border-collapse: collapse;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        table.header th {
            border: 1px solid rgb(0, 0, 0);
            padding: 5px;
        }

        .border {
            border: 1px solid rgb(0, 0, 0);
        }

        span b {
            font-size: 10px;
        }
    </style>
</head>

<body>
    <span><b>Untuk Pengguna Barang</b></span>
    <div class="border">
        <table class="table header" width="100%">
            <thead>
                <tr>
                    <th>PT ARMADA HADA GRAHA</th>
                    <th>SERAH TERIMA INVENTARIS KANTOR</th>
                    <th>DEPARTEMEN IT</th>
                </tr>

            </thead>
        </table>
    </div>
    <table width="100%">
        <tr>
            {{-- <td rowspan="4" width="60%">
                <img src="{{ public_path($setting->path_logo) }}" alt="{{ $setting->path_logo }}" width="120">
                <br>
                <br>
                {{ $setting->alamat }}
                <br>
                <br>
            </td> --}}
            <td>
                <table width="100%" style="margin-top: 30px">
                    <tr>
                        <td>Tanggal</td>
                        <td>: {{ tanggal_indonesia(date('Y-m-d')) }}</td>
                    </tr>
                    <tr>
                        <td>Kode Permintaan</td>
                        <td>: {{ $serah_terima[0]->kode_serah ?? '' }}</td>
                    </tr>
                    <tr>
                        <td>Nomor Surat Jalan</td>
                        <td>: {{ $serah_terima[0]->nomor_serah ?? '' }}</td>
                    </tr>
                </table>
            </td>
            <td>
                <table width="100%" style="margin-top: 30px">
                    <tr>
                        <td>User/pemohon</td>
                        <td>: {{ $serah_terima[0]->user ?? '' }}</td>
                    </tr>
                    <tr>
                        <td>Lokasi</td>
                        <td>: {{ $serah_terima[0]->lokasi[0]->nama_lokasi ?? '' }}</td>
                    </tr>
                    <tr>
                        <td>Departemen</td>
                        <td>: {{ $serah_terima[0]->lokasi[0]->departemen ?? '' }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <table class="data" width="100%" style="margin-top: 30px">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Barang</th>
                <th>Kategori</th>
                <th>Merk</th>
                <th>Tipe</th>
                <th>Lokasi Awal</th>
                <th>Lokasi Tujuan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($detail as $key => $item)
                <tr>
                    <td class="text-center">{{ $key + 1 }}</td>
                    <td>{{ $item->kode_barang }}</td>
                    <td>{{ $item->nama_kategori }}</td>
                    <td>{{ $item->merek }}</td>
                    <td>{{ $item->tipe }}</td>
                    <td>{{ $item->lokasi1->nama_lokasi }}</td>
                    <td>{{ $item->lokasi2->nama_lokasi }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    <span>Inventaris tersebut digunakan untuk mendukung kelancaran aktivitas kantor/proyek agar dapat dirawat dengan
        baik.</span><br>
    <table width="100%" style="margin-top: 30px; margin-bottom:100px">
        <tr>
            <td class="text-center">
                Administrator
                <br>
                <br>
                <br>
                <br>
                {{ Auth::user()->name }}
            </td>
            <td class="text-center">
                User/Pemohon
                <br>
                <br>
                <br>
                <br>
                {{ $serah_terima[0]->user }}
            </td>
        </tr>
    </table>

    {{-- untuk IT --}}
    <span><b>Untuk Departemen IT</b></span>
    <div class="border">
        <table class="table header" width="100%">
            <thead>
                <tr>
                    <th>PT ARMADA HADA GRAHA</th>
                    <th>SERAH TERIMA INVENTARIS KANTOR</th>
                    <th>DEPARTEMEN IT</th>
                </tr>

            </thead>
        </table>
    </div>
    <table width="100%">
        <tr>
            {{-- <td rowspan="4" width="60%">
                <img src="{{ public_path($setting->path_logo) }}" alt="{{ $setting->path_logo }}" width="120">
                <br>
                <br>
                {{ $setting->alamat }}
                <br>
                <br>
            </td> --}}
            <td>
                <table width="100%" style="margin-top: 30px">
                    <tr>
                        <td>Tanggal</td>
                        <td>: {{ tanggal_indonesia(date('Y-m-d')) }}</td>
                    </tr>
                    <tr>
                        <td>Kode Permintaan</td>
                        <td>: {{ $serah_terima[0]->kode_serah ?? '' }}</td>
                    </tr>
                    <tr>
                        <td>Nomor Surat Jalan</td>
                        <td>: {{ $serah_terima[0]->nomor_serah ?? '' }}</td>
                    </tr>
                </table>
            </td>
            <td>
                <table width="100%" style="margin-top: 30px">
                    <tr>
                        <td>User/pemohon</td>
                        <td>: {{ $serah_terima[0]->user ?? '' }}</td>
                    </tr>
                    <tr>
                        <td>Lokasi</td>
                        <td>: {{ $serah_terima[0]->lokasi[0]->nama_lokasi ?? '' }}</td>
                    </tr>
                    <tr>
                        <td>Departemen</td>
                        <td>: {{ $serah_terima[0]->lokasi[0]->departemen ?? '' }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <table class="data" width="100%" style="margin-top: 30px">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Barang</th>
                <th>Kategori</th>
                <th>Merk</th>
                <th>Tipe</th>
                <th>Lokasi Awal</th>
                <th>Lokasi Tujuan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($detail as $key => $item)
                <tr>
                    <td class="text-center">{{ $key + 1 }}</td>
                    <td>{{ $item->kode_barang }}</td>
                    <td>{{ $item->nama_kategori }}</td>
                    <td>{{ $item->merek }}</td>
                    <td>{{ $item->tipe }}</td>
                    <td>{{ $item->lokasi1->nama_lokasi }}</td>
                    <td>{{ $item->lokasi2->nama_lokasi }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    <span>Inventaris tersebut digunakan untuk mendukung kelancaran aktivitas kantor/proyek agar dapat dirawat dengan
        baik.</span><br>
    <table width="100%" style="margin-top: 30px">
        <tr>
            <td class="text-center">
                Administrator
                <br>
                <br>
                <br>
                <br>
                {{ Auth::user()->name }}
            </td>
            <td class="text-center">
                User/Pemohon
                <br>
                <br>
                <br>
                <br>
                {{ $serah_terima[0]->user }}
            </td>
        </tr>
    </table>
</body>

</html>
