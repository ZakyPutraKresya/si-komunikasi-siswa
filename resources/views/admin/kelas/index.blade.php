@extends('layouts.app')
@section('heading', 'Data Kelas')
@section('page')
<li class="breadcrumb-item active">Data Kelas</li>
@endsection
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <button type="button" class="btn btn-primary btn-sm" onclick="getCreateKelas()" data-toggle="modal"
                    data-target="#form-kelas">
                    <i class="nav-icon fas fa-folder-plus"></i> &nbsp; Tambah Data Kelas
                </button>
            </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example2" class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Kelas</th>
                        <th>Wali Kelas</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kelas as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data->nama_kelas }}</td>
                        <td>{{ $data->guru->nama_guru }}</td>
                        <td>
                            <form action="{{ route('kelas.destroy', $data->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <a href="{{ route('siswa.show', Crypt::encrypt($data->id)) }}"
                                    class="btn btn-info btn-sm">
                                    <i class="nav-icon fas fa-users"></i> &nbsp; List Siswa
                                </a>
                                <a href="{{ route('kelas.edit', Crypt::encrypt($data->id)) }}"
                                    class="btn btn-success btn-sm">
                                    <i class="nav-icon fas fa-edit"></i> &nbsp; Edit
                                </a>
                                <button class="btn btn-danger btn-sm"><i class="nav-icon fas fa-trash-alt"></i> &nbsp;
                                    Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<!-- /.col -->

<!-- Extra large modal -->
<div class="modal fade bd-example-modal-md" id="form-kelas" tabindex="-1" role="dialog"
    aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="judul">Tambah Data Kelas</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('kelas.store') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <input type="hidden" id="id" name="id">
                            <div class="form-group" id="form_nama">
                                <label for="nama_kelas">Nama Kelas</label>
                                <input type="text" placeholder="Nama Kelas" id="nama_kelas" name="nama_kelas"
                                    class="select2bs4 form-control @error('nama_kelas') is-invalid @enderror">
                            </div>
                            <div class="form-group" id="form_paket">
                                <label for="jurusan_id">Jurusan</label>
                                <select id="jurusan_id" name="jurusan_id"
                                    class="select2bs4 form-control @error('jurusan_id') is-invalid @enderror">
                                    <option value="">-- Pilih Jurusan --</option>
                                    @foreach ($jurusan as $data)
                                    <option value="{{ $data->id }}">{{ $data->nama_jurusan }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="guru_id">Wali Kelas</label>
                                <select id="guru_id" name="guru_id"
                                    class="select2bs4 form-control @error('guru_id') is-invalid @enderror">
                                    <option value="">-- Pilih Wali Kelas --</option>
                                    @foreach ($guru as $data)
                                    <option value="{{ $data->id }}">{{ $data->nama_guru }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal"><i
                        class='nav-icon fas fa-arrow-left'></i> &nbsp; Kembali</button>
                <button type="submit" class="btn btn-primary"><i class="nav-icon fas fa-save"></i> &nbsp;
                    Tambahkan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $("#MasterData").addClass("active");
    $("#liMasterData").addClass("menu-open");
    $("#DataKelas").addClass("active");
</script>
@endsection