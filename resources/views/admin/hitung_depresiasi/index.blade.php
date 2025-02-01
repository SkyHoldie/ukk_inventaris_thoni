@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Hitung Depresiasi</h1>
    <a href="{{ route('admin.hitung_depresiasi.create') }}" class="btn btn-primary mb-3">Tambah Hitung Depresiasi</a>

    @if ($depresiasiItems->isEmpty())
        <div class="alert alert-warning">Tidak ada data depresiasi.</div>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID Pengadaan</th>
                    <th>Tanggal Hitung</th>
                    <th>Durasi (Bulan)</th>
                    <th>Nilai Barang</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($depresiasiItems as $depresiasi)
                <tr>
                    <td>{{ $depresiasi->id_pengadaan }}</td>
                    <td>{{ date('d-m-Y', strtotime($depresiasi->tgl_hitung_depresiasi)) }}</td>
                    <td>{{ $depresiasi->durasi }}</td>
                    <td>Rp {{ number_format($depresiasi->nilai_barang, 0, ',', '.') }}</td>
                    <td>
                        <a href="{{ route('admin.hitung_depresiasi.edit', $depresiasi->id_hitung_depresiasi) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin.hitung_depresiasi.destroy', $depresiasi->id_hitung_depresiasi) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
