<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use PDF;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class BarangController extends Controller
{
    public function downloadPdf(Request $request)
    {
        set_time_limit(300);
        $databarang = array();
        $masterBarang = $request->input('ids', []);
        foreach ($masterBarang as $id) {
            $barang = Barang::find($id);
            $qrcode[] = base64_encode(QrCode::format('svg')->size(80)->errorCorrection('H')->generate($barang->kode_barang));
            $databarang[] = $barang;
        }

        $no  = 1;
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])
            ->loadView('barang.qrcode', compact('databarang', 'no'));
        $pdf->setPaper('a4', 'potrait');
        return $pdf->stream('barang.pdf');
    }
}
