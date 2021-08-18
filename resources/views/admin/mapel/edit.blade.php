@extends('layouts.app')
@section('heading', 'Edit Mapel')
@section('page')
<li class="breadcrumb-item active"><a href="{{ route('mapel.index') }}">Mapel</a></li>
<li class="breadcrumb-item active">Edit Mapel</li>
@endsection
@section('content')
<div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Edit Data Mapel {{$mapel->nama_mapel}}</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ route('mapel.store') }}" method="post">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <input type="hidden" name="mapel_id" value="{{ $mapel->id }}">
                        <div class="form-group">
                            <label for="nama_mapel">Nama Mapel</label>
                            <input type="text" id="nama_mapel" name="nama_mapel" value="{{ $mapel->nama_mapel }}"
                                class="form-control @error('nama_mapel') is-invalid @enderror"
                                placeholder="{{ __('Nama Mata Pelajaran') }}">
                        </div>
                        <div class="form-group">
                            <label for="kelas">Kelas</label>
                            <select id="jurusan_id" name="jurusan_id"
                                class="form-control @error('jurusan_id') is-invalid @enderror select2bs4">
                                <option value="">-- Pilih Kelas --</option>
                                <option value="Semua Kelas" @if ($mapel->jurusan_id == 'Semua Kelas')
                                    selected
                                    @endif
                                    >Semua Kelas</option>
                                @foreach ($jurusan as $data)
                                <option value="{{ $data->id }}" @if ($mapel->jurusan_id ==
                                    $data->id)
                                    selected
                                    @endif
                                    >{{ $data->nama_jurusan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="guru">Guru</label>
                            <select id="guru_id" name="guru_id"
                                class="select2bs4 form-control @error('guru_id') is-invalid @enderror">
                                <option value="">-- Pilih Guru --</option>
                                @foreach ($guru as $data)
                                <option value="{{ $data->id }}" @if ($mapel->guru_id == $data->id)
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
                <a href="#" name="kembali" class="btn btn-default" id="back"><i class='nav-icon fas fa-arrow-left'></i>
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
    $(document).ready(function () {
        $('#back').click(function () {
            window.location = "{{ route('mapel.index') }}";
        });
    });
    $("#MasterData").addClass("active");
    $("#liMasterData").addClass("menu-open");
    $("#DataMapel").addClass("active");
</script>
@endsection