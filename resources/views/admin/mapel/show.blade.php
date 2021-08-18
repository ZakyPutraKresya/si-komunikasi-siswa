@extends('layouts.app')
@section('heading')
    Data Mapel {{ $nama_mapel }}
@endsection
@section('page')
<li class="breadcrumb-item active">Data Mapel</li>
<li class="breadcrumb-item active">{{$nama_mapel}}</li>
@endsection
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <a href="{{ route('mapel.index') }}" class="btn btn-default btn-sm"><i
                    class="nav-icon fas fa-arrow-left"></i> &nbsp; Kembali</a>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example2" class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Mapel</th>
                        <th>Guru</th>
                        <th>Kelas</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mapel as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data->nama_mapel }}</td>
                        <td>{{ $data->guru->nama_guru }}</td>
                        @if($data->jurusan_id == 'Semua Kelas')
                        <td>Semua Kelas</td>
                        @else
                        <td>{{ $data->jurusan->nama_jurusan }}</td>
                        @endif
                        <td>
                            <form action="{{ route('mapel.destroy', $data->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <a href="{{ route('mapel.edit', Crypt::encrypt($data->id)) }}"
                                    class="btn btn-success btn-sm"><i class="nav-icon fas fa-edit"></i> &nbsp; Edit</a>
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
@endsection
@section('script')
<script>
    $("#MasterData").addClass("active");
    $("#liMasterData").addClass("menu-open");
    $("#DataMapel").addClass("active");
</script>
@endsection