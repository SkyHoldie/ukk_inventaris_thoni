<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\HitungDepresiasi;
use App\Models\Pengadaan;
use Illuminate\Http\Request;

class HitungDepresiasiController extends Controller
{
    // Menampilkan daftar hitung depresiasi
    public function index()
    {
        $depresiasiItems = HitungDepresiasi::all(); // Mengambil semua data hitung depresiasi
        return view('admin.hitung_depresiasi.index', compact('depresiasiItems'));
    }

    // Menampilkan form untuk membuat hitung depresiasi baru
    public function create()
    {
        $pengadaan = Pengadaan::all();
        return view('admin.hitung_depresiasi.create', compact('pengadaan'));
    }

    // Menyimpan hitung depresiasi baru
    public function store(Request $request)
    {
        $request->validate([
            'id_pengadaan' => 'required|exists:tbl_pengadaan,id_pengadaan',
            'tgl_hitung_depresiasi' => 'required|date',
            'bulan' => 'required|string|max:10',
            'durasi' => 'required|integer',
            'nilai_barang' => 'required|numeric',
        ]);

        HitungDepresiasi::create([
            'id_pengadaan' => $request->id_pengadaan,
            'tgl_hitung_depresiasi' => $request->tgl_hitung_depresiasi,
            'bulan' => $request->bulan,
            'durasi' => $request->durasi,
            'nilai_barang' => $request->nilai_barang,
        ]);

        return redirect()->route('admin.hitung_depresiasi.index');
    }



    // Menampilkan form untuk mengedit hitung depresiasi
    public function edit($id)
    {
        $hitungDepresiasi = HitungDepresiasi::findOrFail($id);
        $pengadaan = Pengadaan::all();
        return view('admin.hitung_depresiasi.edit', compact('hitungDepresiasi', 'pengadaan'));
    }

    // Memperbarui data hitung depresiasi
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_pengadaan' => 'required|exists:tbl_pengadaan,id_pengadaan',
            'tgl_hitung_depresiasi' => 'required|date',
            'bulan' => 'required|string|max:10',
            'durasi' => 'required|integer',
            'nilai_barang' => 'required|numeric',
        ]);

        $depresiasiItem = HitungDepresiasi::findOrFail($id);
        $depresiasiItem->update([
            'id_pengadaan' => $request->id_pengadaan,
            'tgl_hitung_depresiasi' => $request->tgl_hitung_depresiasi,
            'bulan' => $request->bulan,
            'durasi' => $request->durasi,
            'nilai_barang' => $request->nilai_barang,
        ]);

        return redirect()->route('admin.hitung_depresiasi.index');
    }


    // Menghapus data hitung depresiasi
    public function destroy($id)
    {
        $depresiasiItem = HitungDepresiasi::findOrFail($id);
        $depresiasiItem->delete();

        return redirect()->route('admin.hitung_depresiasi.index');
    }
}
