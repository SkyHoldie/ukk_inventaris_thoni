@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Edit Pengadaan</h1>
        <div class="card p-4 shadow-sm">
            <form action="{{ route('admin.pengadaan.update', $pengadaan->id_pengadaan) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="id_barang" class="form-label">Nama Barang</label>
                        <select class="form-control" id="id_barang" name="id_master_barang" required>
                            <option value="">Pilih Nama Barang</option>
                            @foreach ($masters as $master)
                                <option value="{{ $master->id_barang }}" {{ $master->id_barang == $pengadaan->id_master_barang ? 'selected' : '' }}>
                                    {{ $master->nama_barang }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="id_merk" class="form-label">Merk</label>
                        <select class="form-control" id="id_merk" name="id_merk" required>
                            <option value="">Pilih Merk</option>
                            @foreach ($merks as $merk)
                                <option value="{{ $merk->id_merk }}" {{ $merk->id_merk == $pengadaan->id_merk ? 'selected' : '' }}>
                                    {{ $merk->merk }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="no_seri_barang" class="form-label">Nomor Seri Barang</label>
                        <input type="text" class="form-control" id="no_seri_barang" name="no_seri_barang"
                            value="{{ old('no_seri_barang', $pengadaan->no_seri_barang) }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="tgl_pengadaan" class="form-label">Tanggal Pengadaan</label>
                        <input type="date" class="form-control" id="tgl_pengadaan" name="tgl_pengadaan"
                            value="{{ old('tgl_pengadaan', $pengadaan->tgl_pengadaan) }}" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="harga_barang" class="form-label">Harga Barang</label>
                        <input type="number" class="form-control" id="harga_barang" name="harga_barang"
                            value="{{ old('harga_barang', $pengadaan->harga_barang) }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="nilai_barang" class="form-label">Nilai Barang</label>
                        <input type="number" class="form-control" id="nilai_barang" name="nilai_barang"
                            value="{{ old('nilai_barang', $pengadaan->nilai_barang) }}" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="fb" class="form-label">FB</label>
                        <select class="form-control" id="fb" name="fb" required>
                            <option value="0" {{ $pengadaan->fb == 0 ? 'selected' : '' }}>Tidak</option>
                            <option value="1" {{ $pengadaan->fb == 1 ? 'selected' : '' }}>Ya</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <input type="text" class="form-control" id="keterangan" name="keterangan"
                            value="{{ old('keterangan', $pengadaan->keterangan) }}">
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-success me-2">Update</button>
                    <a href="{{ route('admin.pengadaan.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
@endsection
