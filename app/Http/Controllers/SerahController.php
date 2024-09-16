<?php

namespace App\Http\Controllers;

use App\Models\SerahTerima;
use App\Models\SerahTerimaDetail;
use Illuminate\Http\Request;
use PDF;

class SerahController extends Controller
{
    public function cetakPdf(Request $request)
    {
        $id_serah = $request->id;
        $serah_terima = SerahTerima::with(['lokasi'])->where('id', $id_serah)->get();
        $detail = SerahTerimaDetail::leftjoin('barangs', 'barangs.id', '=', 'serah_terima_details.barang_id')
            ->leftjoin('categories', 'categories.id', 'barangs.category_id')
            ->with(['lokasi1', 'lokasi2'])
            ->where('serah_id', $id_serah)->get();


        $pdf = PDF::loadview('serah.pdf', ['detail' => $detail, 'serah_terima' => $serah_terima]);
        return $pdf->stream();
    }
}
