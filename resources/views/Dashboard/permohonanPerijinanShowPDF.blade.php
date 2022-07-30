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

        .img-logo {
            position: absolute;
            top: 1.3rem;
            left: 6rem;
            width: 77px;
            height: 65px;
        }

        body {
            line-height: 1.2;
            font-family: 'Times New Roman', Times, serif
        }

        hr {
            margin: 15px 0;
        }

        .nomor {
            margin-left: 20px;
        }

        .hal {
            margin-left: 42px;
        }
        .nama {
            margin-left: 27px;
        }
        .jabatan {
            margin-left: 17px;
        }
        
        .alamat {
            margin-left: 18px;
        }
        .kelkec {
            margin-left: 77px;
        }

        .usaha {
            margin-left: 25px;
        }

        .jenis {
            margin-left: 34px;
        }

        .isi {
            text-align: justify;
            text-justify: inter-word;
            line-height: 1.2;
        }
        
        .ttd{
            position: absolute;
            top: 46rem;
            right: 6rem;
        }
        .flex-right {
            display: flex;
            justify-content: flex-end;
        }

    </style>
</head>

<body>
    <div class="container">
        <div class="row mt-4">
            <div class="d-flex flex-column justify-content-center">
                <p class="text-center mb-0 fw-bold text-uppercase">Pemerintah Kota Semarang</p>
                <p class="text-center mb-0 fw-bold text-uppercase">Kantor Kecamatan Pedurungan</p>
                <p class="text-center mb-0" style="font-size:12px!important"> Jl. Brigjend S. Sudiarto 367, Gemah,
                    Pedurungan, Kota Semarang, 50246</p>
                {{-- <img class="img-logo" src="{{ asset('assets/img/logo-kecamatan.png') }}" alt=""> --}}
                {{-- <img class="img-logo" src="{{ public_path('assets/img/logo-kecamatan.png') }}" alt=""> --}}
                <img class="img-logo" src="{{ public_path('assets/img/logo-kecamatan2.png') }}" alt="">

            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12 mt-2">
                Nomor <span class="nomor">: 0003/SP/{{ $sp->no_perijinan }}/{{ $sp->created_at->format('Y') }} </span>
            </div>
            <div class="col-md-12 mt-2">
                Hal <span class="hal">: Surat Permohonan Perijinan Usaha</span>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-12 mt-2">
                Yang bertandatangan di bawah ini :
            </div>
            <div class="col-md-12 mt-2">
                Nama <span class="nama">: {{ $camat->nama }}</span>
            </div>
            <div class="col-md-12 mt-2">
                Jabatan <span class="jabatan">: {{ $camat->jabatan }}</span>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-12 mt-2">
                Dengan ini menerangkan bahwa :
            </div>
            <div class="col-md-12 mt-2">
                @foreach ($users as $user)
                    @if ($user->id == $sp->perijinan->users_id)
                        Nama <span class="nama">: {{ $user->nama }}</span>
                    @endif
                @endforeach
            </div>
            <div class="col-md-12 mt-2">
                Usaha <span class="usaha">: {{ $sp->perijinan->nama }}</span>
            </div>
            <div class="col-md-12 mt-2">
                Alamat 
                <span class="alamat">: 
                    {{ $sp->perijinan->alamat }} 
                    RT-{{ $sp->perijinan->rt }}/RW-{{ $sp->perijinan->rw }},
                    {{ $sp->perijinan->kode_pos }} 
                </span>
                <p class="kelkec mb-0">
                    Kel.{{ $sp->perijinan->kelurahan }},
                    Kec.{{ $sp->perijinan->kecamatan }}
                </p>
            </div>
            <div class="col-md-12 mt-2">
                Jenis <span class="jenis">: {{ $sp->perijinan->jenis }}</span>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col md-12">
                @foreach ($users as $user)
                    @if ($user->id == $sp->perijinan->users_id)
                        <p class="isi">
                            Saudara yang bersangkutan telah memohon perijinan usaha dengan nama
                            <b>{{ $sp->perijinan->nama }}</b>,
                            yang berlokasi di {{ $sp->perijinan->alamat }},
                            dan diajukan pada tanggal {{ date('d/m/Y', strtotime($sp->tanggal_pengajuan)) }}
                            dengan ini menyatakan bahwa usaha tersebut telah memenuhi persyaratan yang ditentukan
                            oleh Kepala Kecamatan Pedurungan.
                        </p>
                    @endif
                @endforeach
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-md-12 mt-2">
                <p class="isi"> Demikian surat permohonan ini dibuat untuk dapat dipergunakan sebagaimana mestinya. </p>
            </div>
                <p class="text-end mb-1">Semarang, {{ $tanggal_pengajuan }}</p>
                <p class="text-end mb-5">
                    <b>Kepala Kecamatan Pedurungan</b>
                </p>
        </div>
        <div class="ttd mb-2">
            <p class="mb-0 mt-2">
                <u>{{ $camat->nama }}</u>
            </p>
            <p class="mb-0">
                NIP.{{ $camat->nip }}
            </p>
        </div>
    </div>

</body>


</html>
