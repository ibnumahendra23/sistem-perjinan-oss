@extends('Layout.db')

@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-culture icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>Table Perijinan
                <div class="page-title-subheading">Data ini dapat diubah dan ditambahkan
                </div>
            </div>
        </div>
        <div class="page-title-actions">
            <a href="{{ route('pp.create') }}"
                class="btn-shadow mr-3 btn btn-dark">
                <i class="fa fa-plus"></i> Tambah
            </a>
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
        {{-- <h5 class="card-title">Data Permohonan Perijinan</h5> --}}
        <table id="table_id" class="mb-0 table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>No Perijinan</th>
                    <th>Nama Usaha</th>
                    <th>Jenis Perijinan</th>
                    <th>Tanggal Permohonan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pp as $p)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $p->statusPerijinan->no_perijinan }}</td>
                    <td>{{ $p->nama }}</td>
                    <td>{{ $p->jenis }}</td>
                    <td>{{ $p->statusPerijinan->tanggal_pengajuan }}</td>
                    <td>{{ $p->statusPerijinan->status }}</td>
                    <td>
                        <div class="d-flex">
                            <a href="{{ route('pp.edit', $p->id) }}" class="btn btn-primary btn-sm m-2"
                                style="width: 30px;height: 30px;">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a href="{{ route('pp.show', $p->statusPerijinan->id) }}" class="btn btn-warning btn-sm m-2"
                                style="width: 30px;height: 30px;">
                                <i class="fa fa-eye"></i>
                            </a>
                            <form action="{{ route('pp.delete', $p->id) }}" method="POST">
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
@endsection

@section('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.5/r-2.2.9/sb-1.3.2/datatables.min.css"/>
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
</style>
@endsection

@section('js')
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.5/r-2.2.9/sb-1.3.2/datatables.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#table_id').DataTable();
        } );

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
