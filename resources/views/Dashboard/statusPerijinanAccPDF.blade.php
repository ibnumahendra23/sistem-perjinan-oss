{{-- @extends('Layout.db')

@section('content') --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Permohonan Perijinan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        .page-break {
            page-break-after: always;
        }

        .page-break-before {
            page-break-before: always;
        }

        .page-break-inside {
            page-break-inside: avoid;
        }

        .page-break-after {
            page-break-after: always;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }

        table,
        th,
        td {
            border: 1px solid black;
            padding: 5px;
        }

        
    </style>
</head>

<body>
    <h5>Table perijinan yang disetujui</h5>
    <table class="mb-0 table">
        <thead class="">
            <tr>
                <th class="text-start">No</th>
                <th class="text-start">No Perijinan</th>
                <th class="text-start">Nama Usaha</th>
                <th class="text-start">Jenis Perijinan</th>
                <th class="text-start">Tanggal Pengajuan</th>
                <th class="text-start">Tanggal Disetujui</th>
                <th class="text-start">Status</th>
                <th class="text-start">Pemilik</th>
            </tr>
        </thead>
        <tbody>
            @foreach($setuju as $s)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $s->no_perijinan }}</td>
                <td>{{ $s->perijinan->nama }}</td>
                <td>{{ $s->perijinan->jenis }}</td>
                <td>{{ $s->tanggal_pengajuan }}</td>
                <td>{{ $s->tanggal_disetujui }}</td>
                <td class="text-success">{{ $s->status }}</td>
                @foreach ($users as $user)
                    @if ($user->id == $s->perijinan->users_id)
                        <td>{{ $user->nama }}</td>
                    @endif
                @endforeach
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
