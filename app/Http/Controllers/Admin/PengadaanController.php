<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Depresiasi;
use App\Models\Distributor;
use App\Models\MasterBarang;
use App\Models\Merk;
use App\Models\Pengadaan;
use App\Models\Satuan;
use App\Models\SubKategoriAsset;
use Illuminate\Http\Request;

class PengadaanController extends Controller
{
    // Menampilkan daftar pengadaan
    public function index()
    {
        $pengadaan = Pengadaan::with([
            'masterBarang',
            'depresiasi',
            'merk',
            'satuan',
            'subKategoriAsset',
            'distributor'
        ])->get();
        // dd($pengadaan);


        // $pengadaan = Pengadaan::with('masterBarang', 'depresiasi', 'merk', 'satuan', 'subKategori', 'distributor')->get();
        // dd($pengadaan);
        return view('admin.pengadaan.index', compact(

            'pengadaan',

        ));
    }

    // Menampilkan form untuk membuat pengadaan baru
    public function create()
    {
        $masters = MasterBarang::all();
        $depresiasis = Depresiasi::all();
        $merks = Merk::all();
        $satuans = Satuan::all();
        $subs = SubKategoriAsset::all();
        $distributors = Distributor::all();
        // dd($masters-);
        // $pengadaans = Pengadaan::with('masterBarang','depresiasi','merk','satuan','subKategori','distributor')->get();
        return view(
            'admin.pengadaan.create',
            compact(
                'masters',
                'depresiasis',
                'merks',
                'satuans',
                'subs',
                'distributors',
            )
        );
    }

    // Menyimpan pengadaan baru
    public function store(Request $request)
    {
        // dd($request->input('id_depresiasi'));
        // dd($request->all());

        $validatedData = $request->validate([
            'id_master_barang' => 'required|string|max:10|exists:tbl_master_barang,id_barang',
            'id_depresiasi' => 'required|string|max:10|exists:tbl_depresiasi,id_depresiasi',
            'id_merk' => 'required|string|max:10|exists:tbl_merk,id_merk',
            'id_satuan' => 'required|string|max:10|exists:tbl_satuan,id_satuan',
            'id_sub_kategori_asset' => 'required|string|max:10|exists:tbl_sub_kategori_asset,id_sub_kategori_asset',
            'id_distributor' => 'required|string|max:10|exists:tbl_distributor,id_distributor',
            'kode_pengadaan' => 'required|string|max:20',
            'no_invoice' => 'required|string|max:20',  // Perbaiki nama 'no_invonice' menjadi 'no_invoice'
            'no_seri_barang' => 'required|string|max:50',
            'tahun_produksi' => 'required|numeric|digits:4',  // Menggunakan 'numeric' dan membatasi panjangnya menjadi 4 digit
            'tgl_pengadaan' => 'required|date',  // Validasi tanggal
            'harga_barang' => 'required|numeric|min:0',  // Menggunakan 'numeric' dan 'min' untuk batasan nilai
            'nilai_barang' => 'required|numeric|min:0',  // Menggunakan 'numeric' dan 'min' untuk batasan nilai
            'fb' => 'required|in:0,1',
            'keterangan' => 'required|string|max:50',
        ]);
        // dd($validatedData);


        // Menyimpan data pengadaan ke database
        Pengadaan::create($validatedData);

        return redirect()->route('admin.pengadaan.index');
    }


    // Menampilkan pengadaan berdasarkan ID
    public function show($id)
    {
        $pengadaan = Pengadaan::findOrFail($id);
        return view('admin.pengadaan.show', compact('pengadaan'));
    }

    // Menampilkan form untuk mengedit pengadaan
    public function edit($id)
    {

        $masters = MasterBarang::all();
        $depresiasis = Depresiasi::all();
        $merks = Merk::all();
        $satuans = Satuan::all();
        $subs = SubKategoriAsset::all();
        $distributors = Distributor::all();
        $pengadaan = Pengadaan::where('id_pengadaan', $id)->first();
        return view('admin.pengadaan.edit', compact(
            'pengadaan',
            'masters',
            'depresiasis',
            'merks',
            'satuans',
            'subs',
            'distributors',
        ));
    }

    // Memperbarui pengadaan
    public function update(Request $request, $id)
    {
        $pengadaan = Pengadaan::findOrFail($id);
        $pengadaan->update($request->all());
        return redirect()->route('admin.pengadaan.index');
    }

    // Menghapus pengadaan
    public function destroy($id)
    {
        Pengadaan::findOrFail($id)->delete();
        return redirect()->route('admin.pengadaan.index');
    }
}
