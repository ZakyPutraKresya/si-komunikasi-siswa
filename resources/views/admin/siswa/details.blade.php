@extends('layouts.app')
@section('heading', 'Details Siswa')
@section('page')
  <li class="breadcrumb-item active"><a href="{{ route('siswa.index') }}">Siswa</a></li>
  <li class="breadcrumb-item active">Detail Siswa</li>
@endsection
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <a href="{{ route('siswa.show', Crypt::encrypt($siswa->kelas_id)) }}" class="btn btn-default btn-sm"><i class='nav-icon fas fa-arrow-left'></i> &nbsp; Kembali</a>
        </div>
        <div class="card-body">
            <div class="row no-gutters ml-2 mb-2 mr-2">
                <div class="col-md-4">
                    <img src="{{ asset($siswa->foto) }}" class="card-img img-details" alt="...">
                </div>
                <div class="col-md-1 mb-4"></div>
                <div class="col-md-7">
                    <h5 class="card-title card-text mb-2">Nama : {{ $siswa->name }}</h5>
                    <h5 class="card-title card-text mb-2">No. Induk : {{ $siswa->no_induk }}</h5>
                    <h5 class="card-title card-text mb-2">Jurusan : {{ $siswa->jurusan->nama_jurusan }} </h5>
                    @if($siswa->tingkat == 'X')
                    <h5 class="card-title card-text mb-2">Tingkat : X (Sepuluh)</h5>
                    @elseif($siswa->tingkat == 'XI')
                    <h5 class="card-title card-text mb-2">Tingkat : XI (Sebelas)</h5>
                    @elseif($siswa->tingkat == 'XII')
                    <h5 class="card-title card-text mb-2">Tingkat : XII (Dua Belas)</h5>
                    @endif
                    <h5 class="card-title card-text mb-2">Kelas : {{ $siswa->kelas->nama_kelas }}</h5>
                    
                    @if ($siswa->jk == 'L')
                        <h5 class="card-title card-text mb-2">Jenis Kelamin : Laki-laki</h5>
                    @else
                        <h5 class="card-title card-text mb-2">Jenis Kelamin : Perempuan</h5>
                    @endif
                    <h5 class="card-title card-text mb-2">Tempat Lahir : {{ $siswa->tmp_lahir }}</h5>
                    <h5 class="card-title card-text mb-2">Tanggal Lahir : {{ date('l, d F Y', strtotime($siswa->tgl_lahir)) }}</h5>
                    <h5 class="card-title card-text mb-2">No. Telepon : {{ $siswa->telp }}</h5>
                    <h5 class="card-title card-text mb-2">E-Mail : {{ $siswa->email }}</h5>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script>
        $("#MasterData").addClass("active");
        $("#liMasterData").addClass("menu-open");
        $("#DataSiswa").addClass("active");
    </script>
@endsection