<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Silabus {{$mapel->nama_mapel}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shrotcut icon" href="{{ asset('img/favicon.ico') }}">

    <style>
        .text-center {
            text-align: center;
        }


        .text-table {
            margin-left: 20px;
            font-size: 10px;
        }

        .text-table-center {
            text-align: center;
            font-size: 10px;
        }

        .table1 {
            margin: 0 250px 0 70px;
        }

        .table2 {
          margin: 0 20px 0 20px;
        }
    </style>
</head>

<body>

    <h5 class="text-center"><strong>SILABUS MATA PELAJARAN</strong></h5>

    <p style="margin-left: 70px; font-weight: lighter; font-size: 11px; text-align: left;"><strong>NAMA SEKOLAH
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            :</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; SMK Taruna Bhakti</p>
    <p style="margin-left: 70px; font-weight: lighter; font-size: 11px; text-align: left;"><strong>MATA PELAJARAN
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            :</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{$mapel->nama_mapel}}</p>

    <table border="0.1" class="table1" width="100%">
        <thead style="background-color: #a4b0be">
            <tr style="font-size: 9px; text-transform: uppercase;">
                <th>Kompetensi Inti</th>
                <th>Kode Kompetensi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kompetensi as $data)
            <tr>
                <td rowspan="4" class="text-table">{{$data->kompetensi_inti}}</span></td>
                <td rowspan="4" class="text-table-center">{{$data->kode_kompetensi}}</td>
            </tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            @endforeach

        </tbody>
    </table>
    <br>

    <table border="0.1" class="table2" width="100%">
      <thead style="background-color: #d2dae2; font-size: 9px; text-transform: uppercase;">
        <tr>
          <th rowspan="2">KD ...</th>
          <th colspan="2">Kompetensi Dasar</th>
          <th rowspan="2">Materi Pokok</th>
          <th rowspan="2">Pembelajaran</th>
          <th rowspan="2">Penilaian</th>
          <th rowspan="2">Alokasi Waktu</th>
          <th rowspan="2">Sumber Belajar</th>
        </tr>
        <tr>
          <th>Pengetahuan</th>
          <th>Keterampilan</th>
        </tr>
      </thead>
      <tbody>
        @foreach($kd as $data)
        <tr>
          <td rowspan="4" class="text-table-center">KD {{$loop->iteration}}</td>
          <td rowspan="4" class="text-table-center">{!! $data->kd_pengetahuan !!}</td>
          <td rowspan="4" class="text-table-center">{!! $data->kd_pengetahuan !!}</td>
          <td rowspan="4" class="text-table">{!! $data->materi_pokok !!}</td>
          <td rowspan="4" class="text-table">{!! $data->pembelajaran !!}</td>
          <td rowspan="4" class="text-table">{!! $data->penilaian !!}</td>
          <td rowspan="4" class="text-table-center">{!! $data->alokasi_waktu !!}</td>
          <td rowspan="4" class="text-table-center">{!! $data->sumber_belajar !!}</td>
        </tr>
        <tr></tr>
        <tr></tr>
        <tr></tr>
        @endforeach
      </tbody>
    </table>

</body>

</html>