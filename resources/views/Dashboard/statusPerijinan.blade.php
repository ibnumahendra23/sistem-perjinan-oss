@extends('Layout.db')

@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-culture icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>Data Permohonan Perijinan
                <div class="page-title-subheading">Data ini dapat diubah dan ditambahkan
                </div>
            </div>
        </div>
    </div>
</div>

@if (\Session::has('success'))
<div class="alert alert-success" role="alert">
    {!! \Session::get('success') !!}
</div>
@endif

@if (\Session::has('error'))
<div class="alert alert-danger" role="alert">
    {!! \Session::get('error') !!}
</div>
@endif

<div class="main-card mb-3 card">
    <div class="card-body">
        <div class="mb-3 card">
            <div class="card-body">
                <ul class="tabs-animated-shadow tabs-animated nav">
                    <li class="nav-item">
                        <a role="tab" class="nav-link active" id="tab-c-0" data-toggle="tab" href="#tab-animated-0">
                            <span>Dalam Proses</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a role="tab" class="nav-link" id="tab-c-2" data-toggle="tab" href="#tab-animated-2">
                            <span>Ditolak</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a role="tab" class="nav-link" id="tab-c-1" data-toggle="tab" href="#tab-animated-1">
                            <span>Disetujui</span>
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab-animated-0" role="tabpanel">
                        <table id="proses" class="mb-0 table table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>No Perijinan</th>
                                    <th>Nama Usaha</th>
                                    <th>Jenis Perijinan</th>
                                    <th>Tgl Pengajuan</th>
                                    <th>Status</th>
                                    <th>Pemilik</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($proses as $p)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $p->no_perijinan }}</td>
                                    <td>{{ $p->perijinan->nama }}</td>
                                    <td>{{ $p->perijinan->jenis }}</td>
                                    <td>{{ $p->tanggal_pengajuan }}</td>
                                    <td class="text-warning">{{ $p->status }}</td>
                                    @foreach ($users as $user)
                                    @if ($user->id == $p->perijinan->users_id)
                                    <td>
                                        <div class="badge badge-pill badge-info">
                                            {{ $user->nama }}
                                        </div>
                                    </td>
                                    @endif
                                    @endforeach
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('pp.edit', $p->perijinan->id) }}"
                                                class="btn btn-primary btn-sm m-2" style="width: 30px;height: 30px;">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="{{ route('pp.show', $p->id) }}" class="btn btn-warning btn-sm m-2"
                                                style="width: 30px;height: 30px;">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <form action="{{ route('pp.delete', $p->perijinan->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm m-2"
                                                    style="width: 30px;height: 30px;" onclick="deleteAlert()">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="tab-animated-1" role="tabpanel">
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('pdf.acc') }}" class="btn btn-success btn-sm m-2">
                                <i class="fa fa-download"></i>
                                Export to PDF
                            </a>
                        </div>
                        <table id="setuju" class="mb-0 table table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>No Perijinan</th>
                                    <th>Nama Usaha</th>
                                    <th>Jenis Perijinan</th>
                                    <th>Tgl Pengajuan</th>
                                    <th>Status</th>
                                    <th>Pemilik</th>
                                    <th>Aksi</th>
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
                                    <td class="text-success">{{ $s->status }}</td>
                                    @foreach ($users as $user)
                                    @if ($user->id == $s->perijinan->users_id)
                                    <td>
                                        <div class="badge badge-pill badge-info">
                                            {{ $user->nama }}
                                        </div>
                                    </td>
                                    @endif
                                    @endforeach
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('pp.edit', $s->perijinan->id) }}"
                                                class="btn btn-primary btn-sm m-2" style="width: 30px;height: 30px;">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="{{ route('pp.show', $s->id) }}" class="btn btn-warning btn-sm m-2"
                                                style="width: 30px;height: 30px;">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <form action="{{ route('pp.delete', $s->perijinan->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm m-2"
                                                    style="width: 30px;height: 30px;" onclick="deleteAlert()">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="tab-animated-2" role="tabpanel">
                        <table id="tolak" class="mb-0 table table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>No Perijinan</th>
                                    <th>Nama Usaha</th>
                                    <th>Jenis Perijinan</th>
                                    <th>Tgl Pengajuan</th>
                                    <th>Status</th>
                                    <th>Pemilik</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tolak as $t)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $t->no_perijinan }}</td>
                                    <td>{{ $t->perijinan->nama }}</td>
                                    <td>{{ $t->perijinan->jenis }}</td>
                                    <td>{{ $t->tanggal_pengajuan }}</td>
                                    <td class="text-danger">{{ $t->status }}</td>
                                    @foreach ($users as $user)
                                    @if ($user->id == $t->perijinan->users_id)
                                    <td>
                                        <div class="badge badge-pill badge-info">
                                            {{ $user->nama }}
                                        </div>
                                    </td>
                                    @endif
                                    @endforeach
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('pp.edit', $t->perijinan->id) }}"
                                                class="btn btn-primary btn-sm m-2" style="width: 30px;height: 30px;">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="{{ route('pp.show', $t->id) }}" class="btn btn-warning btn-sm m-2"
                                                style="width: 30px;height: 30px;">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <form action="{{ route('pp.delete', $t->perijinan->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm m-2"
                                                    style="width: 30px;height: 30px;" onclick="deleteAlert()">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('css')
<link rel="stylesheet" type="text/css"
    href="https://cdn.datatables.net/v/bs5/dt-1.11.5/r-2.2.9/sb-1.3.2/datatables.min.css" />
<style>
    .form-select {
        display: block;
        width: 100%;
        height: calc(2.25rem + 2px);
        padding: .375rem .75rem;
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.5;
        color: #495057;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        border-radius: .25rem;
    }

    /* .odd {
        cursor: pointer;
    }

    .even {
        cursor: pointer;
    } */

</style>
@endsection

@section('js')
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.5/r-2.2.9/sb-1.3.2/datatables.min.js">
    // <script src = "//code.jquery.com/jquery-1.11.0.min.js" >

</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
</script>

<script>
    $(document).ready(function () {
        $('#proses').DataTable();
    });
    $(document).ready(function () {
        $('#setuju').DataTable();
    });
    $(document).ready(function () {
        $('#tolak').DataTable();
    });

    $(document).ready(function () {
        setTimeout(function () {
            $(".alert").fadeOut(1500);
        }, 3000);
    });

    function deleteAlert() {
        var x = confirm("Apakah anda yakin ingin menghapus?");
        if (x) {
            return true;
        } else {
            return false;
        }
    }

</script>
@endsection
