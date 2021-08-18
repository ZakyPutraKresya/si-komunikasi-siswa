@extends('layouts.app')
@section('heading')
Edit {{$guru->jabatan}}
@endsection
@section('page')
<li class="breadcrumb-item active"><a href="{{ route('guru.index') }}">Guru</a></li>
<li class="breadcrumb-item active">Edit {{$guru->jabatan}}</li>
@endsection
@section('content')
<div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Edit Data {{$guru->jabatan}}</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ route('guru.update', $guru->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nama_guru">Nama Guru</label>
                            <input type="text" id="nama_guru" name="nama_guru" value="{{ $guru->nama_guru }}"
                                class="form-control @error('nama_guru') is-invalid @enderror">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" id="email" name="email" value="{{ $guru->email }}"
                                class="form-control @error('email') is-invalid @enderror">
                        </div>
                        <div class="form-group">
                            <label for="tmp_lahir">Tempat Lahir</label>
                            <input type="text" id="tmp_lahir" name="tmp_lahir" value="{{ $guru->tmp_lahir }}"
                                class="form-control @error('tmp_lahir') is-invalid @enderror">
                        </div>
                        <div class="form-group">
                            <label for="jabatan">Jabatan</label>
                            <select id="jabatan" name="jabatan"
                                class="select2bs4 form-control @error('jabatan') is-invalid @enderror">
                                <option value="">-- Pilih Jenis Kelamin --</option>
                                <option value="Admin" @if ($guru->jabatan == 'Admin')
                                    selected
                                    @endif
                                    >Laki-Laki</option>
                                <option value="Kepala Program" @if ($guru->jabatan == 'Kepala Program')
                                    selected
                                    @endif
                                    >Kepala Program</option>
                                <option value="Guru" @if ($guru->jabatan == 'Guru')
                                    selected
                                    @endif
                                    >Guru</option>
                                <option value="Kurikulum" @if ($guru->jabatan == 'Kurikulum')
                                    selected
                                    @endif
                                    >Kurikulum</option>
                                <option value="Wali Kelas" @if ($guru->jabatan == 'Wali Kelas')
                                    selected
                                    @endif
                                    >Wali Kelas</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="telp">Nomor Telpon/HP</label>
                            <input type="text" id="telp" name="telp" value="{{ $guru->telp }}"
                                class="form-control @error('telp') is-invalid @enderror">
                        </div>
                        <div class="form-group">
                            <label for="foto">Foto</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="foto"
                                        class="custom-file-input @error('foto') is-invalid @enderror" title="Awikwok"
                                        id="foto">
                                    <label class="custom-file-label" for="foto">Choose file</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nip">NIPD</label>
                            <input type="text" id="nipd" name="nipd" value="{{ $guru->nipd }}"
                                class="form-control @error('nipd') is-invalid @enderror">
                        </div>
                        <div class="form-group">
                            <label for="nip">Password</label>
                            <input type="password" id="password" name="password"
                                placeholder="Kosongkan jk tdk ingin ganti"
                                class="form-control @error('password') is-invalid @enderror">
                        </div>
                        <div class="form-group">
                            <label for="jk">Jenis Kelamin</label>
                            <select id="jk" name="jk" class="select2bs4 form-control @error('jk') is-invalid @enderror">
                                <option value="">-- Pilih Jenis Kelamin --</option>
                                <option value="L" @if ($guru->jk == 'L')
                                    selected
                                    @endif
                                    >Laki-Laki</option>
                                <option value="P" @if ($guru->jk == 'P')
                                    selected
                                    @endif
                                    >Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="role">Role</label>
                            <select id="role" name="role"
                                class="select2bs4 form-control @error('role') is-invalid @enderror">
                                <option value="">-- Pilih Jenis Kelamin --</option>
                                <option value="Admin" @if ($guru->jabatan == 'Admin')
                                    selected
                                    @endif
                                    >Laki-Laki</option>
                                <option value="Kepala Program" @if ($guru->jabatan == 'Kepala Program')
                                    selected
                                    @endif
                                    >Kepala Program</option>
                                <option value="Guru" @if ($guru->jabatan == 'Guru')
                                    selected
                                    @endif
                                    >Guru</option>
                                <option value="Kurikulum" @if ($guru->jabatan == 'Kurikulum')
                                    selected
                                    @endif
                                    >Kurikulum</option>
                                <option value="Wali Kelas" @if ($guru->jabatan == 'Wali Kelas')
                                    selected
                                    @endif
                                    >Wali Kelas</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tgl_lahir">Tanggal Lahir</label>
                            <input type="date" id="tgl_lahir" name="tgl_lahir" value="{{ $guru->tgl_lahir }}"
                                class="form-control @error('tgl_lahir') is-invalid @enderror">
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <a href="#" name="kembali" class="btn btn-default" id="back"><i class='nav-icon fas fa-arrow-left'></i>
                    &nbsp; Kembali</a> &nbsp;
                <button name="submit" class="btn btn-primary"><i class="nav-icon fas fa-save"></i> &nbsp;
                    Tambahkan</button>
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
            window.location = "{{ route('guru.index') }}";
        });
    });
    $("#MasterData").addClass("active");
    $("#liMasterData").addClass("menu-open");
    $("#DataGuru").addClass("active");
</script>
@endsection