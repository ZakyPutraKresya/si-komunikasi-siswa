@extends('layouts.app')
@section('heading')
Data {{ $jabatan }}
@endsection
@section('page')
<li class="breadcrumb-item active">Data</li>
<li class="breadcrumb-item active">{{$jabatan}}</li>
@endsection
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <a href="{{ route('guru.index') }}" class="btn btn-default btn-sm"><i
                    class="nav-icon fas fa-arrow-left"></i> &nbsp; Kembali</a>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example2" class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>NIPD</th>
                        <th>Nama</th>
                        <th>Foto</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($guru as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data->nipd }}</td>
                        <td>{{ $data->nama_guru }}</td>
                        <td>
                           <img src="{{ asset($data->foto) }}" width="130px" class="img-fluid mb-2">
                        </td>
                        <td>
                            <form action="{{ route('guru.destroy', $data->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <a href="{{ route('guru.show', Crypt::encrypt($data->id)) }}"
                                    class="btn btn-info btn-sm mt-2"><i class="nav-icon fas fa-id-card"></i> &nbsp;
                                    Detail</a>
                                <a href="{{ route('guru.edit', Crypt::encrypt($data->id)) }}"
                                    class="btn btn-success btn-sm mt-2"><i class="nav-icon fas fa-edit"></i> &nbsp;
                                    Edit</a>
                                <button class="btn btn-danger btn-sm mt-2"><i class="nav-icon fas fa-trash-alt"></i>
                                    &nbsp; Hapus</button>
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
    $("#DataGuru").addClass("active");
</script>
@endsection