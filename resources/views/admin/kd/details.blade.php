@extends('layouts.app')
@section('heading')
{{$namapel->guru->nama_guru}} ({{$namapel->mapel->nama_mapel}})
@endsection
@section('page')
<li class="breadcrumb-item active">Data Guru ({{$namapel->mapel->nama_mapel}})</li>
@endsection
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <a href="{{ route('KD.index') }}" class="btn btn-default btn-sm"><i
                    class="nav-icon fas fa-arrow-left"></i> &nbsp; Kembali</a>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example2" class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Guru</th>
                        <th>Mapel</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kd as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data->guru->nama_guru }}</td>
                        <td>{{ $data->mapel->nama_mapel }}</td>
                        <td>
                            <a href="{{ route('KD.show', ($data->mapel_id )) }}"
                                class="btn btn-info btn-sm"><i class="nav-icon fas fa-search-plus"></i> &nbsp;
                                Details</a>
                            <a href="{{ route('KD.show', ($data->mapel_id )) }}"
                                class="btn btn-warning btn-sm"><i class="nav-icon fas fa-edit"></i> &nbsp;
                                Edit</a>
                            <a href="{{ route('KD.show', ($data->mapel_id )) }}"
                                class="btn btn-danger btn-sm"><i class="nav-icon fas fa-trash"></i> &nbsp;
                                Hapus</a>
                            <a href="{{ route('KD.print',($data->guru_id)) }}"
                                class="btn btn-success btn-sm"><i class="nav-icon fas fa-print"></i> &nbsp;
                                Print</a>
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
<div class="modal fade bd-example-modal-lg tambah-kd" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah KD</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('KD.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="kd_pengetahuan">KD Pengetahuan</label>
                                <textarea name="kd_pengetahuan" id="kd_pengetahuan" rows="4" class="form-control @error('kd_pengetahuan') is-invalid @enderror"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="materi_pokok">Materi Pokok</label>
                                <textarea name="materi_pokok" id="materi_pokok" rows="4" class="form-control @error('materi_pokok') is-invalid @enderror"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="penilaian">Penilaian</label>
                                <textarea name="penilaian" id="penilaian" rows="4" class="form-control @error('penilaian') is-invalid @enderror"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="sumber_belajar">Sumber Belajar</label>
                                <textarea name="sumber_belajar" id="sumber_belajar" rows="5" class="form-control @error('sumber_belajar') is-invalid @enderror"></textarea>
                            </div>
                            
                            
                        </div>
                        <div class="col-md-6">
                        <div class="form-group">
                                <label for="kd_keterampilan">KD Keterampilan</label>
                                <textarea name="kd_keterampilan" id="kd_keterampilan" rows="4" class="form-control @error('nama_guru') is-invalid @enderror"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="pembelajaran">Pembelajaran</label>
                                <textarea name="pembelajaran" id="pembelajaran" rows="4" class="form-control @error('pembelajaran') is-invalid @enderror"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="alokasi_waktu">Alokasi Waktu</label>
                                <textarea name="alokasi_waktu" id="alokasi_waktu" rows="4" class="form-control @error('alokasi_waktu') is-invalid @enderror"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="guru_id">Guru KD</label>
                                <select id="guru_id" name="guru_id"
                                    class="form-control @error('guru_id') is-invalid @enderror select2bs4">
                                    <option value="">-- Pilih Guru --</option>
                                    @foreach ($guru as $data)
                                    <option value="{{ $data->id }}">{{ $data->nama_guru }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="mapel_id">Mata Pelajaran</label>
                                <select id="mapel_id" name="mapel_id"
                                    class="form-control @error('mapel_id') is-invalid @enderror select2bs4">
                                    <option value="">-- Pilih Guru --</option>
                                    @foreach ($mapel as $data)
                                    <option value="{{ $data->id }}">{{ $data->nama_mapel }}</option>
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
    $("#KompetensiDasar").addClass("active");
    $("#liKompetensiDasar").addClass("menu-open");
    $("#DataKD").addClass("active");
</script>
@endsection