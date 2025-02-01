@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h4>Edit Hitung Depresiasi</h4>
    <form action="{{ route('admin.hitung_depresiasi.update', $hitungDepresiasi->id_hitung_depresiasi) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Pengadaan</label>
            <select name="id_pengadaan" class="form-control" required>
                <option value="">-- Pilih Pengadaan --</option>
                @foreach($pengadaan as $item)
                    <option value="{{ $item->id_pengadaan }}" {{ $hitungDepresiasi->id_pengadaan == $item->id_pengadaan ? 'selected' : '' }}>
                        {{ $item->kode_pengadaan }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Tanggal Hitung Depresiasi</label>
            <input type="date" name="tgl_hitung_depresiasi" class="form-control" value="{{ $hitungDepresiasi->tgl_hitung_depresiasi }}" required>
        </div>
        <div class="mb-3">
            <label>Bulan</label>
            <input type="text" name="bulan" class="form-control" value="{{ $hitungDepresiasi->bulan }}" required maxlength="10">
        </div>
        <div class="mb-3">
            <label>Durasi</label>
            <input type="number" name="durasi" class="form-control" value="{{ $hitungDepresiasi->durasi }}" required>
        </div>
        <div class="mb-3">
            <label>Nilai Barang</label>
            <input type="number" name="nilai_barang" class="form-control" value="{{ $hitungDepresiasi->nilai_barang }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('admin.hitung_depresiasi.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
