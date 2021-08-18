@extends('layouts.app')
@section('heading', 'Edit Siswa')
@section('page')
<li class="breadcrumb-item active"><a href="{{ route('kelas.index') }}">Kelas</a></li>
<li class="breadcrumb-item active">Edit Kelas</li>
@endsection
@section('content')
<div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Edit Data Kelas {{$kelas->nama_kelas}}</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{route('kelas.update', $kelas->id)}}" method="post">
            @csrf
            @method('patch')
            <div class="card-body">
                <div class="row">
                    <div class="col-md">
                        <div class="form-group">
                            <label for="nama_kelas">Kelas</label>
                            <input type="text" id="nama_kelas" name="nama_kelas" value="{{ $kelas->nama_kelas }}"
                                class="form-control @error('nama_kelas') is-invalid @enderror" >
                        </div>
                        <div class="form-group">
                            <label for="jurusan">Jurusan</label>
                            <select id="jurusan_id" name="jurusan_id"
                                class="select2bs4 form-control @error('jurusan') is-invalid @enderror">
                                <option value="">-- Pilih Jurusan --</option>
                                @foreach ($jurusan as $data)
                                <option value="{{ $data->id }}" @if ($kelas->jurusan_id == $data->id)
                                    selected
                                    @endif
                                    >{{ $data->nama_jurusan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="guru_id">Wali Kelas</label>
                            <select id="guru_id" name="guru_id"
                                class="select2bs4 form-control @error('guru') is-invalid @enderror">
                                <option value="">-- Pilih Jurusan --</option>
                                @foreach ($guru as $data)
                                <option value="{{ $data->id }}" @if ($kelas->guru_id == $data->id)
                                    selected
                                    @endif
                                    >{{ $data->nama_guru }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <a href="{{route('kelas.index')}}" name="kembali" class="btn btn-default" id="back"><i class='nav-icon fas fa-arrow-left'></i>
                    &nbsp; Kembali</a> &nbsp;
                <button name="submit" class="btn btn-primary"><i class="nav-icon fas fa-save"></i> &nbsp;
                    Update</button>
            </div>
        </form>
    </div>
    <!-- /.card -->
</div>
@endsection
@section('script')
<script type="text/javascript">
    $("#MasterData").addClass("active");
    $("#liMasterData").addClass("menu-open");
    $("#DataKelas").addClass("active");
</script>
@endsection